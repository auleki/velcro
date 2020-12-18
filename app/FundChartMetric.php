<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundChartMetric extends Model
{
    public function fund_chart()
    {
        return $this->belongsTo('App\FundChart', 'fund_chart_id', 'id');
    }
}
