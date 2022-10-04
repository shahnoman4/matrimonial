<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use Storage;
use DateTime;
use Auth;
use App\models\ChatRoomParticipant;
use App\models\MessageDelete;
class ChatRoomFeedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


        if(isset($this->file_upload) && $this->file_upload!=''){
            $file = URL::to('/').Storage::disk('local')->url('public/chats/'.$this->file_upload);
        }else{
            $file = '';

        }
        
         if(isset($this->message) && $this->message!=''){
            $message = $this->message;
        }else{
            $message = '';

        }
       // $user_id = Auth::user()->id;
        //$reciver = ChatRoomParticipant::where('room_id', $this->room_id)->where('user_id','!=',$user_id)->first();
    
        return [
            'message_id'=> $this->id,
            'room_id'=> $this->room_id,
            'message'=> $message,
            'file_upload'=> $file,
            'sender_id'=> $this->sender_id,
            //'avatar' => $Avatarurl,
            'created_at'=> $this->created_at->diffForHumans(),
           
        ];

        
       // return parent::toArray($request);
    }
}
