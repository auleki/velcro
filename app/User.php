<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Revolution\Google\Sheets\Traits\GoogleSheets;
use App\User;

use Illuminate\Database\Eloquent\Model;

// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use Notifiable;
    use GoogleSheets;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname','lname','type','permission', 'email', 'password','access_token','refresh_token','expires_in',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //     public function files()
    // {
    //     return $this->hasMany('File');
    // }

    // public function reports()
    // {
    //     return $this->hasMany('Report', 'user_id');
    // }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }


     public function getAvatarUrlAttribute()
    {
        return Storage::url('avatars/'.$this->id.'/'.$this->avatar);
    }


    /**

     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    /**
    *
    *Get the users full name
    *
    */
    public function getFullnameAttribute()
    {
       return $this->fname . ' '. $this->lname;
    }

    public function fullname()
    {
        return $this->fname . ' '. $this->lname;
    }


     public function files()
    {
        return $this->hasMany('Efile');
    }


    public function userexists($id)
    {
      $user = User::FindOrFail($id);
      if($user)
      {
          return true;
      }
      else{
          return false;
      }
    }


    /**
     * Get the Access Token
     *
     * @return string|array
     */
    protected function sheetsAccessToken()
    {
        return [
            'access_token'  => $this->access_token,
            'refresh_token' => $this->refresh_token,
            'expires_in'    => 3600,
            'created'       => $this->updated_at->getTimestamp(),
        ];
    }

    function scopeWithName($query, $name)
{
    // Split each Name by Spaces
    $names = explode(" ", $name);

    // Search each Name Field for any specified Name
    return User::where(function($query) use ($names) {
        $query->whereIn('fname', $names);
        $query->orWhere(function($query) use ($names) {
            $query->whereIn('lname', $names);
        });
    });
}

}
