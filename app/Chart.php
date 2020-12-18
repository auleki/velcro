<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model 
{

    protected $table = 'charts';
    public $timestamps = true;

    public function metric()
    {
        return $this->belongsTo('Metric');
    }

    public function dashboard()
    {
        return $this->belongsTo('Dashboard', 'dashboard_id');
    }

}