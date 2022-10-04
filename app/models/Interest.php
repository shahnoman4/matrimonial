<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Interest extends Model
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
   
    public function sendInterest(){
        return $this->hasOne(User::class, 'id', 'interested_user_id' )->withDefault();
    }

    public function receivedInterest(){
        return $this->hasOne(User::class, 'id', 'user_id' )->withDefault();
    }
    
}
