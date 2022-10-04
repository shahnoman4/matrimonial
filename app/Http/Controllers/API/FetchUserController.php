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
use App\Http\Resources\AllUserResource as AllUserResource;
use App\Http\Resources\ReceivedInterestResource as ReceivedInterestResource;
use App\Http\Resources\SendInterestResource as SendInterestResource;
use App\Http\Resources\ReceivedInterestCollection;
use App\Http\Resources\SendInterestCollection;
use App\Http\Resources\ShortlistCollection;
use App\Http\Resources\AllUserCollection;
use App\models\Interest;
use App\models\Shortlist;
use App\Events\InterestNotification;
use Carbon\Carbon;


class FetchUserController extends Controller
{
    public $successStatus = 200;
    /**
     * User api
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $user = Auth::user();
        $search = $request->search;
        if(isset($search) && ($search !="") )
        {
          $data   = User::where('id','!=',$userId)->where('role_id',3)->where( function($q) use ($search) {
              
                       $q->where('name',$search);
                       $q->where('gender',$search);
                       $q->where('date_of_birth',$search);
                       $q->where('my_city',$search);
                       $q->where('my_country',$search);
                       $q->where('religion',$search);
                       //$q->where('name', 'LIKE', '%' . $search . '%');
                       
                    })->where('status',1)->orderBy('id', 'desc')->paginate(10);

            if(count($data)>0){
                return new AllUserCollection($data);
            }
            else{
                $response_data=[
                    'success' => 0,
                    'message' => 'Data Not Found.'
                ];
                return response()->json($response_data,  $this->successStatus);
            }
            
        }else{
                $response_data=[
                    'success' => 0,
                    'message' => 'Data Not Found.'
                ];
                return response()->json($response_data,  $this->successStatus);
            }
    }



    public function getUser(){
            $userId = Auth::user()->id;
            $user = Auth::user();
            $dailyRecommended = User::where('id','!=',$userId)->where('my_city','!=','')->where('my_height','!=','')->where('education','!=','')->where('gender','!=',$user->gender)->where('my_country','=',$user->my_country_choice)->where('role_id',3)->where('status',1)->orderBy('id', 'desc')->limit(5)->get();
            // $dailyRecommended = User::where('id','=','259')->where('role_id',3)->where('status',1)->orderBy('id', 'desc')->limit(5)->get();
            $myMatches = User::where('id','!=',$userId)->where('my_city','!=','')->where('my_height','!=','')->where('education','!=','')->where('gender','!=',$user->gender)->where('my_country_choice','=',$user->my_country_choice)->where('role_id',3)->where('status',1)->count();
            $new = User::where('id','!=',$userId)->where('role_id',3)->where('my_city','!=','')->where('my_height','!=','')->where('education','!=','')->orderBy('id', 'desc')->where('status',1)->limit(5)->get();
            $feature = User::where('id','!=',$userId)->whereDate('created_at', '>', Carbon::now()->subDays(30))->where('my_country','=',$user->my_country_choice)->where('my_city','!=','')->where('my_height','!=','')->where('education','!=','')->where('role_id',3)->where('status',1)->orderBy('id', 'desc')->limit(5)->get();
            $interstedRecevied = Interest::where('interested_user_id',$userId)->count();
            $shortlisted = Shortlist::where('user_id',$userId)->count();
            $interstedSend = Interest::where('user_id',$userId)->count();
            $totalNew = User::where('id','!=',$userId)->where('my_city','!=','')->where('my_height','!=','')->where('education','!=','')->whereDate('created_at', '>', Carbon::now()->subDays(30))->where('role_id',3)->where('status',1)->count();
            $totalFeature = User::where('id','!=',$userId)->where('my_city','!=','')->where('my_height','!=','')->where('education','!=','')->whereDate('created_at', '>', Carbon::now()->subDays(30))->where('my_country','=',$user->my_country_choice)->where('role_id',3)->where('status',1)->count();
            $totalDailyRecommended = User::where('id','!=',$userId)->where('my_city','!=','')->where('my_height','!=','')->where('education','!=','')->where('gender','!=',$user->gender)->where('my_country','=',$user->my_country_choice)->where('role_id',3)->where('status',1)->count();
            
            $totalNotification = Auth::user()->Notifications()->where('read_at',NULL)->count();
            //dd($user);
            $response_data=[
                'success' => 1,
                'message' => 'Login success.',
                'dailyRecommended' =>  AllUserResource::collection($dailyRecommended),
                'feature' => AllUserResource::collection($feature),
                'new' => AllUserResource::collection($new),
                'interstedSend' => $interstedSend,
                'interstedRecevied' => $interstedRecevied,
                'shortlisted' => $shortlisted,
                'myMatches' => $myMatches,
                'totalNew' => $totalNew,
                'totalFeature' => $totalFeature,
                'totalDailyRecommended' => $totalDailyRecommended,
                'totalNotification' => $totalNotification
            ];

        if($response_data){
            return response()->json($response_data, $this->successStatus);
        }
        
        else{
            $response_data=[
                'success' => 0,
                'message' => 'Data Not Found.'
            ];
            //return response()->json(['error'=>'Unauthorised'], 401);
            return response()->json($response_data,  $this->successStatus);
        }
    }


    public function getNewUser(){
        $userId = Auth::user()->id;
        $data = User::where('id','!=',$userId)->where('role_id',3)->where('my_city','!=','')->where('my_height','!=','')->where('education','!=','')->whereDate('created_at', '>', Carbon::now()->subDays(30))->where('status',1)->orderBy('id', 'desc')->paginate(10);

        if(count($data)>0){
            return new AllUserCollection($data);
        }
        else{
            $response_data=[
                'success' => 0,
                'message' => 'Data Not Found.'
            ];
            //return response()->json(['error'=>'Unauthorised'], 401);
            return response()->json($response_data,  $this->successStatus);
        }
    }


    public function getFeatureUser(){
        $userId = Auth::user()->id;
        $user = Auth::user();
        $data = User::where('id','!=',$userId)->where('role_id',3)->whereDate('created_at', '>', Carbon::now()->subDays(30))->where('my_country','=',$user->my_country_choice)->where('my_city','!=','')->where('my_height','!=','')->where('education','!=','')->where('status',1)->orderBy('id', 'desc')->paginate(10);

        if(count($data)>0){
            return new AllUserCollection($data);
        }
        else
        {
            $response_data=[
                'success' => 0,
                'message' => 'Data Not Found.'
            ];
            //return response()->json(['error'=>'Unauthorised'], 401);
            return response()->json($response_data,  $this->successStatus);
        }
    }

    public function getDailyRecommendedUser(){
        $user = Auth::user();
        $data = User::where('id','!=',$user->id)->where('my_city','!=','')->where('my_height','!=','')->where('education','!=','')->where('gender','!=',$user->gender)->where('my_country','=',$user->my_country_choice)->where('role_id',3)->where('status',1)->orderBy('id', 'desc')->paginate(10);
        //dd($data);
        if(count($data)>0){
            return new AllUserCollection($data);
        }
        else
        {
            $response_data=[
                'success' => 0,
                'message' => 'Data Not Found.'
            ];
            
            return response()->json($response_data,  $this->successStatus);
        }
    }
    
    public function getMyMatchesUser(){
        $user = Auth::user();
        $data = User::where('id','!=',$user->id)->where('my_city','!=','')->where('my_height','!=','')->where('education','!=','')->where('gender','!=',$user->gender)->where('my_country_choice','=',$user->my_country_choice)->where('role_id',3)->where('status',1)->orderBy('id', 'desc')->paginate(10);
        //dd($data);
        if(count($data)>0){
            return new AllUserCollection($data);
        }
        else
        {
            $response_data=[
                'success' => 0,
                'message' => 'Data Not Found.'
            ];
            
            return response()->json($response_data,  $this->successStatus);
        }
    }
    
    
    public function getSendInterest(){
        $user = Auth::user();
        $data = Interest::where('user_id',$user->id)->orderBy('id', 'desc')->paginate(10);

        if(count($data)>0){
            return new SendInterestCollection($data);
        }
        else{
            $response_data=[
                'success' => 0,
                'message' => 'Data Not Found.'
            ];
            //return response()->json(['error'=>'Unauthorised'], 401);
            return response()->json($response_data,  $this->successStatus);
        }
    }


    public function getReceivedInterest(){
        $user = Auth::user();
        $data = Interest::where('interested_user_id',$user->id)->orderBy('id', 'desc')->paginate(10);
       
        if(count($data)>0){
            return new ReceivedInterestCollection($data);
        }
        else{
            $response_data=[
                'success' => 0,
                'message' => 'Data Not Found.'
            ];
            //return response()->json(['error'=>'Unauthorised'], 401);
            return response()->json($response_data,  $this->successStatus);
        }
    }

    public function storeInterest(Request $request){
          
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'interested_user_id' => 'required',
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }

        $find =  Interest::where('user_id',$user->id)->where('interested_user_id',$request->interested_user_id)->first();
        if($find){

            $response_data=[
            'success' => 0,
            'message' => 'Already Interested.',
            //'data' => $user
           ];
        }else{

        $data = new Interest;
        $data->user_id = $user->id;
        $data->interested_user_id = $request->interested_user_id;
        $data->status = 'Active';
        $data->save();

        

         $response_data=[
            'success' => 1,
            'message' => 'successfully Interested.',
            //'data' => $user
           ];

           broadcast(new InterestNotification($data));
            
        }
        
       
       return response()->json($response_data, $this->successStatus);
    
    }


    public function getShortlist(){
        $user = Auth::user();
        $data = Shortlist::where('user_id',$user->id)->paginate(10);

        if(count($data)>0){
            return new ShortlistCollection($data);
        }
        else{
            $response_data=[
                'success' => 0,
                'message' => 'Data Not Found.'
            ];
            //return response()->json(['error'=>'Unauthorised'], 401);
            return response()->json($response_data,  $this->successStatus);
        }
    }

    public function storeShortlist(Request $request){
          
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'shortlisted_user_id' => 'required',
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }
        
        $find =  Shortlist::where('user_id',$user->id)->where('shortlisted_user_id',$request->shortlisted_user_id)->first();
        if($find){

            $response_data=[
            'success' => 0,
            'message' => 'Already Shortlisted.',
            //'data' => $user
           ];
        }else{

        $data = new Shortlist;
        $data->user_id = $user->id;
        $data->shortlisted_user_id = $request->shortlisted_user_id;
        $data->status = 'Active';
        $data->save();

         $response_data=[
            'success' => 1,
            'message' => 'successfully Shortlisted.',
            //'data' => $user
           ];
            
        }
       
       return response()->json($response_data, $this->successStatus);
    
    }
    
}

