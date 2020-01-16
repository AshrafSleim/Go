<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'name','bus_id', 'user_id','start_station','end_station','start_date','driver_start',
        'driver_end','cost','no_chair'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function bus()
    {
        return $this->belongsTo('App\Bus','bus_id');
    }
    public function startStation()
    {
        return $this->belongsTo('App\Station','start_station');
    }
    public function endStation()
    {
        return $this->belongsTo('App\Station','end_station');
    }

    public function stations()
    {
        return $this->hasMany('App\TripStation');
    }
}
