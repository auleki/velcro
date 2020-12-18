<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cfile extends Model
{

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','type','company_id', 'efile_id', 'user_id','path',
    ];
    

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function efile()
    {
        return $this->belongsTo('App\Efile','efile_id','id');
    }

    
    public function efiles()
    {
        return $this->hasMany('App\Efile','efile_id','id');
    }
    

    
}
