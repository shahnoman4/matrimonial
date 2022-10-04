<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\models\Country;
use DataTables;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class CustomerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */


	public function index()
	{
		
        $users   = User::where('role_id','3')->get();
		return view('admin.customers.index',compact('users'));
	}


	public function fetch(){
    
    $user_id = Auth::user()->id;
	if($user_id==1){

    $data = User::where('role_id','3')->with('role')->orderBy('id','desc');
		
	}else{

    $data = User::where('role_id','3')->where('user_id',$user_id)->with('role')->orderBy('id','desc');
		
	}
	return DataTables::of($data)
	->addColumn('status',function($data){
	  if($data->status==1) {
		return '<span class="label label-success">Active</span>';
	  }else{
		return '<span class="label label-danger">Not Active</span>';
	  }
	})
	->addColumn('options',function($data){
		$action = '<span class="action_btn">';
		if(Auth::user()->can('customers-show')){
			$action .= '<a href="'.url("/admin/customers/show/".$data->id).'" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>'; 
		}
		if(Auth::user()->can('customers-edit')){
			$action .= '<a href="'.url("/admin/customers/edit/".$data->id).'" class="btn btn-success" title="Edit" style="margin-left:5px;"><i class="fa fa-edit"></i> </a>'; 
		}
		if(Auth::user()->can('customers-active') && Auth::user()->can('customers-disable')){
			if ($data->status == 1){
			  $action.=  "<a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."' style='margin-left:5px;'><i class='fa fa-close'></i></a>";
			}else{
			  $action.= "<a data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-success active' data-original-title='Active' href='#' data-id='".$data->id."' style='margin-left:5px;'><i class='fa fa-check'></i></a>";
			}
		}

// 		if(Auth::user()->can('delete-staff')){
// 			$action.='<button class="btn btn-danger delete" data-id="'.$data->id.'"  style="margin-left:5px;"><i class="fa fa-trash"></i></button>';
// 		}
	   
		$action .= '</span>';
		return $action; 
							
	})
	->rawColumns(['options','status'])
	->make(true);
	}

	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
       $data['countries']   = Country::where('status','Active')->get();
       return view('admin.customers.create')->with('data',$data);

	}

	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
	//dd($request->all());exit();
		 
		$rules = [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'mobile' => 'required|numeric|unique:users',
			'password' => 'required|min:6', 
			'avatar-1' => ['mimes:jpeg,png'],
		    'user_type' => 'required',
		    'user_identity' => 'required',
		    'profile_created_by' => 'required',
		    'gender' => 'required',
		    'date_of_birth' => 'required',
		    'my_city' => 'required',
		    'my_choice_city' => 'required',
		    'my_country_choice' => 'required',
		    'my_country' => 'required',
		    'religion' => 'required',
		    'mother_tongue' => 'required',
		    'my_visa' => 'required',
		    'my_choice_visa' => 'required',
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
            'education' => 'required',
            'education_field' => 'required',
            'education_field_year' => 'required',
            'my_occupation' => 'required',
            'my_choice_occupation' => 'required',
            'income_level' => 'required',
            'caste' => 'required',
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
            'interest' => 'required',
            'my_personality' => 'required',
            'about' => 'required',
            'about_my_choice' => 'required',
            'my_strengths' => 'required',
            'my_weekness' => 'required',
            'terms_and_condition' => 'required',
		];
		

		$data = [
			'name' => trim($request->get('name')),
			'email' => trim($request->get('email')),
	        'mobile' => trim($request->get('mobile')),
	        'password' => ($request->edit_id='') ? ''  : trim($request->get('password')) , 
			'avatar-1' => trim($request->get('avatar-1')),
			'user_type' => trim($request->get('user_type')),
			'user_identity' => trim($request->get('user_identity')),
			'profile_created_by' => trim($request->get('profile_created_by')),
			'gender' => trim($request->get('gender')),
			'date_of_birth' => trim($request->get('date_of_birth')),
			'my_city' => trim($request->get('my_city')),
			'my_choice_city' => trim($request->get('my_choice_city')),
	        'my_country' => trim($request->get('my_country')),
			'my_country_choice' => trim($request->get('my_country_choice')),
			'religion' => ($request->get('religion')),
			'mother_tongue' => ($request->get('mother_tongue')),
			'my_visa' => ($request->get('my_visa')),
			'my_choice_visa' => ($request->get('my_choice_visa')),
			'my_physique' => ($request->get('my_physique')),
			'my_choice_physique' => ($request->get('my_choice_physique')),
			'my_complexion' => ($request->get('my_complexion')),
			'my_choice_complexion' => ($request->get('my_choice_complexion')),
			'my_hair_color' => ($request->get('my_hair_color')),
			'my_choice_hair_color' => ($request->get('my_choice_hair_color')),
			'my_eye_color' => ($request->get('my_eye_color')),
			'my_choice_eye_color' => ($request->get('my_choice_eye_color')),
			'my_height' => ($request->get('my_height')),
			'my_choice_height_from' => ($request->get('my_choice_height_from')),
			'my_choice_height_to' => ($request->get('my_choice_height_to')),
			'my_choice_age_from' => ($request->get('my_choice_age_from')),
			'my_choice_age_to' => ($request->get('my_choice_age_to')),
			'education' => ($request->get('education')),
			'education_field' => ($request->get('education_field')),
			'education_field_year' => ($request->get('education_field_year')),
			'my_occupation' => ($request->get('my_occupation')),
			'my_choice_occupation' => ($request->get('my_choice_occupation')),
			'income_level' => ($request->get('income_level')),
			'caste' => ($request->get('caste')),
			'my_economy' => ($request->get('my_economy')),
			'my_choice_economy' => ($request->get('my_choice_economy')),
			'marital_status' => ($request->get('marital_status')),
			'my_choice_marital_status' => ($request->get('my_choice_marital_status')),
			'my_children' => ($request->get('my_children')),
			'my_choice_children' => ($request->get('my_choice_children')),
			'my_sibling_position' => ($request->get('my_sibling_position')),
			'no_of_brothers' => ($request->get('no_of_brothers')),
			'no_of_sisters' => ($request->get('no_of_sisters')),
			'my_family_values' => ($request->get('my_family_values')),
			'my_choice_family' => ($request->get('my_choice_family')),
			'my_living_arrangement' => ($request->get('my_living_arrangement')),
			'my_choice_living_arrangement' => ($request->get('my_choice_living_arrangement')),
			'my_raised' => ($request->get('my_raised')),
			'my_choice_raised' => ($request->get('my_choice_raised')),
			'my_hijab' => ($request->get('my_hijab')),
			'my_choice_hijab' => ($request->get('my_choice_hijab')),
			'my_smoke' => ($request->get('my_smoke')),
			'my_choice_smoke' => ($request->get('my_choice_smoke')),
			'my_drink' => ($request->get('my_drink')),
			'my_choice_drink' => ($request->get('my_choice_drink')),
			'my_disability' => ($request->get('my_disability')),
			'my_choice_disability' => ($request->get('my_choice_disability')),
			'interest' => ($request->get('interest')),
			'my_personality' => ($request->get('my_personality')),
			'about' => ($request->get('about')),
			'about_my_choice' => ($request->get('about_my_choice')),
			'my_strengths' => ($request->get('my_strengths')),
			'my_weekness' => ($request->get('my_weekness')),
			'terms_and_condition' => ($request->get('terms_and_condition')),
      
			];
	 
		$validator = Validator::make($data,$rules);
	 
	if($validator->fails())
	   {
		return  response()->json(['errors'=>$validator->errors()]);
	   }else
	   {
         
        $user_id = Auth::user()->id;

         
         
	         if($request->hasfile('avatar-1'))
			 {
				$file = $request->file('avatar-1');
                $avatar=$file->getClientOriginalName();
               // Storage::disk('local')->put('/public/users/'.$user->id.'/'.$avatar, File::get($file));
                //$user->avatar=$avatar;
			 }else{
				$avatar="default_avatar_male.jpg";
			 }

			$user= new User;
			$user->name=$request->get('name');
			$user->user_id=$user_id;
			$user->email=$request->get('email');
			$user->user_type=$request->get('user_type');
			$user->user_identity=  'Fake';//$request->get('user_identity');
			$user->role_id='3';
			$user->status='1';
			$user->password=Hash::make($request->get('password'));
			$user->mobile=$request->get('mobile');
			$date=date_create($request->get('date'));
			$format = date_format($date,"Y-m-d");
			$user->created_at = strtotime($format);
			$user->updated_at = strtotime($format);
			$user->avatar = $avatar;

			$user->profile_created_by = $request->get('profile_created_by');
	        $user->gender             = $request->get('gender');
	        $user->date_of_birth      = $request->get('date_of_birth');
	        $user->my_city            = $request->get('my_city');
	        $user->my_choice_city     = $request->get('my_choice_city');
	        $user->my_country         = $request->get('my_country');
	        $user->my_country_choice  = $request->get('my_country_choice');
	        $user->religion           = $request->get('religion');
	        $user->mother_tongue      = $request->get('mother_tongue');
	        $user->my_visa            = $request->get('my_visa');
	        $my_choice_visa = implode(",",$request->my_choice_visa);
	        $user->my_choice_visa     = $my_choice_visa;
          // dd($request->all());exit();
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

	        $interest = implode(",",$request->interest);
            $user->interest = $interest;

            $my_personality = implode(",",$request->my_personality);
	        $user->my_personality             = $my_personality;
	        $user->about      = $request->get('about');
	        $user->about_my_choice           = $request->get('about_my_choice');
	        $user->my_strengths    = $request->get('my_strengths');
	        $user->my_weekness           = $request->get('my_weekness');
	        $user->terms_and_condition    = $request->get('terms_and_condition');
	    
			$user->save();
			
			if($request->hasfile('avatar-1'))
			 {
	
                Storage::disk('local')->put('/public/users/'.$user->id.'/'.$avatar, File::get($file));
                
			 }


			$success = 'Customer has been created successfully.';
			Session::Flash('success','Customer has been created successfully');
            return response()->json($success);
            
		
	   }

	}


	public function customerUpdate(Request $request)
	{
	//dd($request->all());exit();
		 
		$rules = [
			'name' => 'required',
			'email' => 'required|email|unique:users,email,'.$request->edit_id,
			'mobile' => 'required|numeric|unique:users,mobile,'.$request->edit_id,
			'avatar-1' => ['mimes:jpeg,png'],
		    'user_type' => 'required',
		    'user_identity' => 'required',
		    'profile_created_by' => 'required',
		    'gender' => 'required',
		    'date_of_birth' => 'required',
		    'my_city' => 'required',
		    'my_choice_city' => 'required',
		    'my_country_choice' => 'required',
		    'my_country' => 'required',
		    'religion' => 'required',
		    'mother_tongue' => 'required',
		    'my_visa' => 'required',
		    'my_choice_visa' => 'required',
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
            'education' => 'required',
            'education_field' => 'required',
            'education_field_year' => 'required',
            'my_occupation' => 'required',
            'my_choice_occupation' => 'required',
            'income_level' => 'required',
            'caste' => 'required',
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
            'interest' => 'required',
            'my_personality' => 'required',
            'about' => 'required',
            'about_my_choice' => 'required',
            'my_strengths' => 'required',
            'my_weekness' => 'required',
            'terms_and_condition' => 'required',
		];
		

		$data = [
			'name' => trim($request->get('name')),
			'email' => trim($request->get('email')),
	        'mobile' => trim($request->get('mobile')),
			'avatar-1' => trim($request->get('avatar-1')),
			'user_type' => trim($request->get('user_type')),
			'user_identity' => trim($request->get('user_identity')),
			'profile_created_by' => trim($request->get('profile_created_by')),
			'gender' => trim($request->get('gender')),
			'date_of_birth' => trim($request->get('date_of_birth')),
			'my_city' => trim($request->get('my_city')),
			'my_choice_city' => trim($request->get('my_choice_city')),
	        'my_country' => trim($request->get('my_country')),
			'my_country_choice' => trim($request->get('my_country_choice')),
			'religion' => ($request->get('religion')),
			'mother_tongue' => ($request->get('mother_tongue')),
			'my_visa' => ($request->get('my_visa')),
			'my_choice_visa' => ($request->get('my_choice_visa')),
			'my_physique' => ($request->get('my_physique')),
			'my_choice_physique' => ($request->get('my_choice_physique')),
			'my_complexion' => ($request->get('my_complexion')),
			'my_choice_complexion' => ($request->get('my_choice_complexion')),
			'my_hair_color' => ($request->get('my_hair_color')),
			'my_choice_hair_color' => ($request->get('my_choice_hair_color')),
			'my_eye_color' => ($request->get('my_eye_color')),
			'my_choice_eye_color' => ($request->get('my_choice_eye_color')),
			'my_height' => ($request->get('my_height')),
			'my_choice_height_from' => ($request->get('my_choice_height_from')),
			'my_choice_height_to' => ($request->get('my_choice_height_to')),
			'my_choice_age_from' => ($request->get('my_choice_age_from')),
			'my_choice_age_to' => ($request->get('my_choice_age_to')),
			'education' => ($request->get('education')),
			'education_field' => ($request->get('education_field')),
			'education_field_year' => ($request->get('education_field_year')),
			'my_occupation' => ($request->get('my_occupation')),
			'my_choice_occupation' => ($request->get('my_choice_occupation')),
			'income_level' => ($request->get('income_level')),
			'caste' => ($request->get('caste')),
			'my_economy' => ($request->get('my_economy')),
			'my_choice_economy' => ($request->get('my_choice_economy')),
			'marital_status' => ($request->get('marital_status')),
			'my_choice_marital_status' => ($request->get('my_choice_marital_status')),
			'my_children' => ($request->get('my_children')),
			'my_choice_children' => ($request->get('my_choice_children')),
			'my_sibling_position' => ($request->get('my_sibling_position')),
			'no_of_brothers' => ($request->get('no_of_brothers')),
			'no_of_sisters' => ($request->get('no_of_sisters')),
			'my_family_values' => ($request->get('my_family_values')),
			'my_choice_family' => ($request->get('my_choice_family')),
			'my_living_arrangement' => ($request->get('my_living_arrangement')),
			'my_choice_living_arrangement' => ($request->get('my_choice_living_arrangement')),
			'my_raised' => ($request->get('my_raised')),
			'my_choice_raised' => ($request->get('my_choice_raised')),
			'my_hijab' => ($request->get('my_hijab')),
			'my_choice_hijab' => ($request->get('my_choice_hijab')),
			'my_smoke' => ($request->get('my_smoke')),
			'my_choice_smoke' => ($request->get('my_choice_smoke')),
			'my_drink' => ($request->get('my_drink')),
			'my_choice_drink' => ($request->get('my_choice_drink')),
			'my_disability' => ($request->get('my_disability')),
			'my_choice_disability' => ($request->get('my_choice_disability')),
			'interest' => ($request->get('interest')),
			'my_personality' => ($request->get('my_personality')),
			'about' => ($request->get('about')),
			'about_my_choice' => ($request->get('about_my_choice')),
			'my_strengths' => ($request->get('my_strengths')),
			'my_weekness' => ($request->get('my_weekness')),
			'terms_and_condition' => ($request->get('terms_and_condition')),
      
			];
	 
		$validator = Validator::make($data,$rules);
	 
	if($validator->fails())
	   {
		return  response()->json(['errors'=>$validator->errors()]);
	   }else
	   {
         
        $user_id = Auth::user()->id;



	         if($request->hasfile('avatar-1'))
			 {
				$file = $request->file('avatar-1');
                $avatar=$file->getClientOriginalName();
               // Storage::disk('local')->put('/public/users/'.$user->id.'/'.$avatar, File::get($file));
                //$user->avatar=$avatar;
			 }

			$user= User::findOrFail($request->edit_id);
			$user->name=$request->get('name');
			$user->user_id=$user_id;
			$user->email=$request->get('email');
			$user->user_type=$request->get('user_type');
			$user->user_identity=$request->get('user_identity');
			$user->role_id='3';
			$user->status='1';
			$user->password=Hash::make($request->get('password'));
			$user->mobile=$request->get('mobile');
			$date=date_create($request->get('date'));
			$format = date_format($date,"Y-m-d");
			$user->created_at = strtotime($format);
			$user->updated_at = strtotime($format);
			if($request->hasfile('avatar-1'))
			 {
				$file = $request->file('avatar-1');
                $avatar=$file->getClientOriginalName();
               // Storage::disk('local')->put('/public/users/'.$user->id.'/'.$avatar, File::get($file));
                //$user->avatar=$avatar;
			    $user->avatar = $avatar;
			 }

			$user->profile_created_by = $request->get('profile_created_by');
	        $user->gender             = $request->get('gender');
	        $user->date_of_birth      = $request->get('date_of_birth');
	        $user->my_city            = $request->get('my_city');
	        $user->my_choice_city     = $request->get('my_choice_city');
	        $user->my_country         = $request->get('my_country');
	        $user->my_country_choice  = $request->get('my_country_choice');
	        $user->religion           = $request->get('religion');
	        $user->mother_tongue      = $request->get('mother_tongue');
	        $user->my_visa            = $request->get('my_visa');
	        $my_choice_visa = implode(",",$request->my_choice_visa);
	        $user->my_choice_visa     = $my_choice_visa;
          // dd($request->all());exit();
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

	        $interest = implode(",",$request->interest);
            $user->interest = $interest;

            $my_personality = implode(",",$request->my_personality);
	        $user->my_personality             = $my_personality;
	        $user->about      = $request->get('about');
	        $user->about_my_choice           = $request->get('about_my_choice');
	        $user->my_strengths    = $request->get('my_strengths');
	        $user->my_weekness           = $request->get('my_weekness');
	        $user->terms_and_condition    = $request->get('terms_and_condition');
	    
			$user->save();
			
			if($request->hasfile('avatar-1'))
			 {
	
                Storage::disk('local')->put('/public/users/'.$user->id.'/'.$avatar, File::get($file));
                
			 }


			$success = 'Customer has been updated successfully.';
			Session::Flash('success','Customer has been updated successfully');
            return response()->json($success);
            
		
	   }

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$user      = User::findOrFail($id);
		//$loginlogs = User::find($id)->authentications;
		//dd($loginlogs);
		return view('admin.customers.show',compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$user  =  User::find($id);
		$data['countries']   = Country::where('status','Active')->get();
		return view('admin.customers.edit',compact('user','id','data'));
	}

	//For Reset Password
	public function resetPassword($id)
	{
		$user =  User::find($id);
		return view('admin.customers.resetpassword',compact('user','id'));
	}
	

   public function customerActive(Request $request)
    {
      $data = User::findOrFail($request->id);
      $data->status = '1';
      $data->save();
      $message = 'Successfully Active.';
      return response()->json($message);

    }
     

    public function customerDisable(Request $request)
    {
      $data = User::findOrFail($request->id);
      $data->status = '0';
      $data->save();
      $message = 'Successfully Disable.';
      return response()->json($message);

    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		
		if($request->get('changepassword')){
		//Change Password
		
			$user =  User::find($id); 
			//Check The Current Password Matched
			if (!Hash::check($request->get('oldpassword'), $user->password)){
				return redirect()->back()->with('error', "Current Password not matched.");
			}
			
			$validator = Validator::make($request->all(), [
				'password' => 'required|confirmed|min:6'
			]);
	
			if ($validator->fails()) {
				return redirect('/changepassword/')
							->withErrors($validator)
							->withInput();
			}
			
			$user->password=Hash::make($request->get('password'));
			$date=date_create($request->get('date'));
			$format = date_format($date,"Y-m-d");
			$user->updated_at = strtotime($format);
			$user->save();
			return redirect()->back()->with('success', "Your Password has been changed.");


		}elseif($request->get('resetpassword')){
			$this->authorize('edit-staff');
			//Reset Password
			$user =  User::find($id); 
			$validator = Validator::make($request->all(), [
				'password' => 'required|confirmed|min:6'
			]);
	
			if ($validator->fails()) {
				return redirect('/resetpassword/'.$id)
							->withErrors($validator)
							->withInput();
			}
			
			$user->password=Hash::make($request->get('password'));
			$date=date_create($request->get('date'));
			$format = date_format($date,"Y-m-d");
			$user->updated_at = strtotime($format);
			$user->save();
			
			return redirect()->action(
				'Admin\UserController@resetPassword', ['id' => $user->id]
			)->with('success', 'Password has been reset.');
		}else{
		//Update Staff/User details
		   // dd($request->file('avatar-1'));
			$this->authorize('edit-staff');
			if($request->hasfile('avatar-1'))
			{
				$file = $request->file('avatar-1');
				$avatarname=time().$file->getClientOriginalName();
				// dd($avatarname);
				$file->move(public_path().'/img/staff', $avatarname);
			}

			$user = User::find($id); 
			$this->validate(request(), [
				'fname' => 'required',
				'lname' => 'required',
				'email' => 'required|email|unique:users,email,'.$user->id,
				'phonenumber' => 'required'
			]);
			
			
			$user->fname=$request->get('fname');
			$user->lname=$request->get('lname');
			$user->email=$request->get('email');
			if(!empty($request->get('role_id'))){
				$user->role_id=$request->get('role_id');
			}
			$user->phonenumber=$request->get('phonenumber');
			if(!$request->get('profile')){
			$user->status=$request->get('status');
			}
			$date=date_create($request->get('date'));
			$format = date_format($date,"Y-m-d");
			$user->updated_at = strtotime($format);
			if(isset($avatarname)){
				$user->avatar = $avatarname;
			}
			$user->save();
			if($request->get('profile')){
				$message='Profile details has been updated.';
			}else{
				$message='Staff details has been updated';
			}
			return redirect()->back()->with('success', $message);

			
		}

	}

	



	public function getFilterData(Request $request){
       
       $data = $request->all();
       //dd($data);
       $data = session()->put('filter',$data);
       $value = session()->get('filter');
       //dd($value);
        if ($value) {
            
            $data = $value;
        }else{

            $data = 'Data not found';
        }
       return response()->json($data);
  
    }
}
