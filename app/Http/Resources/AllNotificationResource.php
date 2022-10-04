<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use Storage;
use DateTime;
use Auth;
use App\models\ChatRoomParticipant;
use App\models\MessageDelete;
class AllNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        if($this->data['letter']['data']['avatar']=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$this->data['letter']['data']['avatar']);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$this->data['letter']['data']['id'].'/'.$this->data['letter']['data']['avatar']);

        }
       
        if(isset($this->read_at) && $this->read_at!='') {

             $read_at =  'read';
        }else{
            $read_at =  'unread';
        }
        return [
            //'message_id'=> $this->data['letter']['message_id'],
            'user_name'=> $this->data['letter']['created_by'],
            'title'=>     $this->data['letter']['body'],
            'room_id'=> $this->data['letter']['data']['room_id'],
            //'message'=> $this->data['letter']['data']['message'],
            'sender_id'=> $this->data['letter']['data']['sender_id'],
            'avatar' => $Avatarurl,
            'type'=>  $this->data['letter']['actionURL'],
            'created_at'=> $this->created_at->diffForHumans(),
           
        ];

        
       // return parent::toArray($request);
    }
}
