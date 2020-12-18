<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Report extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'reports';
    public $timestamps = true;

    // public function user()
    // {
    //     return $this->belongsTo('User', 'user_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function company()
    // {
    //     return $this->belongsTo('Company', 'company_id');
    // }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function forms()
    {
        return $this->hasMany('Form');
    }

    public function sent_report()
    {
        return $this->hasOne('App\SentReport');
    }

    public function received_report()
    {
        return $this->hasOne('App\ReceivedReport');
    }

    public function scheduled_report()
    {
        return $this->hasOne('App\ScheduledReport');
    }

    public function draft_report()
    {
        return $this->hasOne('App\DraftReport');
    }

}
