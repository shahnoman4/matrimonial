<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_title','permission','permissions',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /*protected $hidden = [
        'password', 'remember_token',
    ];*/

    protected $dates = [
        'created_at',
        'updated_at'
    ];
    
    public function createdby(){
        return $this->belongsTo(User::class, 'user_id', 'id' );
      }
      
      public function modifiedby(){
        return $this->belongsTo( User::class, 'last_modified_by', 'id' );
      }

    public function hasAccess(array $permissions)
    {
        foreach($permissions as $permission){
            if($this->hasPermission($permission)){
                return true;
            }
        }
        return false;
    }

    public function hasPermission(string $permission)
    {
        
        $permissions = json_decode($this->permissions,true);
        return $permissions[$permission]??false;
        
    }
}

