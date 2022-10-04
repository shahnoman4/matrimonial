<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Http\Resources\ChatRoomFeedResource as ChatRoomFeedResource;
use App\models\ChatRoomFeed;

class Message implements ShouldBroadcast
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
        //return new Channel('my-channel');
        //return new PrivateChannel('my-channel.'.$this->message->room_id);
        return new  Channel('my-channel-message.'.$this->message->room_id);
    }

    public function broadcastAs()
    {
        return 'my-event';
    }

    public function broadcastWith()
    {
        //$this->message->load('fromContact');
        return ["data" => new ChatRoomFeedResource($this->message)];
    }    
}
