<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boock extends Model
{
    protected $fillable = [
        'trip_id','passenger_id','location','destination','type_pay','cost','start','end'
    ];

    public function trip()
    {
        return $this->belongsTo('App\Trip','trip_id');
    }

    public function startStation()
    {
        return $this->belongsTo('App\Station','location');
    }
    public function endStation()
    {
        return $this->belongsTo('App\Station','destination');
    }
}
