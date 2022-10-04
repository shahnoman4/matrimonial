<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use URL;
use Hash;
use App\models\Setting;



class SettingController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    
    public function storeSetting(Request $request){
         
       $user = Auth::user();
       $validator = Validator::make($request->all(), [
            'interest_email_sent' => 'required',
            'interest_notification_sent' => 'required',
            'message_email_sent' => 'required',
            'message_notification_sent' => 'required',
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }

       
       $setting =  Setting::where('user_id',$user->id)->first();

       if ($setting) {

            $data =  Setting::where('user_id',$user->id)->first();
            $data->user_id = $user->id;
            $data->interest_email_sent = $request->interest_email_sent;
            $data->interest_notification_sent =$request->interest_notification_sent;
            $data->message_email_sent =$request->message_email_sent;
            $data->message_notification_sent =$request->message_notification_sent;
            $data->save();
            $response_data=[
            'success' => 1,
            'message' => 'Data Saved.',
            'data' => $data
        ];
        return response()->json($response_data, $this->successStatus);

        }else{
            
            $data = new Setting;
            $data->user_id = $user->id;
            $data->interest_email_sent = $request->interest_email_sent;
            $data->interest_notification_sent =$request->interest_notification_sent;
            $data->message_email_sent =$request->message_email_sent;
            $data->message_notification_sent =$request->message_notification_sent;
            $data->save();

      
        $response_data=[
            'success' => 1,
            'message' => 'Data Saved.',
            'data' => $data
        ];
        return response()->json($response_data, $this->successStatus);

        }
    }      

    
}
