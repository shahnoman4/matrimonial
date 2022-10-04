<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use Storage;
use DateTime;
class ReceivedInterestResource extends JsonResource
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
        if($this->receivedInterest->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$this->receivedInterest->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$this->receivedInterest->id.'/'.$this->receivedInterest->avatar);

        }

        $bday = new DateTime($this->receivedInterest->date_of_birth); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        //dd($diff);
        $age = $diff->y.' years'; 

        return [
            'id'=> $this->receivedInterest->id,
            'name'=> $this->receivedInterest->name,
            'gender'=> $this->receivedInterest->gender,
            'mobile'=> $this->receivedInterest->mobile,
            'avatar' => $Avatarurl,
            'age' => $age,
            'religion'=> $this->receivedInterest->religion,
            'my_city'=> $this->receivedInterest->my_city,
            'my_country'=> $this->receivedInterest->my_country,
            'my_height'=> $this->receivedInterest->my_height,
            'education'=> $this->receivedInterest->education,
            'education_field'=> $this->receivedInterest->education_field,
            'my_occupation'=> $this->receivedInterest->my_occupation,
            'earn_point'=> $this->receivedInterest->earn_point,

        ];
       // return parent::toArray($request);
    }
}
