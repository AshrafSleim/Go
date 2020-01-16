<?php

namespace App\Http\Controllers\Api;

use App\Boock;
use App\Http\Controllers\Controller;
use App\Report;
use App\Trip;
use App\TripStation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassengerController extends Controller
{
    public function searchTrip(Request $request){
        $current_date = Carbon::yesterday();
        $validator = Validator::make($request->all(), [
            'location'                => 'required',
            'destination'               => 'required|different:location',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error','data' => $validator->errors()],200);
        }else{
            $allTripHaveLocation=TripStation::where('station_id',$request->location)->get();
            $allTrip=[];
            foreach ($allTripHaveLocation as $location){
                $allTripHaveDestination=TripStation::where('station_id',$request->destination)
                    ->where('trip_id',$location->trip_id)
                    ->where('time','>',$location->time)
                    ->first();
                if ($allTripHaveDestination != null){
                    array_push($allTrip,$allTripHaveDestination->trip_id);
                }
            }
            $trips=Trip::whereIn('id',$allTrip)->where('start_date', ">", $current_date)->get();
            return response()->json(['status' => 'success', 'data' =>$trips],200);

        }
    }

    public function bookingTrip(Request $request){
        $validator = Validator::make($request->all(), [
            'trip_id'                => 'required',
            'location'                => 'required',
            'destination'               => 'required|different:location',
            'type_pay'                => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error','data' => $validator->errors()],200);
        }else{
            $trip=Trip::findOrFail($request->trip_id);
            if ($trip->no_chair > 0){
                $book = Boock::create([
                    'trip_id' =>$request->trip_id ,
                    'passenger_id' =>Auth::guard('passenger')->user()->id ,
                    'location' =>$request->location ,
                    'destination' =>$request->destination ,
                    'type_pay' =>$request->type_pay ,
                    'cost' =>$trip->cost ,
                ]);
                Trip::findOrFail($request->trip_id)->update(['no_chair' =>$trip->no_chair -1 ]);
                $trip=Trip::findOrFail($request->trip_id);
                return response()->json(['status' => 'success', 'data' =>$trip],200);
            }else{
                return response()->json(['status' => 'error','data' => 'the bus is complete'],200);

            }

        }
    }

    public function getTripInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'trip_id'                => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error','data' => $validator->errors()],200);
        }else{
            $data=[];
            $trip=Trip::findOrFail($request->trip_id);
            $data['trip']=$trip;
            $tripStations=TripStation::where('trip_id',$request->trip_id)->get();
            foreach ($tripStations as $tripStation){
                $tripStation['name']=$tripStation->station->name;
            }
            $data['tripStations']=$tripStations;
            return response()->json(['status' => 'success', 'data' =>$data],200);

        }
    }


    public function allPreviousTrip(){
        $data=[];
        $trips=Boock::where('passenger_id',Auth::guard('passenger')->user()->id)->get();
        foreach ($trips as $trip){
            $trip['location']=$trip->startStation->name;
            $trip['destination']=$trip->endStation->name;
            $trip['trip_name']=$trip->trip->name;
            if ($trip->end != null){
                array_push($data,$trip);
            }
        }
        return response()->json(['status' => 'success', 'data' =>$data],200);
    }

    public function makeRate(Request $request){
        $validator = Validator::make($request->all(), [
            'trip_id'                => 'required',
            'rate'                => 'required | numeric | between:0,10',
            'report'                => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error','data' => $validator->errors()],200);
        }else{
            Report::create([
                'trip_id' =>$request->trip_id ,
                'passenger_id' =>Auth::guard('passenger')->user()->id ,
                'rate' =>$request->rate ,
                'report' =>$request->report ,
            ]);
            return response()->json(['status' => 'success', 'data' =>'Added successfully'],200);
        }
    }
}
