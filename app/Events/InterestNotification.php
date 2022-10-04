<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Http\Resources\ChatRoomMessageResource as ChatRoomMessageResource;
use App\models\Interest;
use App\models\ChatRoomParticipant;
use Auth;
use App\Http\Resources\SendInterestMessageResource as SendInterestMessageResource;

class InterestNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    

    public $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Interest $data)
    {
        $this->data = $data;
       //$this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
    
        return new  Channel('interest-channel.'.$this->data->interested_user_id);
    }

    public function broadcastAs()
    {
        
        return 'interest-event';
    }

    public function broadcastWith()
    {
        //$this->data->load('fromContact');
        return ["data" => new SendInterestMessageResource($this->data)];
    }    
}
