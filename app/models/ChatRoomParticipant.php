<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class ChatRoomParticipant extends Model
{
    
   protected $table = 'chat_room_participants';

    // protected $fillable = [
    //     'fname', 'email', 'password', 'avatar', 'mobile', 'status', 'gender', 'dob','role_id','lname', 'age', 'designation', 'description', 'country','city','seeking'
    // ];
   
    // public function sendInterest(){
    //     return $this->hasOne(User::class, 'id', 'user_id' )->withDefault();
    // }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
