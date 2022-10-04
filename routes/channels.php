<?php
use App\ChatRoomParticipant;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('notification-channel', function ($user) {
   // Auth::check();
    return true;
  });

// Broadcast::channel('my-channel.{id}', function ($user, $id) {
//          return true;
//   });
Broadcast::channel('my-channel.{id}', function ($user, $rooms) {
    $chatrooms = ChatRoomParticipant::where('user_id',$user->id)->pluck('room_id')->toArray();
    return  in_array($rooms, $chatrooms);
   // $room = array_map('intval',explode(',', $rooms));
   // return $chatrooms ===  $room;
  
});