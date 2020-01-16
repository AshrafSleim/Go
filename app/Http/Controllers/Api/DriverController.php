<?php

namespace App\Http\Controllers\Api;

use App\Boock;
use App\Http\Controllers\Controller;
use App\Trip;
use App\TripStation;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;
class DriverController extends Controller
{
    public function getAllTrip(){
        $upcomingTrips=[];
        $nextTrips=[];
        $trips=Trip::where('user_id',Auth::guard('api')->user()->id)->get();
        foreach ($trips as $trip){
            $trip['start_station']=$trip->startStation->name;
            $trip['end_station']=$trip->endStation->name;
            $trip['bus_name']=$trip->bus->name;
            $stations=TripStation::where('trip_id',$trip->id)->get();
            foreach ($stations as $station){
                $station['name']=$station->station->name;
            }
            $trip['stations']=$stations;
            if ($trip->driver_start != null){
                array_push($upcomingTrips,$trip);
            }else{
                array_push($nextTrips,$trip);

            }
        }
        $data['upcomingTrips']=$upcomingTrips;
        $data['nextTrips']=$nextTrips;
        return response()->json(['status' => 'success', 'data' =>$data],200);

    }

    public function startTrip(Request $request){
        $current_date = Carbon::now();
        $validator = Validator::make($request->all(), [
            'trip_id'                => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error','data' => $validator->errors()],200);
        }else{
            Trip::findOrFail($request->trip_id)->update(['driver_start' =>$current_date]);
            return response()->json(['status' => 'success', 'data' =>'trip started'],200);
        }
    }
    public function endTrip(Request $request){
        $current_date = Carbon::now();
        $validator = Validator::make($request->all(), [
            'trip_id'                => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error','data' => $validator->errors()],200);
        }else{
            Trip::findOrFail($request->trip_id)->update(['driver_end' =>$current_date]);
            $totalCost= Boock::where('trip_id',$request->trip_id)->where('type_pay','cash')->sum('cost');
            return response()->json(['status' => 'success', 'total cost' =>$totalCost],200);
        }
    }
    public function startTripPassenger(Request $request){
        $current_date = Carbon::now();
        $validator = Validator::make($request->all(), [
            'Book_id'                => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error','data' => $validator->errors()],200);
        }else{
            Boock::findOrFail($request->Book_id)->update(['start' =>$current_date]);
            return response()->json(['status' => 'success', 'data' =>'trip started'],200);
        }
    }

    public function endTripPassenger(Request $request){
        $current_date = Carbon::now();
        $validator = Validator::make($request->all(), [
            'Book_id'                => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error','data' => $validator->errors()],200);
        }else{
            Boock::findOrFail($request->Book_id)->update(['end' =>$current_date]);
            $book=Boock::findOrFail($request->Book_id);
            if ($book->type_pay == 'cash'){
                $totalCost=$book->cost;
                $driver=User::findOrFail(Auth::guard('api')->user()->id);
                User::findOrFail(Auth::guard('api')->user()->id)->update(['wallet' =>$driver->wallet + $book->cost ]);
            }else{
                $totalCost="Booked by credit";
            }
            return response()->json(['status' => 'success', 'total cost' =>$totalCost],200);
        }
    }

}
