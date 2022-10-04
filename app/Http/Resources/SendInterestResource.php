<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use Storage;
use DateTime;
class SendInterestResource extends JsonResource
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
        if($this->sendInterest->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$this->sendInterest->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$this->sendInterest->id.'/'.$this->sendInterest->avatar);

        }

        $bday = new DateTime($this->sendInterest->date_of_birth); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        //dd($diff);
        $age = $diff->y.' years'; 

        return [
            'id'=> $this->sendInterest->id,
            'name'=> $this->sendInterest->name,
            'gender'=> $this->sendInterest->gender,
            'mobile'=> $this->sendInterest->mobile,
            'avatar' => $Avatarurl,
            'age' => $age,
            'religion'=> $this->sendInterest->religion,
            'my_city'=> $this->sendInterest->my_city,
            'my_country'=> $this->sendInterest->my_country,
            'my_height'=> $this->sendInterest->my_height,
            'education'=> $this->sendInterest->education,
            'education_field'=> $this->sendInterest->education_field,
            'my_occupation'=> $this->sendInterest->my_occupation,
            'earn_point'=> $this->sendInterest->earn_point,

        ];
       // return parent::toArray($request);
    }
}
