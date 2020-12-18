<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{


    protected $table = 'contacts';
    public $timestamps = true;

    protected $fillable = [
    'fname', 'lname', 'email', 'phoneNo', 'company', 'title', 'tags', 'user_id'
    ];

    public function company() {
        return $this->belongsTo('App\Company','company','id');
    }

}
