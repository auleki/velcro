<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sfile extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'efile_id','user_id',
    ];

    
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function efile()
    {
        return $this->belongsTo('App\Efile','efile_id','id');
    }
    
   
}
