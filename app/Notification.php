<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

// 	use LogsActivity;

// 	protected static $logAttributes = ['type', 'notifiable_type' , 'notifiable_id' , 'data' ,'read_at','created_at','updated_at','notifiable'];
//     protected static $logOnlyDirty = true;
 
     protected $fillable = [
        'greeting', 'body', 'actionText', 'thanks', 'actionURL', 'message_id', 'data', 'created_by'
    ];
    
}

