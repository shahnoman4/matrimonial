<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class ChatRoomFeed extends Model
{
    
   protected $table = 'chat_room_feeds';

    // protected $fillable = [
    //     'fname', 'email', 'password', 'avatar', 'mobile', 'status', 'gender', 'dob','role_id','lname', 'age', 'designation', 'description', 'country','city','seeking'
    // ];
   
   

    public function messagedelete()
    {
        return $this->hasMany(MessageDelete::class,'chat_room_feeds_id','id');
    }
    
}
