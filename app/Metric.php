<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{

    protected $table = 'metrics';
    public $timestamps = true;

    public function charts()
    {
        return $this->hasMany('Chart');
    }

    protected $fillable = [
    'chartType'
    ];

}
