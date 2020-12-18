<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }

    public function received_report()
    {
        return $this->hasOne('App\ReceivedReport');
    }
}
