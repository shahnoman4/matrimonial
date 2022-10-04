<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Datatables;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;

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

    public function indexdatatable()
    {
        //echo "string";exit();
        //$users=\App\User::with('role')->where('iscustomer',0)->get();
        $users=  User::with('role')->get();
        return datatables()->of($users)->make(true);
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
         
        $this->validate(request(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phonenumber' => 'required',
            'avatar-1' => ['mimes:jpeg,png']
        ]);


        if($request->hasfile('avatar-1'))
         {
            $file = $request->file('avatar-1');
            $avatarname=time().$file->getClientOriginalName();
            $file->move(public_path().'/img/staff', $avatarname);
         }else{
            $avatarname="default_avatar_male.jpg";
         }

        $user= new User;
        $user->fname=$request->get('fname');
        $user->lname=$request->get('lname');
        $user->email=$request->get('email');
        $user->role_id=$request->get('role_id');
        $user->password=Hash::make($request->get('password'));
        $user->phonenumber=$request->get('phonenumber');
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $user->created_at = strtotime($format);
        $user->updated_at = strtotime($format);
        $user->avatar = $avatarname;
        $user->save();
        return redirect('admins/create')->with('success', 'Staff has been created successfully.');

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
            return redirect()->action(
                'Admin\UserController@index' 
            )->with('success', 'Staff has been deleted.');
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->action(
                'Admin\UserController@index' 
            )->with('failed', 'Unable to delete, this USER has linked record(s) in system.');
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
}
