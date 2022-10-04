<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use Storage;
use DateTime;
use Auth;
class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       
        if($this['data']['avatar']=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$this['data']['avatar']);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$this['data']['id'].'/'.$this['data']['avatar']);

        }
       
        
        return [
            'message_id'=> $this['message_id'],
            'user_name'=> $this['created_by'],
            'title'=>     $this['body'],
            'room_id'=> $this['data']['room_id'],
            //'message'=> $this->data['letter']['data']['message'], 
            'sender_id'=> $this['data']['sender_id'],
            'avatar' => $Avatarurl,
            'notification_type'=>  $this['actionURL'],
            'created_at'=> $this['data']['created_at']->diffForHumans(),
           
        ];
        
       // return parent::toArray($request);
    }
}
