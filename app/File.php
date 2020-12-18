<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model 
{

    protected $table = 'files';
    public $timestamps = true;

    /* The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'source','user_id','company_id','status','path','size','name','storage'
    ];

    

     public function user()
    {
        return $this->belongsTo('User');
    }

    public function company()
    {
        return $this->belongsTo('Company');
    }

}

