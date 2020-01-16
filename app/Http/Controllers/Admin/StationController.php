<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Alert;
use Validator;
class StationController extends Controller
{
    public function index(Request $request)
    {
        session()->forget('menu');
        session()->put('menu', 'station');
        if ($request->filter == 1) {
            $query = $this->returnSearchResult($request);
            $stations = $query->orderBy('id', 'desc')->paginate(10);
            $stations->setPath(URL::current() . "?" . "filter=1" .
                "&name=" . $request->name
            );
        } else {
            $stations = Station::query()->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.station', compact('stations'));
    }


    public function returnSearchResult($request)
    {
        $name              = $request->name;
        $stations              = Station::query();
        $stations->where(function ($query) use ($name) {
            if ($name) {
                $query->where('name', 'LIKE', ['%' . $name . '%']);
            }

            return $query;
        });

        return $stations;
    }


    public function delete($id)
    {
        Station::findOrFail($id)->delete();
        Alert::success('Successful delete !');
        return redirect()->back();
    }

    public function addStation(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {

            $driver=Station::create([
                'name' =>$request->name,
            ]);
            Alert::success('Successful Added !');
            return redirect()->back();
        }


    }


}
