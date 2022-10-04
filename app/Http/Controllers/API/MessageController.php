<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use URL;
use Hash;
use App\Http\Resources\AllUserResource as AllUserResource;
use App\Http\Resources\AllNotificationResource as AllNotificationResource;
use App\Http\Resources\ReceivedInterestResource as ReceivedInterestResource;
use App\Http\Resources\SendInterestResource as SendInterestResource;
use App\Http\Resources\ReceivedInterestCollection;
use App\Http\Resources\SendInterestCollection;
use App\Http\Resources\ShortlistCollection;
use App\Http\Resources\AllUserCollection;
use App\Http\Resources\ChatRoomFeedCollection;
use App\Http\Resources\AllNotificationCollection;
use App\Http\Resources\ChatRoomMessageCollection;
use App\Http\Resources\ParticipantCollection;
use App\Http\Resources\BlockParticipantCollection;
use App\models\ChatRoomFeed;
use App\models\ChatRoomParticipant;
use App\models\ChatRoom;
use App\models\MessageDelete;
use App\models\ReportUser;
use App\Events\Message;
use App\Events\MessageNotification;
use App\Http\Resources\ChatRoomFeedResource as ChatRoomFeedResource;
use App\Notifications\SendMessageNotification;
use App\Notification;


class MessageController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    
    public function createRoom(Request $request){
         
       $user = Auth::user();
       $user_id = $request->user_id;
       $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }

        $chatroomId = ChatRoom::where('room_type', 'Normal')->whereHas('participants', function ($query) use ($user_id) {
            $query->where('user_id', '=', $user_id);
        })
        ->with('participants')
            ->pluck('id');
        
       $chatrooms = ChatRoom::where('room_type', 'Normal')->whereIN('id', $chatroomId)->whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', '=', $user->id);
        })
        ->with('participants')
        ->first();
            
       //dd($chatrooms->toArray());
       if ($chatrooms) {
          //echo "string"; exit();
            $ChatRoomss =  ChatRoom::findOrFail($chatrooms->id);
            $ChatRoomss['logo']   = ($ChatRoomss->logo) ? $ChatRoomss->logo : '';
            $ChatRoomss['status'] = ($ChatRoomss->status) ? $ChatRoomss->status : '';
            $response_data=[
            'success' => 1,
            'message' => 'Chat Room created successfully.',
            'data' => $ChatRoomss
        ];
        return response()->json($response_data, $this->successStatus);

        }else{
            
       $ChatRoom = new ChatRoom;
       $ChatRoom->name = 'Normal';
       $ChatRoom->room_type = 'Normal';
       $ChatRoom->save();

       if($ChatRoom){

           $ChatRoomParticipant = new ChatRoomParticipant;
           $ChatRoomParticipant->room_id = $ChatRoom->id; 
           $ChatRoomParticipant->user_id = $user_id; 
           $ChatRoomParticipant->status = 'Active'; 
           $ChatRoomParticipant->save();

           $ChatRoomParticipant = new ChatRoomParticipant;
           $ChatRoomParticipant->room_id = $ChatRoom->id; 
           $ChatRoomParticipant->user_id = $user->id;
           $ChatRoomParticipant->status = 'Active'; 
           $ChatRoomParticipant->save(); 
       }
        
        $ChatRoom['logo']   = ($ChatRoom->logo) ? $ChatRoom->logo : '';
        $ChatRoom['status'] = ($ChatRoom->status) ? $ChatRoom->status : '';


        $response_data=[
            'success' => 1,
            'message' => 'Chat Room created successfully.',
            'data' => $ChatRoom
        ];
        return response()->json($response_data, $this->successStatus);

        }
    }      

    public function sendMessage(Request $request){
         
        $user = Auth::user();
        $room_id = $request->user_id;
        $validator = Validator::make($request->all(), [
            'room_id' => 'required',
           // 'message' => 'required',
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }

        $find = ChatRoomParticipant::where('user_id',$user->id)->where('room_id',$request->room_id)->first();
        if($find->status=='Block'){

            $response_data=[
            'success' => 2,
            'message' => 'Your message could not be sent.',
            'data' => null
           ];
        }else{

         $ChatRoomFeed = new ChatRoomFeed;
         $ChatRoomFeed->room_id = $request->room_id;
         $ChatRoomFeed->sender_id = $user->id;
         $ChatRoomFeed->message = $request->message;
        if($request->hasfile('file_upload'))
        {
          
           $file = $request->file('file_upload');
           $file_upload=$file->getClientOriginalName();
           Storage::disk('local')->put('/public/chats/'.$file_upload, File::get($file));
           $ChatRoomFeed->file_upload=$file_upload;
        }  
         $ChatRoomFeed->markasread = '0';
         $ChatRoomFeed->save();

        broadcast(new Message($ChatRoomFeed));
        broadcast(new MessageNotification($ChatRoomFeed));
        $response_data=[
            'success' => 1,
            'message' => 'Message send successfully.',
            'data' => new ChatRoomFeedResource($ChatRoomFeed)
        ];
        
        $findRMessage = ChatRoomParticipant::where('user_id','!=',$user->id)->where('room_id',$request->room_id)->first();
        $users = User::findOrFail($findRMessage->user_id);
        $ChatRoomFeed['avatar'] = $user->avatar;
        $ChatRoomFeed['id'] = $user->id;
         $details = [
            'greeting' => $user->name.' '.'send you a new message',
            'body' => $user->name.' '.'send you a new message',
            'thanks' => 'Thank you',
            'actionText' => 'View My Site',
            'actionURL' => 'Message',
            'message_id' => $ChatRoomFeed->id,
            'data' => $ChatRoomFeed,
            'created_by' => auth()->user()->name
        ];
  
        \Notification::send($users, new SendMessageNotification($details));

        
        }
        //event(new Message($ChatRoomFeed));
        return response()->json($response_data, $this->successStatus);   
    }


    public function blockUser(Request $request)
    {
        $auth_user_id = Auth::user()->id;
        $roomId = $request->room_id;

        $find = ChatRoomParticipant::where('user_id','!=',$auth_user_id)->where('room_id',$roomId)->first();
        if($find->status=='Block'){

            $response_data=[
            'success' => 0,
            'message' => 'Already blocked.',
            //'data' => $user
           ];
        }else{

        $data = ChatRoomParticipant::where('user_id','!=',$auth_user_id)->where('room_id',$roomId)->first();
        $data->status = 'Block';
        $data->save();

         $response_data=[
            'success' => 1,
            'message' => 'successfully blocked.',
            //'data' => $user
           ];
            
        }

        return response()->json($response_data,  $this->successStatus);
    }
    
     public function unBlockUser(Request $request)
    {
        $auth_user_id = Auth::user()->id;
        $roomId = $request->room_id;

        $find = ChatRoomParticipant::where('user_id','!=',$auth_user_id)->where('room_id',$roomId)->first();
        if($find->status=='Active'){

            $response_data=[
            'success' => 0,
            'message' => 'Already UnBlocked.',
            //'data' => $user
           ];
        }else{

        $data = ChatRoomParticipant::where('user_id','!=',$auth_user_id)->where('room_id',$roomId)->first();
        $data->status = 'Active';
        $data->save();

         $response_data=[
            'success' => 1,
            'message' => 'successfully UnBlocked.',
            //'data' => $user
           ];
            
        }

        return response()->json($response_data,  $this->successStatus);
    }


    public function getMessages(Request $request){
        $auth_user_id = Auth::user()->id;
        $room_id =  $request->room_id;
        $delete = MessageDelete::where('room_id', $room_id)->where('user_id','=',$auth_user_id)->pluck('chat_room_feeds_id');
        $data = ChatRoomFeed::where('room_id',$room_id)->whereNotIn('id',$delete)->orderBy('id', 'desc')->paginate(10); 
        
        ChatRoomFeed::where('room_id',$room_id)->where('sender_id','!=',$auth_user_id)->whereNotIn('id',$delete)->update(['markasread' => 1]);;    
      
             
        if(count($data)>0){
            return new ChatRoomFeedCollection($data);
        }
        else{
            $response_data=[
                'success' => 0,
                'message' => 'Data Not Found.'
            ];
            //return response()->json(['error'=>'Unauthorised'], 401);
            return response()->json($response_data,  $this->successStatus);
        }
    }

    public function getUsersChatRooms()
    {
        $auth_user_id = Auth::user()->id;
        $delete = MessageDelete::where('user_id','=',$auth_user_id)->pluck('chat_room_feeds_id');
        $room_id = ChatRoomFeed::whereNotIn('id',$delete)->pluck('room_id');    

        $data = ChatRoom::whereIN('id',$room_id)->whereHas('participants', function ($query) use ($auth_user_id) {
            $query->where('user_id', '=', $auth_user_id);
        })->orderBy('id', 'desc')->paginate(8);

        if(count($data)>0){
            return new ParticipantCollection($data);
        }
        else{
            $response_data=[
                'success' => 0,
                'message' => 'Data Not Found.'
            ];
            //return response()->json(['error'=>'Unauthorised'], 401);
            return response()->json($response_data,  $this->successStatus);
        }
    }


    public function deleteMessages(Request $request)
    {
        $auth_user_id = Auth::user()->id;
        $messageId = $request->message_id;
        $roomId = $request->room_id;


        $find =MessageDelete::where('user_id',$auth_user_id)->where('chat_room_feeds_id',$messageId)->first();
        if($find){

            $response_data=[
            'success' => 0,
            'message' => 'Already deleted.',
            //'data' => $user
           ];
        }else{

        $data = new MessageDelete;
        $data->user_id = $auth_user_id;
        $data->chat_room_feeds_id = $messageId;
        $data->room_id = $roomId;
        $data->save();

         $response_data=[
            'success' => 1,
            'message' => 'successfully deleted.',
            //'data' => $user
           ];
            
        }

        return response()->json($response_data,  $this->successStatus);
    }

    public function chatRoomsDelete(Request $request)
    {
        $auth_user_id = Auth::user()->id;
        $roomId = $request->room_id;
        $messageIds = ChatRoomFeed::where('room_id',$roomId)->pluck('id'); 

        
        foreach ($messageIds as $messageId) {
        
            $find =MessageDelete::where('user_id',$auth_user_id)->where('chat_room_feeds_id',$messageId)->first();
            if($find){
            }else{

            $data = new MessageDelete;
            $data->user_id = $auth_user_id;
            $data->chat_room_feeds_id = $messageId;
            $data->room_id = $roomId;
            $data->save();

            }
        }

        if($data){
              
            $response_data=[
                'success' => 1,
                'message' => 'successfully deleted.',
                //'data' => $user
            ];

        }else{

            $response_data=[
            'success' => 0,
            'message' => 'Already deleted.',
            //'data' => $user
           ];
        }
        return response()->json($response_data,  $this->successStatus);

    }

    public function reportUser(Request $request)
    {
        $auth_user_id = Auth::user()->id;
        $userId = $request->user_id;

        $find = ReportUser::where('user_id','=',$auth_user_id)->where('reported_user_id',$userId)->first();
        if($find){

            $response_data=[
            'success' => 0,
            'message' => 'Already Reported.',
            //'data' => $user
           ];
        }else{

        $data = new ReportUser;
        $data->user_id = $auth_user_id;
        $data->reported_user_id = $userId;
        $data->save();

         $response_data=[
            'success' => 1,
            'message' => 'successfully Reported.',
            //'data' => $user
           ];
            
        }

        return response()->json($response_data,  $this->successStatus);
    }
    
    
    public function getNotification(){
        $auth_user_id = Auth::user()->id;
        $notifications = Auth::user()->Notifications()->paginate(10); 
       // dd($notifications);
        if(count($notifications)>0){
            return AllNotificationResource::collection($notifications);
           // return new AllNotificationCollection($notifications);
        }
        else{
            $response_data=[
                'success' => 0,
                'message' => 'Data Not Found.'
            ];
            //return response()->json(['error'=>'Unauthorised'], 401);
            return response()->json($response_data,  $this->successStatus);
        }
    }
    
     public function readNotification()
    {
        $auth_user_id = Auth::user()->id;
        
       $find = Notification::where('notifiable_id',$auth_user_id)->update(['read_at' => date("Y-m-d h:i:s")]);   
        if($find){
            
            $response_data=[
            'success' => 1,
            'message' => 'successfully read.',
            //'data' => $user
           ];
           
        }else{


            $response_data=[
            'success' => 0,
            'message' => 'Error.',
            //'data' => $user
           ];
         
            
        }

        return response()->json($response_data,  $this->successStatus);
    }
    
    public function getBlockUser(){
        $auth_user_id = Auth::user()->id;
        
         $chatroomId = ChatRoom::where('room_type', 'Normal')->whereHas('participants', function ($query) use ($auth_user_id) {
            $query->where('user_id', '=', $auth_user_id);
           // $query->where('status', '=', 'Block');
        })
        ->with('participants')
            ->pluck('id');
           
         $blockUser = ChatRoomParticipant::where('user_id','!=',$auth_user_id)->whereIN('room_id',$chatroomId)->where('status', 'Block')->paginate(10);
       
        // if(count($blockUser)>0){
            
        //     $data = User::whereIN('id',$blockUser)->orderBy('id', 'desc')->paginate(10);
        
            if(count($blockUser)>0){
                return new BlockParticipantCollection($blockUser);
            }
            else{
                $response_data=[
                    'success' => 0,
                    'message' => 'Data Not Found.'
                ];
                //return response()->json(['error'=>'Unauthorised'], 401);
                return response()->json($response_data,  $this->successStatus);
            }
        
        // }else{
            
        //     $response_data=[
        //             'success' => 0,
        //             'message' => 'Data Not Found.'
        //         ];
        //         //return response()->json(['error'=>'Unauthorised'], 401);
        //         return response()->json($response_data,  $this->successStatus);

            
        // }
    }
    
}
