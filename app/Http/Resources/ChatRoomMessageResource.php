<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use Storage;
use DateTime;
use Auth;
use App\models\ChatRoomParticipant;
use App\models\MessageDelete;
class ChatRoomMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       
       // return parent::toArray($request);
       $user = Auth::user();
        if($user->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->id.'/'.$user->avatar);

        }
        $user_name = Auth::user()->name;
       // $reciver = ChatRoomParticipant::where('room_id', $this->room_id)->where('user_id','!=',$user_id)->first();
    
        return [
            'message_id'=> $this->id,
            'user_name'=> $user_name,
            'title'=> $user_name.' '.'send you a new message',
            'room_id'=> $this->room_id,
            'message'=> $this->message,
            'sender_id'=> $this->sender_id,
            'avatar'=> $Avatarurl,
            'created_at'=> $this->created_at->diffForHumans(),
           
        ];

        
       // return parent::toArray($request);
    }
}
