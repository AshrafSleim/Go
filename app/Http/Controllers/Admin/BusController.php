<?php

namespace App\Http\Controllers\Admin;

use App\Bus;
use App\BusDriver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Alert;
use Validator;
class BusController extends Controller
{
    public function index(Request $request)
    {
        session()->forget('menu');
        session()->put('menu', 'bus');
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $buses = $query->orderBy('id', 'desc')->paginate(10);
            $buses->setPath(URL::current() . "?" . "filter=1" .
                "&number=" . $request->number
            );
        } else {
            $buses = Bus::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.buses', compact('buses'));
    }

    public function returnSearchResult($request)
    {
        $number              = $request->number;
        $buses              = Bus::query();
        $buses->where(function ($query) use ($number) {
            if ($number) {
                $query->where('number', '=', $number);
            }

            return $query;
        });

        return $buses;
    }


    public function delete($id)
    {
        Bus::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }
     public function addBus(Request $request){
         $validator = Validator::make($request->all(), [
             'number' => 'required',
         ]);
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput($request->input());
         } else {

                 $driver=Bus::create([
                     'number' =>$request->number,
                 ]);
                 Alert::success('Successful Added !');
                 return redirect()->back();
         }


     }


     public function allDriverOfBus($id){
        $drivers=BusDriver::where('bus_id',$id)->paginate(10);
        $allDrivers=\App\User::all();
        return view('admin.busDrivers',compact('drivers','id','allDrivers'));
     }

    public function addBusDriver(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'driver' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $busDriver=BusDriver::where('bus_id',$id)->where('user_id',$request->driver)->get();
            if (count($busDriver)>0){
                Alert::error('This driver is already added !');

            }else{
                $driver=BusDriver::create([
                    'bus_id' =>$id,
                    'user_id'=>$request->driver,
                ]);
                Alert::success('Successful Added !');
            }


            return redirect()->back();
        }


    }

    public function deleteBusDriver($id)
    {
        BusDriver::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }
}
