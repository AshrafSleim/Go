<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'trip_id','passenger_id', 'report','rate'
    ];

    public function trip()
    {
        return $this->belongsTo('App\Trip','trip_id');
    }

}
