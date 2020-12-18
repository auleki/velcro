<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{

    protected $fillable = [
        'investor',
        'company_invested',
         'market_focus',
         'fund',
         'stage',
         'ticket_size',
         'recently_active',
         'company_discussed',
         'declined_company',
         'location',
    ];

}
