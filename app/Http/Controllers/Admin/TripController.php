<?php

namespace App\Http\Controllers\Admin;

use App\Bus;
use App\BusDriver;
use App\Http\Controllers\Controller;
use App\Report;
use App\Station;
use App\Trip;
use App\TripStation;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\URL;
use Validator;
class TripController extends Controller
{
    public function index(Request $request)
    {
        session()->forget('menu');
        session()->put('menu', 'trip');
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $trips = $query->orderBy('id', 'desc')->paginate(10);
            $trips->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name .
                "&date=" . $request->date

            );
        } else {
            $trips = Trip::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.trip', compact('trips'));
    }

    public function returnSearchResult($request)
    {
        $name               = $request->name;
        $date              = $request->date;
        $trips              = Trip::query();
        $trips->where(function ($query) use ($name, $date) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }
            if ($date) {
                $query->where('start_date', '=', $date);
            }

            return $query;
        });

        return $trips;
    }



    public function addNew(){
        $stations=Station::all();
        $buses=Bus::all();
        return view('admin.addNewTrip',compact('stations','buses'));
    }
    public function saveNew(Request $request){
//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'start_station' => 'required',
            'end_station' => 'required | different:start_station',
            'start_date' => 'required | after:yesterday',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'bus' => 'required',
            'driver' => 'required',
            'cost' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {

            $trip=Trip::create([
                'name' =>$request->name,
                'start_station' =>$request->start_station,
                'end_station' =>$request->end_station,
                'start_date' =>$request->start_date,
                'bus_id' =>$request->bus,
                'user_id' =>$request->driver,
                'cost' =>$request->cost,
            ]);
            TripStation::create([
                'trip_id' =>$trip->id,
                'station_id' =>$request->start_station,
                'time' =>$request->start_time,
            ]);
            TripStation::create([
                'trip_id' =>$trip->id,
                'station_id' =>$request->end_station,
                'time' =>$request->end_time,
            ]);
            Alert::success('Successful Added !');
            return redirect()->back();
        }

    }
    public function getBusDriver($id){
        $driver=BusDriver::where('bus_id',$id)->get('user_id');
        $drivers=\App\User::whereIn('id',$driver)->get();
        return json_encode($drivers);

    }

    public function delete($id)
    {
        Trip::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }

    public function allStation($id){
        $stations=TripStation::where('trip_id',$id)->paginate(10);
        $allStations=Station::all();
        return view('admin.tripStations',compact('stations','id','allStations'));
    }
    public function addNewStation(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'start_time' => 'required',
            'station' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            TripStation::create([
                'trip_id' =>$id,
                'station_id' =>$request->station,
                'time' =>$request->start_time,
            ]);
            Alert::success('Successful Added !');
            return redirect()->back();
        }
    }

    public function deleteStation($id){
        TripStation::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }

    public function getReports(){
        session()->forget('menu');
        session()->put('menu', 'report');
        $reports=Report::paginate(10);
        return view('admin.allReports',compact('reports'));
    }

}
