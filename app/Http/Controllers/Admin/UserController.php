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
use App\Lead;
use DataTables;
use Session;
use Cache;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
       
        //echo "string";exit();
        //$users=\App\User::all();
        //$users=\App\User::with('role')->get();
        $users= User::with('role')->get();//->where('iscustomer',0)->get();
        
        return view('admin.home.admins',compact('users'));
        //return view('admins');
    }


    public function fetch(){

    $data = User::where('role_id','!=','3')->with('role')->orderBy('id','desc');
    return DataTables::of($data)
   
    ->addColumn('role',function($data){
        return $data->role->role_title;
    })
    ->addColumn('status',function($data){
      if($data->status==1) {
        return '<span class="label label-success">Active</span>';
      }else{
        return '<span class="label label-danger">Not Active</span>';
      }
     
    })
    ->addColumn('options',function($data){
        $action = '<span class="action_btn">';
        if(Auth::user()->can('show-staff')){
            $action .= '<a href="'.url("/admin/admins/".$data->id).'" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>'; 
        }
        if(Auth::user()->can('edit-staff')){
            $action .= '<a href="'.url("/admin/admins/".$data->id."/edit").'" class="btn btn-success" title="Edit" style="margin-left:5px;"><i class="fa fa-edit"></i> </a>'; 
        }
        if(Auth::user()->can('status-staff')){
            if ($data->status == 1){
              $action.= '<a href="'.url("/admin/admins/deactivate/".$data->id).'"  class="btn btn-warning" title="Deactivate" style="margin-left:5px;"><i class="fa fa-times"></i> </a>';
            }else{
              $action.= '<a href="'.url("/admin/admins/active/".$data->id).'"  class="btn btn-info" title="Active" style="margin-left:5px;"><i class="fa fa-check"></i> </a>';
            }
        }
        if(Auth::user()->can('delete-staff')){
            $action.='<button class="btn btn-danger disable" data-id="'.$data->id.'"  style="margin-left:5px;"><i class="fa fa-trash"></i></button>';
        }
        if(Auth::user()->can('staff-reset-password')){
            $action.='<a href="'.url("/admin/admins/resetpassword/".$data->id).'"  class="btn btn-info" title="Reset Password" style="margin-left:5px;"><i class="fa fa-key"></i> </a>';
        }
       
        $action .= '</span>';
        return $action; 
                            
    })
    ->rawColumns(['options','role','status'])
    ->make(true);
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles= Role::all();
        return view('admin.home.adminscreate',compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //dd($request->all());
    if(isset($request->edit_id) && ($request->edit_id !="") )
       {     
        $rules = [
            'name' => 'required',
            'role_id' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->edit_id,
            'mobile' => 'required|numeric|unique:users,mobile,'.$request->edit_id,
            'avatar-1' => ['mimes:jpeg,png']
        ];
        $messages = [
                   'name.required' => 'This Field is requried.',
                 'role_id.required' => 'This Field is requried.',
                  'email.unique' => 'This email address belongs to someone else.',
                  'mobile.unique' => 'This Mobile number belongs to someone else.',
               ]; 

        $data = [
            'name' => trim($request->get('name')),
            'role_id' => trim($request->get('role_id')),
            'email' => trim($request->get('email')),
            'mobile' => trim($request->get('mobile')),
            'avatar-1' => trim($request->get('avatar-1')),
            ];
     }else{
          $rules = [
            'name' => 'required',
            'role_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',         
            'mobile' => 'required|numeric|unique:users',
            'avatar-1' => ['mimes:jpeg,png']
        ];

        $messages = [
                   'name.required' => 'This Field is requried.',
                   'role_id.required' => 'This Field is requried.',
                   'email.unique' => 'This email address belongs to someone else.',
                   'mobile.unique' => 'This Mobile number belongs to someone else.',
               ]; 

        $data = [
            'name' => trim($request->get('name')),
            'role_id' => trim($request->get('role_id')),
            'email' => trim($request->get('email')),
            'password' => trim($request->get('password')),
            'mobile' => trim($request->get('mobile')),
            'avatar-1' => trim($request->get('avatar-1')),
            ];

     }

    
        $validator = Validator::make($data,$rules,$messages);
     
    if($validator->fails())
       {
        return  response()->json(['errors'=>$validator->errors()]);
       }else
       {
         
         $user_id = Auth::user()->id;

         
            if(isset($request->edit_id) && ($request->edit_id !="") )
            {
            

        

        $user= User::findOrFail($request->edit_id);
        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->status='1';
        $user->role_id=$request->get('role_id');
        $user->password=Hash::make($request->get('password'));
        $user->mobile=$request->get('mobile');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $user->created_at = strtotime($format);
        $user->updated_at = strtotime($format);
        if($request->hasfile('avatar-1'))
         {
            $file = $request->file('avatar-1');
            $avatarname=time().$file->getClientOriginalName();
            $file->move(public_path().'/img/staff', $avatarname);
            $user->avatar = $avatarname;
         }
        
        $user->save();
        $success = 'Staff has been updated successfully.';
        Session::Flash('success','Staff has been updated successfully');
        //exit();
            return response()->json($success);
          }else{

            if($request->hasfile('avatar-1'))
         {
            $file = $request->file('avatar-1');
            $avatarname=time().$file->getClientOriginalName();
            $file->move(public_path().'/img/staff', $avatarname);
         }else{
            $avatarname="default_avatar_male.jpg";
         }

        $user= new User;
        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->status='1';
        $user->role_id=$request->get('role_id');
        $user->password=Hash::make($request->get('password'));
        $user->mobile=$request->get('mobile');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $user->created_at = strtotime($format);
        $user->updated_at = strtotime($format);
        $user->avatar = $avatarname;
        $user->save();
        $success = 'Staff has been created successfully.';
        Session::Flash('success','Staff has been created successfully');
            return response()->json($success);
          }  
        
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
        $user      = User::with('role')->where('id',$id)->first();
        $loginlogs = User::find($id)->authentications;
        //dd($loginlogs);
        return view('admin.home.adminsshow',compact('user','loginlogs'));
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
        $roles =  Role::all();
        return view('admin.home.adminsedit',compact('user','roles','id'));
    }

    //For Reset Password
    public function resetPassword($id)
    {
        $user =  User::find($id);
        return view('admin.home.resetpassword',compact('user','id'));
    }
    //For Deactivate
    public function deactivate($id)
    {
        $user =  User::find($id);         
        $user->status=2;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $user->updated_at = strtotime($format);
        $user->save();
        return redirect()->action(
            'Admin\UserController@index'
        )->with('success', 'Staff status has been deactivated.');
    }
    //For Active
    public function active($id)
    {
        $user =  User::find($id);         
        $user->status=1;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $user->updated_at = strtotime($format);
        $user->save();
        return redirect()->action(
            'Admin\UserController@index'
        )->with('success', 'Staff status has been active.');
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
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'mobile' => 'required'
            ]);
            
            
            $user->name=$request->get('name');
            $user->email=$request->get('email');
            if(!empty($request->get('role_id'))){
                $user->role_id=$request->get('role_id');
            }
            $user->mobile=$request->get('mobile');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::find($id);
            $user->delete();
            $message = 'Staff has been deleted!';
            return response()->json($message);
            //return redirect()->action(
                //'Admin\UserController@index' 
            //)->with('success', 'Staff has been deleted.');
        } catch(\Illuminate\Database\QueryException $ex){ 
            //return redirect()->action(
                //'Admin\UserController@index' 
            //)->with('failed', 'Unable to delete, this USER has linked record(s) in system.');
            $message = 'Unable to delete, this USER has linked record(s) in system';
            return response()->json($message);
            //$ex->getMessage()
        }
    }

    public function delete(Request $request)
    {
        try{
            $user = User::find($request->id);
            $user->delete();
            $message = 'Staff has been deleted!';
            return response()->json($message);
            //return redirect()->action(
                //'Admin\UserController@index' 
            //)->with('success', 'Staff has been deleted.');
        } catch(\Illuminate\Database\QueryException $ex){ 
            //return redirect()->action(
                //'Admin\UserController@index' 
            //)->with('failed', 'Unable to delete, this USER has linked record(s) in system.');
            $message = 'Unable to delete, this USER has linked record(s) in system';
            return response()->json($message);
            //$ex->getMessage()
        }
    }

    

    public function readnofication(Request $request)
    {
        $id=$request->get('id');
        $data['id']=$id;
        Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
        die(json_encode($data));
        exit;
    }
    
   
     
   public function sendRegEmails()
    {
      $user = User::find(1);
      //echo "string";exit();
     // dd($password);
     $mail = \Mail::send('emails.register', [
    
      'user' => $user
      ], function($message) use ($user){
      
      $message->to('nomanshah434514@gmail.com');
      $message->subject("Welcome to free-matrimonial.com");
      
      });

     //dd($mail);
    }
    
}
