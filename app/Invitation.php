<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'email','permission', 'invitation_token', 'registered_at','user_id'
    ];

    public function generateInvitationToken() {
        $this->invitation_token = substr(md5(rand(0, 9) . $this->email . time()), 0, 32);
    }

        
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
