<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Shortlist extends Model
{
    //use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'fname', 'email', 'password', 'avatar', 'mobile', 'status', 'gender', 'dob','role_id','lname', 'age', 'designation', 'description', 'country','city','seeking'
    // ];
    
    public function shortlist(){
        return $this->hasOne(User::class, 'id', 'shortlisted_user_id')->withDefault();
    }
    
}
