<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusDriver extends Model
{
    protected $fillable = [
        'bus_id','user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
