<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use Storage;
use DateTime;
class ShortlistResource extends JsonResource
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
        if($this->shortlist->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$this->shortlist->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$this->shortlist->id.'/'.$this->shortlist->avatar);

        }

        $bday = new DateTime($this->shortlist->date_of_birth); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        //dd($diff);
        $age = $diff->y.' years'; 

        return [
            'id'=> $this->shortlist->id,
            'name'=> $this->shortlist->name,
            'gender'=> $this->shortlist->gender,
            'mobile'=> $this->shortlist->mobile,
            'avatar' => $Avatarurl,
            'age' => $age,
            'religion'=> $this->shortlist->religion,
            'my_city'=> $this->shortlist->my_city,
            'my_country'=> $this->shortlist->my_country,
            'my_height'=> $this->shortlist->my_height,
            'education'=> $this->shortlist->education,
            'education_field'=> $this->shortlist->education_field,
            'my_occupation'=> $this->shortlist->my_occupation,
            'earn_point'=> $this->shortlist->earn_point,

        ];
       // return parent::toArray($request);
    }
}
