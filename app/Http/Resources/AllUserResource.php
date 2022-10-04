<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use Storage;
use DateTime;
use App\models\Shortlist;
use Auth;
use Cache;

class AllUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       
        //return parent::toArray($request);
        if($this->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$this->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$this->id.'/'.$this->avatar);
            //$Avatarurl = asset('storage/app/public/'.$this->id.'/'.$this->avatar);

        }
        
        $userId = Auth::user()->id;
        
        $data = Shortlist::where('user_id',$userId)->where('shortlisted_user_id',$this->id)->first();
        if($data){
            
            $shortlist = 'Yes';
            
        }else{
            
            $shortlist = 'No';
        }

        $bday = new DateTime($this->date_of_birth); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        //dd($diff);
        $age = $diff->y.' years'; 
        
         if(Cache::has('user-is-online-' . $this->id)){
            
            $status = 'online';
        }else{
            $status = 'offline';
        }

        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'gender'=> $this->gender,
            'mobile'=> $this->mobile,
            'avatar' => $Avatarurl,
            'age' => $age,
            'religion'=> $this->religion,
            'my_city'=> $this->my_city,
            'my_country'=> $this->my_country,
            'my_height'=> $this->my_height,
            'education'=> $this->education,
            'education_field'=> $this->education_field,
            'my_occupation'=> $this->my_occupation,
            'earn_point'=> $this->earn_point,
            'shortlist'=> $shortlist,
           //  'status' => $status
        ];
       // return parent::toArray($request);
    }
}
