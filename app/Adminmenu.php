<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adminmenu extends Model
{
    
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menutitle','parentid', 'showinnav', 'setasdefault', 'iconclass', 'urllink', 'displayorder',
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
    
    public function children(){
        return $this->hasMany( self::class, 'parentid', 'id' );
    }

    public function childrenformenu(){
        return $this->hasMany( self::class, 'parentid', 'id' )->where('showinnav', 1);
    }
      
      public function parent(){
        return $this->hasOne( self::class, 'id', 'parentid' );
      }

}
