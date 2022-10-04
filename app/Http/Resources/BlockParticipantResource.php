<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use Storage;
use DateTime;
use Auth;
use App\models\ChatRoomParticipant;
class BlockParticipantResource extends JsonResource
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
        $id="";
        $gender="";
        $mobile="";
        $age="";
        $religion="";
        $my_city="";
        $my_country="";
        $my_height="";
        $education="";
        $education_field="";
        $my_occupation="";
                   
           // foreach($this->participants as $user){
                if($this->user_id!=auth()->user()->id && $this->user_id!=0 && $this->user_id!=NULL && $this->status=='Block'){
                    $user_name = ($this->users->name) ? $this->users->name : '';
                    $id = ($this->users->id) ? $this->users->id : '';
                    $gender = ($this->users->gender) ? $this->users->gender : '';
                    $mobile = ($this->users->mobile) ? $this->users->mobile : '';
                    $age = ($this->users->age) ? $this->users->age : '';
                    $religion = ($this->users->religion) ? $this->users->religion : '';
                    $my_city = ($this->users->my_city) ? $this->users->my_city : '';
                    $my_country = ($this->users->my_country) ? $this->users->my_country : '';
                    $my_height = ($this->users->my_height) ? $this->users->my_height : '';
                    $education = ($this->users->education) ? $this->users->education : '';
                    $education_field = ($this->users->education_field) ? $this->users->education_field : '';
                    $my_occupation = ($this->users->my_occupation) ? $this->users->my_occupation : '';
                     if($this->users->avatar=='placeholder.png'){
                            $user_avatar=URL::to('/').Storage::disk('local')->url('public/users/'.$this->users->avatar);
                        }else{
                            $user_avatar=URL::to('/').Storage::disk('local')->url('public/users/'.$this->users->id.'/'.$this->users->avatar);

                        }
                }
           // }
        
        
       
        return [
            'room_id'=>$this->room_id,
            'id'=>$id,
            'name'=>   $user_name ,
            'gender'=>$gender,
            'mobile'=>$mobile,
            'avatar'=> $user_avatar,
            'age' =>$age,
            'religion'=> $religion,
            'my_city'=> $my_city,
            'my_country'=> $my_country,
            'my_height'=> $my_height,
            'education'=> $education,
            'education_field'=> $education_field,
            'my_occupation'=> $my_occupation,
        ];
    }
}
