<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Sfile;
use App\Efile;
use App\User;
class Efile extends Model
{
    
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'source','user_id','company_id','status','path','size','name','storage'
    ];

    

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo('Company');
    }

          /**
     * Determine whether a document exist.
     *
     * @return boolean
     */
    public function documentexists()
    {
        // $choice = Sfile::where('efile_id',$choice_name)->where('entity_id', $this->id)->first();
        return (bool) Sfile::where('efile_id', $this->id)
                            // ->where('choice_id', $choice->id)
                            ->first();
    }

    public function userexists($id)
    {
    //   $user = User::FindOrFail($id);
      return (bool) User::whereId($id)->first();
    }

              /**
     * Determine whether a user was shared a file or owns it.
     *
     * @return boolean
     */
    public function shared()
    {
        // $choice = Sfile::where('efile_id',$choice_name)->where('entity_id', $this->id)->first();
        return (bool) Sfile::where('efile_id', $this->id)
                            ->where('user_id', Auth::id())
                            ->first();
    }

                  /**
     * Determine whether a user was shared a file or owns it.
     *
     * @return boolean
     */
    public function mine()
    {
        // $choice = Sfile::where('efile_id',$choice_name)->where('entity_id', $this->id)->first();
        return (bool) Efile::where('id', $this->id)
                            ->where('user_id', Auth::id())
                            ->first();
    }


}
