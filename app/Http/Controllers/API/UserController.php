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
use DateTime;
use App\Http\Resources\UserResource as UserResource;
use Lcobucci\JWT\Parser;
use Illuminate\Support\Facades\Mail;
use DB;
use App\models\Interest;
use App\models\ChatRoomFeed;
use App\models\ChatRoomParticipant;
use App\models\ChatRoom;

class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['mobile' => request('mobile'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['user'] = new UserResource($user);

             //dd($success['user']);
            $response_data=[
                'success' => 1,
                'message' => 'Login success.',
                'data' => $success
            ];
            //return response()->json(['success' => $success], $this->successStatus);
            return response()->json($response_data, $this->successStatus);
        }
        else{
            $response_data=[
                'success' => 0,
                'message' => 'Invalid mobile no or password, please try again.'
            ];
            //return response()->json(['error'=>'Unauthorised'], 401);
            return response()->json($response_data,  $this->successStatus);
        }
    }
    
   //redis 
public function logout(Request $request) {
    $value = $request->bearerToken();
    //dd($value);
    $id= (new Parser())->parse($value)->getHeader('jti');
    $token= $request->user()->tokens->find($id);
    $token->revoke();
    
    if($token){
     $response_data=[
            'success' => 1,
            'message' => 'You have been successfully logged out!',
        ];
         return response()->json($response_data,  $this->successStatus);
    }else{
        
        
        $response_data=[
            'success' => 0,
            'message' => 'Invalid token.'
        ];
         return response()->json($response_data,  $this->successStatus);
    }        

       

}

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            //'gender' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|numeric|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }
        $input = $request->all();
        //dd($input);
        $input['password'] = bcrypt($input['password']);
        $input['role_id'] = 3;
        $input['status'] = 1;
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $users = User::findOrFail($user->id);
        //dd(Auth::user());
        //$success['user'] =$users;
        $this->sendRegEmail($users);
        $success['user'] = new UserResource($users);
        $response_data=[
            'success' => 1,
            'message' => 'Your are register successfully.',
            'data' => $success
        ];
        return response()->json($response_data, $this->successStatus);
    }
     /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    
    public function details(Request  $request)
    {
        $users = Auth::user();
        $user = User::findOrFail($request->id);
        if($user->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->id.'/'.$user->avatar);
        }
        $user['avatar']=$Avatarurl;
        $user['email_verified_at']=($user['email_verified_at']!==null) ? $user['email_verified_at'] : '';
        //$user['longitude']=($user['longitude']!== null) ? $user['longitude'] : '';
        //$user['latitude']=($user['latitude']!==null) ? $user['latitude'] : '';
       $bday = new DateTime($user->date_of_birth); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        //dd($diff);
       $user['age'] = $diff->y.' years'; 
       $my_choice_visa = explode(",",$user->my_choice_visa);
       $user['my_choice_visa']=$my_choice_visa;
       $my_choice_physique = explode(",",$user->my_choice_physique);
       $user['my_choice_physique']=$my_choice_physique;
       $my_choice_complexion = explode(",",$user->my_choice_complexion);
       $user['my_choice_complexion']=$my_choice_complexion;
       $my_choice_hair_color = explode(",",$user->my_choice_hair_color);
       $user['my_choice_hair_color']=$my_choice_hair_color;
       $my_choice_eye_color = explode(",",$user->my_choice_eye_color);
       $user['my_choice_eye_color']=$my_choice_eye_color;
       $my_choice_economy = explode(",",$user->my_choice_economy);
       $user['my_choice_economy']=$my_choice_economy;
       $my_choice_marital_status = explode(",",$user->my_choice_marital_status);
       $user['my_choice_marital_status']=$my_choice_marital_status;
       $my_choice_children = explode("@",$user->my_choice_children);
       $user['my_choice_children']=$my_choice_children;
       $my_choice_family = explode(",",$user->my_choice_family);
       $user['my_choice_family']=$my_choice_family;
       $my_choice_living_arrangement = explode(",",$user->my_choice_living_arrangement);
       $user['my_choice_living_arrangement']=$my_choice_living_arrangement;
       $my_choice_raised = explode(",",$user->my_choice_raised);
       $user['my_choice_raised']=$my_choice_raised;
       $my_choice_hijab = explode(",",$user->my_choice_hijab);
       $user['my_choice_hijab']=$my_choice_hijab;
       $my_choice_smoke = explode(",",$user->my_choice_smoke);
       $user['my_choice_smoke']=$my_choice_smoke;
       $my_choice_drink = explode(",",$user->my_choice_drink);
       $user['my_choice_drink']=$my_choice_drink;
       $my_choice_disability = explode(",",$user->my_choice_disability);
       $user['my_choice_disability']=$my_choice_disability;
       $interest = explode(",",$user->interest);
       $user['interest']=$interest;
       $my_personality = explode(",",$user->my_personality);
       $user['my_personality']=$my_personality;
       
       $find =  Interest::where('user_id',$users->id)->where('interested_user_id',$user->id)->first();
           if($find){
               
            $user['interestSent'] = 'Yes';
            
           }else{
               
            $user['interestSent'] = 'No';
               
           }
        $response_data=[
            'success' => 1,
            'message' => 'User data received.',
            'data' => $user
        ];
        return response()->json($response_data, $this->successStatus);
    }

    public function loginUserdetails()
    {
        $user = Auth::user();
        if($user->avatar){
        if($user->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->id.'/'.$user->avatar);
        }
        }else{
            $Avatarurl='';
        }
        $user['avatar']=$Avatarurl;
        $user['email_verified_at']=($user['email_verified_at']!==null) ? $user['email_verified_at'] : '';
        //$user['longitude']=($user['longitude']!== null) ? $user['longitude'] : '';
        //$user['latitude']=($user['latitude']!==null) ? $user['latitude'] : '';
        $bday = new DateTime($user->date_of_birth); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        //dd($diff);
        $user['age'] = $diff->y.' years';
        $my_choice_visa = explode(",",$user->my_choice_visa);
       $user['my_choice_visa']=$my_choice_visa;
       $my_choice_physique = explode(",",$user->my_choice_physique);
       $user['my_choice_physique']=$my_choice_physique;
       $my_choice_complexion = explode(",",$user->my_choice_complexion);
       $user['my_choice_complexion']=$my_choice_complexion;
       $my_choice_hair_color = explode(",",$user->my_choice_hair_color);
       $user['my_choice_hair_color']=$my_choice_hair_color;
       $my_choice_eye_color = explode(",",$user->my_choice_eye_color);
       $user['my_choice_eye_color']=$my_choice_eye_color;
       $my_choice_economy = explode(",",$user->my_choice_economy);
       $user['my_choice_economy']=$my_choice_economy;
       $my_choice_marital_status = explode(",",$user->my_choice_marital_status);
       $user['my_choice_marital_status']=$my_choice_marital_status;
       $my_choice_children = explode("@",$user->my_choice_children);
       $user['my_choice_children']=$my_choice_children;
       $my_choice_family = explode(",",$user->my_choice_family);
       $user['my_choice_family']=$my_choice_family;
       $my_choice_living_arrangement = explode(",",$user->my_choice_living_arrangement);
       $user['my_choice_living_arrangement']=$my_choice_living_arrangement;
       $my_choice_raised = explode(",",$user->my_choice_raised);
       $user['my_choice_raised']=$my_choice_raised;
       $my_choice_hijab = explode(",",$user->my_choice_hijab);
       $user['my_choice_hijab']=$my_choice_hijab;
       $my_choice_smoke = explode(",",$user->my_choice_smoke);
       $user['my_choice_smoke']=$my_choice_smoke;
       $my_choice_drink = explode(",",$user->my_choice_drink);
       $user['my_choice_drink']=$my_choice_drink;
       $my_choice_disability = explode(",",$user->my_choice_disability);
       $user['my_choice_disability']=$my_choice_disability;
       $interest = explode(",",$user->interest);
       $user['interest']=$interest;
       $my_personality = explode(",",$user->my_personality);
       $user['my_personality']=$my_personality;
        $response_data=[
            'success' => 1,
            'message' => 'Profile data received.',
            'data' => $user
        ];
        return response()->json($response_data, $this->successStatus);
    }

    public function uploadAvatar(Request $request)
    {

        $user = Auth::user();
        if($request->hasfile('avatar'))
        {
            
           $file = $request->file('avatar');
           $avatar=$file->getClientOriginalName();
           Storage::disk('local')->put('/public/users/'.$user->id.'/'.$avatar, File::get($file));
           $user->avatar=$avatar;
           $user->save();
            if($user->avatar=='placeholder.png'){
                $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->avatar);
            }else{
                $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->id.'/'.$user->avatar);
            }
        $user['avatar']=$Avatarurl;
        $my_choice_visa = explode(",",$user->my_choice_visa);
       $user['my_choice_visa']=$my_choice_visa;
       $my_choice_physique = explode(",",$user->my_choice_physique);
       $user['my_choice_physique']=$my_choice_physique;
       $my_choice_complexion = explode(",",$user->my_choice_complexion);
       $user['my_choice_complexion']=$my_choice_complexion;
       $my_choice_hair_color = explode(",",$user->my_choice_hair_color);
       $user['my_choice_hair_color']=$my_choice_hair_color;
       $my_choice_eye_color = explode(",",$user->my_choice_eye_color);
       $user['my_choice_eye_color']=$my_choice_eye_color;
       $my_choice_economy = explode(",",$user->my_choice_economy);
       $user['my_choice_economy']=$my_choice_economy;
       $my_choice_marital_status = explode(",",$user->my_choice_marital_status);
       $user['my_choice_marital_status']=$my_choice_marital_status;
       $my_choice_children = explode("@",$user->my_choice_children);
       $user['my_choice_children']=$my_choice_children;
       $my_choice_family = explode(",",$user->my_choice_family);
       $user['my_choice_family']=$my_choice_family;
       $my_choice_living_arrangement = explode(",",$user->my_choice_living_arrangement);
       $user['my_choice_living_arrangement']=$my_choice_living_arrangement;
       $my_choice_raised = explode(",",$user->my_choice_raised);
       $user['my_choice_raised']=$my_choice_raised;
       $my_choice_hijab = explode(",",$user->my_choice_hijab);
       $user['my_choice_hijab']=$my_choice_hijab;
       $my_choice_smoke = explode(",",$user->my_choice_smoke);
       $user['my_choice_smoke']=$my_choice_smoke;
       $my_choice_drink = explode(",",$user->my_choice_drink);
       $user['my_choice_drink']=$my_choice_drink;
       $my_choice_disability = explode(",",$user->my_choice_disability);
       $user['my_choice_disability']=$my_choice_disability;
       $interest = explode(",",$user->interest);
       $user['interest']=$interest;
       $my_personality = explode(",",$user->my_personality);
       $user['my_personality']=$my_personality;
           $response_data=[
            'success' => 1,
            'message' => 'Profile picture uploaded successfully.',
            'data' => $user
            ];
           return response()->json($response_data, $this->successStatus);

        }else{
            $response_data=[
                'success' => 0,
                'message' => 'Unable to upload, please try again.'
            ];
            return response()->json(['error'=>'Nothing to upload'],  $this->successStatus);
        }
    }

   /*
    *
    * update basic info
    *
    *
    */
    public function updateBasicInfo(Request $request)
    {

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'profile_created_by' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'my_city' => 'required',
            'my_choice_city' => 'required',
            'my_country' => 'required',
            'my_country_choice' => 'required',
            'religion' => 'required',
            'mother_tongue' => 'required',
            'my_visa' => 'required',
            'my_choice_visa' => 'required',
            //'email' => 'required|email|unique:users,email,'.$user->id,
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }

        $user->profile_created_by = $request->get('profile_created_by');
        $user->name               = $request->get('name');
        $user->gender             = $request->get('gender');
        $user->date_of_birth      = $request->get('date_of_birth');
        $user->my_city            = $request->get('my_city');
        $user->my_choice_city     = $request->get('my_choice_city');
        $user->my_country         = $request->get('my_country');
        $user->my_country_choice  = $request->get('my_country_choice');
        $user->religion           = $request->get('religion');
        $user->mother_tongue      = $request->get('mother_tongue');
        $user->my_visa            = $request->get('my_visa');
        //$user->my_choice_visa     = $request->get('my_choice_visa');
        $my_choice_visa = implode(",",$request->my_choice_visa);
        $user->my_choice_visa     = $my_choice_visa;
        $user->save();
        if($user->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->id.'/'.$user->avatar);
        }
       $user['avatar']=$Avatarurl;
       $my_choice_visa = explode(",",$user->my_choice_visa);
       $user['my_choice_visa']=$my_choice_visa;
       $my_choice_physique = explode(",",$user->my_choice_physique);
       $user['my_choice_physique']=$my_choice_physique;
       $my_choice_complexion = explode(",",$user->my_choice_complexion);
       $user['my_choice_complexion']=$my_choice_complexion;
       $my_choice_hair_color = explode(",",$user->my_choice_hair_color);
       $user['my_choice_hair_color']=$my_choice_hair_color;
       $my_choice_eye_color = explode(",",$user->my_choice_eye_color);
       $user['my_choice_eye_color']=$my_choice_eye_color;
       $my_choice_economy = explode(",",$user->my_choice_economy);
       $user['my_choice_economy']=$my_choice_economy;
       $my_choice_marital_status = explode(",",$user->my_choice_marital_status);
       $user['my_choice_marital_status']=$my_choice_marital_status;
       $my_choice_children = explode("@",$user->my_choice_children);
       $user['my_choice_children']=$my_choice_children;
       $my_choice_family = explode(",",$user->my_choice_family);
       $user['my_choice_family']=$my_choice_family;
       $my_choice_living_arrangement = explode(",",$user->my_choice_living_arrangement);
       $user['my_choice_living_arrangement']=$my_choice_living_arrangement;
       $my_choice_raised = explode(",",$user->my_choice_raised);
       $user['my_choice_raised']=$my_choice_raised;
       $my_choice_hijab = explode(",",$user->my_choice_hijab);
       $user['my_choice_hijab']=$my_choice_hijab;
       $my_choice_smoke = explode(",",$user->my_choice_smoke);
       $user['my_choice_smoke']=$my_choice_smoke;
       $my_choice_drink = explode(",",$user->my_choice_drink);
       $user['my_choice_drink']=$my_choice_drink;
       $my_choice_disability = explode(",",$user->my_choice_disability);
       $user['my_choice_disability']=$my_choice_disability;
       $interest = explode(",",$user->interest);
       $user['interest']=$interest;
       $my_personality = explode(",",$user->my_personality);
       $user['my_personality']=$my_personality;       
       $response_data=[
        'success' => 1,
        'message' => 'Basic Info updated successfully.',
        'data' => $user
    ];
       return response()->json($response_data, $this->successStatus);
    }

    /*
    *
    * update Appearance
    *
    *
    */
    public function updateAppearance(Request $request)
    {

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'my_physique' => 'required',
            'my_choice_physique' => 'required',
            'my_complexion' => 'required',
            'my_choice_complexion' => 'required',
            'my_hair_color' => 'required',
            'my_choice_hair_color' => 'required',
            'my_eye_color' => 'required',
            'my_choice_eye_color' => 'required',
            'my_height' => 'required',
            'my_choice_height_from' => 'required',
            'my_choice_height_to' => 'required',
            'my_choice_age_from' => 'required',
            'my_choice_age_to' => 'required',
            //'email' => 'required|email|unique:users,email,'.$user->id,
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }
        $user->my_physique             = $request->get('my_physique');
        $my_choice_physique = implode(",",$request->my_choice_physique);
        $user->my_choice_physique      = $my_choice_physique;
        $user->my_complexion           = $request->get('my_complexion');
        $my_choice_complexion = implode(",",$request->my_choice_complexion);
        $user->my_choice_complexion    = $my_choice_complexion;
        $user->my_hair_color           = $request->get('my_hair_color');
        $my_choice_hair_color = implode(",",$request->my_choice_hair_color);
        $user->my_choice_hair_color    = $my_choice_hair_color;
        $user->my_eye_color            = $request->get('my_eye_color');
        $my_choice_eye_color = implode(",",$request->my_choice_eye_color);
        $user->my_choice_eye_color     = $my_choice_eye_color;
        $user->my_height               = $request->get('my_height');
        $user->my_choice_height_from   = $request->get('my_choice_height_from');
        $user->my_choice_height_to     = $request->get('my_choice_height_to');
        $user->my_choice_age_from      = $request->get('my_choice_age_from');
        $user->my_choice_age_to        = $request->get('my_choice_age_to');
        $user->save();
        //dd($user->toarray());
        if($user->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->id.'/'.$user->avatar);
        }
       $user['avatar']=$Avatarurl;
       $my_choice_visa = explode(",",$user->my_choice_visa);
       $user['my_choice_visa']=$my_choice_visa;
       $my_choice_physique = explode(",",$user->my_choice_physique);
       $user['my_choice_physique']=$my_choice_physique;
       $my_choice_complexion = explode(",",$user->my_choice_complexion);
       $user['my_choice_complexion']=$my_choice_complexion;
       $my_choice_hair_color = explode(",",$user->my_choice_hair_color);
       $user['my_choice_hair_color']=$my_choice_hair_color;
       $my_choice_eye_color = explode(",",$user->my_choice_eye_color);
       $user['my_choice_eye_color']=$my_choice_eye_color;
       $my_choice_economy = explode(",",$user->my_choice_economy);
       $user['my_choice_economy']=$my_choice_economy;
       $my_choice_marital_status = explode(",",$user->my_choice_marital_status);
       $user['my_choice_marital_status']=$my_choice_marital_status;
       $my_choice_children = explode("@",$user->my_choice_children);
       $user['my_choice_children']=$my_choice_children;
       $my_choice_family = explode(",",$user->my_choice_family);
       $user['my_choice_family']=$my_choice_family;
       $my_choice_living_arrangement = explode(",",$user->my_choice_living_arrangement);
       $user['my_choice_living_arrangement']=$my_choice_living_arrangement;
       $my_choice_raised = explode(",",$user->my_choice_raised);
       $user['my_choice_raised']=$my_choice_raised;
       $my_choice_hijab = explode(",",$user->my_choice_hijab);
       $user['my_choice_hijab']=$my_choice_hijab;
       $my_choice_smoke = explode(",",$user->my_choice_smoke);
       $user['my_choice_smoke']=$my_choice_smoke;
       $my_choice_drink = explode(",",$user->my_choice_drink);
       $user['my_choice_drink']=$my_choice_drink;
       $my_choice_disability = explode(",",$user->my_choice_disability);
       $user['my_choice_disability']=$my_choice_disability;
       $interest = explode(",",$user->interest);
       $user['interest']=$interest;
       $my_personality = explode(",",$user->my_personality);
       $user['my_personality']=$my_personality;
     
       $response_data=[
        'success' => 1,
        'message' => 'Appearance updated successfully.',
        'data' => $user
       ];
       return response()->json($response_data, $this->successStatus);
    }

    /*
    *
    * update LifeStle
    *
    *
    */
    public function updateLifeStle(Request $request)
    {

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'education' => 'required',
            'education_field' => 'required',
            'education_field_year' => 'required',
            'my_occupation' => 'required',
            'my_choice_occupation' => 'required',
            'income_level' => 'required',
            //'caste' => 'required',
            'my_economy' => 'required',
            'my_choice_economy' => 'required',
            'marital_status' => 'required',
            'my_children' => 'required',
            'my_choice_children' => 'required',
            'my_sibling_position' => 'required',
            'no_of_brothers' => 'required',
            'no_of_sisters' => 'required',
            'my_family_values' => 'required',
            'my_choice_family' => 'required',
            'my_living_arrangement' => 'required',
            'my_choice_living_arrangement' => 'required',
            'my_raised' => 'required',
            'my_choice_raised' => 'required',
            'my_hijab' => 'required',
            'my_choice_hijab' => 'required',
            'my_smoke' => 'required',
            'my_choice_smoke' => 'required',
            'my_drink' => 'required',
            'my_choice_drink' => 'required',
            'my_disability' => 'required',
            'my_choice_disability' => 'required',
            //'email' => 'required|email|unique:users,email,'.$user->id,
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }

        $user->education               = $request->get('education');
        $user->education_field         = $request->get('education_field');
        $user->education_field_year    = $request->get('education_field_year');
        $user->my_occupation           = $request->get('my_occupation');
        $user->my_choice_occupation    = $request->get('my_choice_occupation');
        $user->income_level            = $request->get('income_level');
        $user->caste                   = $request->get('caste');
        $user->my_economy              = $request->get('my_economy');
        $my_choice_economy = implode(",",$request->my_choice_economy);
        $user->my_choice_economy       = $my_choice_economy;
        $user->marital_status          = $request->get('marital_status');
        $my_choice_marital_status = implode(",",$request->my_choice_marital_status);
        $user->my_choice_marital_status= $my_choice_marital_status;
        $user->my_children             = $request->get('my_children');
        $my_choice_children = implode("@",$request->my_choice_children);
        $user->my_choice_children      = $my_choice_children;
        $user->my_sibling_position     = $request->get('my_sibling_position');
        $user->no_of_brothers          = $request->get('no_of_brothers');
        $user->no_of_sisters           = $request->get('no_of_sisters');
        $user->my_family_values        = $request->get('my_family_values');
        $my_choice_family = implode(",",$request->my_choice_family);
        $user->my_choice_family        = $my_choice_family;
        $user->my_living_arrangement   = $request->get('my_living_arrangement');
        $my_choice_living_arrangement = implode(",",$request->my_choice_living_arrangement);
        $user->my_choice_living_arrangement= $my_choice_living_arrangement;
        $user->my_raised              = $request->get('my_raised');
        $my_choice_raised = implode(",",$request->my_choice_raised);
        $user->my_choice_raised       = $my_choice_raised;
        $user->my_hijab               = $request->get('my_hijab');
        $my_choice_hijab = implode(",",$request->my_choice_hijab);
        $user->my_choice_hijab        = $my_choice_hijab;
        $user->my_smoke               = $request->get('my_smoke');
        $my_choice_smoke = implode(",",$request->my_choice_smoke);
        $user->my_choice_smoke        = $my_choice_smoke;
        $user->my_drink               = $request->get('my_drink');
        $my_choice_drink = implode(",",$request->my_choice_drink);
        $user->my_choice_drink        = $my_choice_drink;
        $user->my_disability          = $request->get('my_disability');
        $my_choice_disability = implode(",",$request->my_choice_disability);
        $user->my_choice_disability   = $my_choice_disability;
        $user->save();
        //dd($user);
        if($user->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->id.'/'.$user->avatar);
        }
       $user['avatar']=$Avatarurl;
       $my_choice_visa = explode(",",$user->my_choice_visa);
       $user['my_choice_visa']=$my_choice_visa;
       $my_choice_physique = explode(",",$user->my_choice_physique);
       $user['my_choice_physique']=$my_choice_physique;
       $my_choice_complexion = explode(",",$user->my_choice_complexion);
       $user['my_choice_complexion']=$my_choice_complexion;
       $my_choice_hair_color = explode(",",$user->my_choice_hair_color);
       $user['my_choice_hair_color']=$my_choice_hair_color;
       $my_choice_eye_color = explode(",",$user->my_choice_eye_color);
       $user['my_choice_eye_color']=$my_choice_eye_color;
       $my_choice_economy = explode(",",$user->my_choice_economy);
       $user['my_choice_economy']=$my_choice_economy;
       $my_choice_marital_status = explode(",",$user->my_choice_marital_status);
       $user['my_choice_marital_status']=$my_choice_marital_status;
       $my_choice_children = explode("@",$user->my_choice_children);
       $user['my_choice_children']=$my_choice_children;
       $my_choice_family = explode(",",$user->my_choice_family);
       $user['my_choice_family']=$my_choice_family;
       $my_choice_living_arrangement = explode(",",$user->my_choice_living_arrangement);
       $user['my_choice_living_arrangement']=$my_choice_living_arrangement;
       $my_choice_raised = explode(",",$user->my_choice_raised);
       $user['my_choice_raised']=$my_choice_raised;
       $my_choice_hijab = explode(",",$user->my_choice_hijab);
       $user['my_choice_hijab']=$my_choice_hijab;
       $my_choice_smoke = explode(",",$user->my_choice_smoke);
       $user['my_choice_smoke']=$my_choice_smoke;
       $my_choice_drink = explode(",",$user->my_choice_drink);
       $user['my_choice_drink']=$my_choice_drink;
       $my_choice_disability = explode(",",$user->my_choice_disability);
       $user['my_choice_disability']=$my_choice_disability;
       $interest = explode(",",$user->interest);
       $user['interest']=$interest;
       $my_personality = explode(",",$user->my_personality);
       $user['my_personality']=$my_personality;
       $response_data=[
        'success' => 1,
        'message' => 'Life Stle updated successfully.',
        'data' => $user
       ];
       return response()->json($response_data, $this->successStatus);
    }


    /*
    *
    * update Interest
    *
    *
    */
    public function updateInterest(Request $request)
    {

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'interest' => 'required',
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }
        $interest = implode(",",$request->interest);
        $user->interest = $interest;
        $user->save();
        if($user->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->id.'/'.$user->avatar);
        }
       $user['avatar']=$Avatarurl;
       $my_choice_visa = explode(",",$user->my_choice_visa);
       $user['my_choice_visa']=$my_choice_visa;
       $my_choice_physique = explode(",",$user->my_choice_physique);
       $user['my_choice_physique']=$my_choice_physique;
       $my_choice_complexion = explode(",",$user->my_choice_complexion);
       $user['my_choice_complexion']=$my_choice_complexion;
       $my_choice_hair_color = explode(",",$user->my_choice_hair_color);
       $user['my_choice_hair_color']=$my_choice_hair_color;
       $my_choice_eye_color = explode(",",$user->my_choice_eye_color);
       $user['my_choice_eye_color']=$my_choice_eye_color;
       $my_choice_economy = explode(",",$user->my_choice_economy);
       $user['my_choice_economy']=$my_choice_economy;
       $my_choice_marital_status = explode(",",$user->my_choice_marital_status);
       $user['my_choice_marital_status']=$my_choice_marital_status;
       $my_choice_children = explode("@",$user->my_choice_children);
       $user['my_choice_children']=$my_choice_children;
       $my_choice_family = explode(",",$user->my_choice_family);
       $user['my_choice_family']=$my_choice_family;
       $my_choice_living_arrangement = explode(",",$user->my_choice_living_arrangement);
       $user['my_choice_living_arrangement']=$my_choice_living_arrangement;
       $my_choice_raised = explode(",",$user->my_choice_raised);
       $user['my_choice_raised']=$my_choice_raised;
       $my_choice_hijab = explode(",",$user->my_choice_hijab);
       $user['my_choice_hijab']=$my_choice_hijab;
       $my_choice_smoke = explode(",",$user->my_choice_smoke);
       $user['my_choice_smoke']=$my_choice_smoke;
       $my_choice_drink = explode(",",$user->my_choice_drink);
       $user['my_choice_drink']=$my_choice_drink;
       $my_choice_disability = explode(",",$user->my_choice_disability);
       $user['my_choice_disability']=$my_choice_disability;
       $interest = explode(",",$user->interest);
       $user['interest']=$interest;
       $my_personality = explode(",",$user->my_personality);
       $user['my_personality']=$my_personality;
       $response_data=[
        'success' => 1,
        'message' => 'Interest updated successfully.',
        'data' => $user
       ];
       return response()->json($response_data, $this->successStatus);
    }
    /*
    *
    * update Personality
    *
    *
    */
    public function updatePersonality(Request $request)
    {
        //dd($request->all());

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'my_personality' => 'required',
            'about' => 'required',
            'about_my_choice' => 'required',
            'my_strengths' => 'required',
            'my_weekness' => 'required',
            'terms_and_condition' => 'required',
            //'email' => 'required|email|unique:users,email,'.$user->id,
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }
        $my_personality = implode(",",$request->my_personality);
        $user->my_personality             = $my_personality;
        $user->about      = $request->get('about');
        $user->about_my_choice           = $request->get('about_my_choice');
        $user->my_strengths    = $request->get('my_strengths');
        $user->my_weekness           = $request->get('my_weekness');
        $user->terms_and_condition    = $request->get('terms_and_condition');
    
        $user->save();
        if($user->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->id.'/'.$user->avatar);
        }
       $user['avatar']=$Avatarurl;
       $my_choice_visa = explode(",",$user->my_choice_visa);
       $user['my_choice_visa']=$my_choice_visa;
       $my_choice_physique = explode(",",$user->my_choice_physique);
       $user['my_choice_physique']=$my_choice_physique;
       $my_choice_complexion = explode(",",$user->my_choice_complexion);
       $user['my_choice_complexion']=$my_choice_complexion;
       $my_choice_hair_color = explode(",",$user->my_choice_hair_color);
       $user['my_choice_hair_color']=$my_choice_hair_color;
       $my_choice_eye_color = explode(",",$user->my_choice_eye_color);
       $user['my_choice_eye_color']=$my_choice_eye_color;
       $my_choice_economy = explode(",",$user->my_choice_economy);
       $user['my_choice_economy']=$my_choice_economy;
       $my_choice_marital_status = explode(",",$user->my_choice_marital_status);
       $user['my_choice_marital_status']=$my_choice_marital_status;
       $my_choice_children = explode("@",$user->my_choice_children);
       $user['my_choice_children']=$my_choice_children;
       $my_choice_family = explode(",",$user->my_choice_family);
       $user['my_choice_family']=$my_choice_family;
       $my_choice_living_arrangement = explode(",",$user->my_choice_living_arrangement);
       $user['my_choice_living_arrangement']=$my_choice_living_arrangement;
       $my_choice_raised = explode(",",$user->my_choice_raised);
       $user['my_choice_raised']=$my_choice_raised;
       $my_choice_hijab = explode(",",$user->my_choice_hijab);
       $user['my_choice_hijab']=$my_choice_hijab;
       $my_choice_smoke = explode(",",$user->my_choice_smoke);
       $user['my_choice_smoke']=$my_choice_smoke;
       $my_choice_drink = explode(",",$user->my_choice_drink);
       $user['my_choice_drink']=$my_choice_drink;
       $my_choice_disability = explode(",",$user->my_choice_disability);
       $user['my_choice_disability']=$my_choice_disability;
       $interest = explode(",",$user->interest);
       $user['interest']=$interest;
       $my_personality = explode(",",$user->my_personality);
       $user['my_personality']=$my_personality;
       $response_data=[
        'success' => 1,
        'message' => 'Personality updated successfully.',
        'data' => $user
       ];
       return response()->json($response_data, $this->successStatus);
    }

    public function editProfile(Request $request)
    {

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);
        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }

        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->gender=$request->get('gender');
        $user->dob=$request->get('dob');
        $user->save();
        if($user->avatar=='placeholder.png'){
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->avatar);
        }else{
            $Avatarurl=URL::to('/').Storage::disk('local')->url('public/users/'.$user->id.'/'.$user->avatar);
        }
       $user['avatarurl']=$Avatarurl;
       $response_data=[
        'success' => 1,
        'message' => 'Profile updated successfully.',
        'data' => $user
    ];
       return response()->json($response_data, $this->successStatus);
    }

    public function changePassword(Request $request){

        $user = Auth::user();
        //Check The Current Password Matched
        if (!Hash::check($request->get('currentPassword'), $user->password)){
            $response_data=[
                'success' => 0,
                'message' => 'Current password not matched.',
            ];
            return response()->json($response_data,  $this->successStatus);
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            $response_data=[
                'success' => 0,
                'message' => 'Validation error.',
                'data' => $validator->errors()
            ];
            return response()->json($response_data,  $this->successStatus);
        }
        //bcrypt
        $user->password=Hash::make($request->get('password'));
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $user->updated_at = strtotime($format);
        $user->save();
        $response_data=[
            'success' => 1,
            'message' => 'Password changed successfully.',
        ];
        return response()->json($response_data, $this->successStatus);

    }
    
    
    
    public function forgotPassword(Request $request)
	{
	
     $validator = Validator::make($request->all(), [
        'user_email' => 'required|email'
      ]);
    if( ! $validator->fails() )
    {
        if( $user = User::where('email', $request->input('user_email') )->first() )
        {
        	//dd($user);
            $password = str_random(10);
            $hashPass = Hash::make($password);
            //dd($hashPass);
            $users = User::findOrFail($user->id);
            $users->password = $hashPass;
            $users->save();
            $this->sendEmail($user,$password);
            $success = 'We have e-mailed your new password!';
            $response_data =[
                'success' => 1,
                'message' => $success
            ];
           return response()->json($response_data);
        }else{
        	
              
            $success = 'E-mail address is Invalid!';
            $response_data =[
                'success' => 0,
                'message' => $success
            ];
            return response()->json($response_data);
        }
    }
    }
    
    private function sendEmail($user, $password)
	{
      
      
      //dd($resetcode);
	  Mail::send('emails.forgotPassword', [
	  
	  'user' => $user,
	  'password' => $password
	  ], function($message) use ($user){
		  
		  $message->to($user->email);
		  $message->subject("Dear ".$user->name.", New Password for Your Free Matrimonial Account");
		  
		  });
		  
		  //dd($mail);
	}
	
	private function sendRegEmail($user)
    {
      
      
     // dd($password);
     $mail = Mail::send('emails.register', [
    
      'user' => $user
      ], function($message) use ($user){
      
      $message->to($user->email);
      $message->subject("Welcome to free-matrimonial.com");
      
      });

     //dd($mail);
    }
	
	public function sendRegEmails()
    {
      $user = User::find(1);
      
     // dd($password);
     $mail = Mail::send('emails.register', [
    
      'user' => $user
      ], function($message) use ($user){
      
      $message->to('nomanshah434514@gmail.com');
      $message->subject("Welcome to free-matrimonial.com");
      
      });

     //dd($mail);
    }
	 
	 
	 
    public function earnPoint(){
          
        $user = Auth::user();
        if($user){
            $data = User::findOrFail($user->id);
            $data->user_id = $user->id;
            $points = $data->earn_point + 1;
            $data->earn_point = $points;
            $data->save();
    
            $response_data=[
                'success' => 1,
                'message' => 'successfully earn points.',
                //'data' => new UserResource($data),
               ];
        }else{   

        $response_data=[
            'success' => 0,
            'message' => 'Failed.',
           ];
        }   
       
       return response()->json($response_data, $this->successStatus);
    
    }
    
    
    public function messageEmail()
    {
      //$user = User::find(1);
      $unread = ChatRoomFeed::where('markasread','0')->select('room_id', 'sender_id')->get();
            $room_id = '';
            $sender_id = '';
				foreach($unread as $row){
				  $room_id = $room_id.'"'.$row->room_id.'",';
				  $sender_id = $sender_id.'"'.$row->sender_id.'",';
				}
				$room_id = rtrim($room_id,",");
				$sender_id = rtrim($sender_id,",");
      dd($sender_id);
      //$data   = ChatRoom::whereIN('id',$room_id)->
      
        $mail = Mail::send('emails.register', [
    
          'user' => $user
          ], function($message) use ($user){
          
          $message->to('shahnoman1001@gmail.com');
          $message->subject("Welcome to free-matrimonial.com");
          
         });


    }

}
