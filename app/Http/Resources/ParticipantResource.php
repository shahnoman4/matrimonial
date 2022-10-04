<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use Storage;
use DateTime;
use Auth;
use App\models\ChatRoomParticipant;
use App\models\ChatRoomFeed;
class ParticipantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       
         $user_avatar="";
        $user_name="";
        $user_id="";
        $status="";
        $totalMesg =0;
        if($this->room_type=='Normal'){            
            foreach($this->participants as $user){
                if($user->user_id!=auth()->user()->id && $user->user_id!=0 && $user->user_id!=NULL){
                    $user_name = ($user->users->name) ? $user->users->name : '';
                    $user_id = ($user->users->id) ? $user->users->id : '';
                    $status = ($user->status) ? $user->status : '';
                     if($user->users->avatar=='placeholder.png'){
                            $user_avatar=URL::to('/').Storage::disk('local')->url('public/users/'.$user->users->avatar);
                        }else{
                            $user_avatar=URL::to('/').Storage::disk('local')->url('public/users/'.$user->users->id.'/'.$user->users->avatar);

                        }
                }
            }
        }
        $data = ChatRoomFeed::where('room_id',$this->id)->orderBy('id', 'desc')->first();
        $unread = ChatRoomFeed::where('room_id',$this->id)->where('sender_id','!=',auth()->user()->id)->where('markasread','0')->count();
//dd($data);
       // $totalMesg =0;// UnReadMessage::where('room_id',$this->id)
                                   // ->where('user_id',auth()->user()->id)
                                   // ->count();
        if(isset($data->message)  && $data->message!='') {

            $message= $data->message;
        }else{
            $message='';
        }

        if(isset($data->created_at)  && $data->created_at!='') {

            $created_at= $data->created_at->diffForHumans();
        }else{
            $created_at='';
        }
        return [
            'room_id'=>$this->id,
           // 'room_type'=>$this->room_type,
            'user_id'=>   $user_id ,
            'name'=>   $user_name ,
            'totalMesg'=>$unread,
            'lastMessage' =>$message,
            'created_at'=> $created_at,
            'user_avatar'=> $user_avatar,
            'status'=>$status,
        ];
    }
}
