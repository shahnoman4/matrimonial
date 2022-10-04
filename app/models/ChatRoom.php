<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class ChatRoom extends Model
{
    
   protected $table = 'chat_rooms';

    // protected $fillable = [
    //     'fname', 'email', 'password', 'avatar', 'mobile', 'status', 'gender', 'dob','role_id','lname', 'age', 'designation', 'description', 'country','city','seeking'
    // ];
   
    public function participants()
    {
        return $this->hasMany(ChatRoomParticipant::class,'room_id','id');
    }
    public function users(){
        return $this->hasOne(User::class,'user_id','id');
    }
    
}
