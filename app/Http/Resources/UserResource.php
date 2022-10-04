<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use URL;
use Storage;
use Cache;
class UserResource extends JsonResource
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
        
        if(Cache::has('user-is-online-' . $this->id)){
            
            $status = 'online';
        }else{
            $status = 'offline';
        }
        
       
    
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'email'=> $this->email,
            'mobile'=> $this->mobile,
            'earn_point'=> $this->earn_point,
            'avatar' => $Avatarurl,
            //'status' => $status

        ];
    }
}
