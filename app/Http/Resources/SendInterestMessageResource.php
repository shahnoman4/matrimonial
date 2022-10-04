<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use Storage;
use DateTime;
use Auth;
class SendInterestMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       
        $user_name = Auth::user()->name;
        return [
            'title'=> $user_name.' '.'is interested within you',
            'description'=> $user_name.' '.'is interested within you',
           
        ];
       // return parent::toArray($request);
    }
}
