<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripStation extends Model
{
    protected $fillable = [
        'trip_id','station_id', 'time'
    ];

    public function station()
    {
        return $this->belongsTo('App\Station','station_id');
    }
}
