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
use App\models\ChatRoomFeed;
use App\models\ChatRoomParticipant;
use Auth;
class MessageNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    

    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ChatRoomFeed $message)
    {
        $this->message = $message;
       //$this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $user_id = Auth::user()->id;
        //return new Channel('my-channel');
       // $user_id = Auth::user()->id;
        $reciver = ChatRoomParticipant::where('room_id', $this->message->room_id)->where('user_id','!=',$user_id)->first();
    
        return new  Channel('notification-channel-message.'.$reciver->user_id);
    }

    public function broadcastAs()
    {
        
        return 'notification-event';
    }

    public function broadcastWith()
    {
        //$this->message->load('fromContact');
        return ["data" => new ChatRoomMessageResource($this->message)];
    }    
}
