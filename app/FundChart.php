<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundChart extends Model
{
    use SoftDeletes;
    
    public function fund_chart_metric()
    {
        return $this->hasMany('App\FundChartMetric', 'fund_chart_id', 'id');
    }
}
