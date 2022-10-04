<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\Adminmenu;
use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   /* public function __construct()
    {
        $this->middleware('auth');
    }
    */
    public function index()
    {
        //$user = Auth::user();
        //dd($user);
        $roles=  Role::with('createdby')->with('modifiedby')->get();
        return view('admin.roles.roles',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $menulist= Adminmenu::wherenull('parentid')->with('children')->get();
        return view('admin.roles.create',compact('menulist'));
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
            'role_title' => 'required|unique:roles',
            'role_arr' => 'required',
        ]);
        $ip = $request->ip();
        
        $allowed_menus = Adminmenu::whereIn('id', $request->get('role_arr'))->get();
        
        foreach($allowed_menus as $val){
            $permissions[$val->slug]=  true;
        }

        $permission=implode(",",$request->get('role_arr'));
        $role= new  Role;
        $role->role_title=$request->get('role_title');
        $role->permission=$permission;
        $role->permissions=json_encode($permissions);
        $role->user_id=auth()->user()->id;
        $role->created_ip=$ip;
        $role->last_modified_by=auth()->user()->id;
        $role->modified_ip=$ip;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $role->created_at = strtotime($format);
        $role->updated_at = strtotime($format);
        $role->save();
        return redirect('roles/create')->with('success', 'New Role has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {      
        $permission=array();
        $menulist= Adminmenu::wherenull('parentid')->with('children')->get();
        $role= Role::find($id);
        if($role){
            if(!empty($role->permission)){
                $permission=explode(",",$role->permission);
            }
            return view('admin.roles.edit',compact('role','menulist','permission','id'));
        }else{
            return redirect()->action('Admin\RoleController@index')->with('failed', 'Record not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate(request(), [
            'role_title' => 'required|unique:roles,role_title,'.$id,
            'role_arr' => 'required',
        ]);
        $ip = $request->ip();
        $allowed_menus= Adminmenu::whereIn('id', $request->get('role_arr'))->get();
        
        foreach($allowed_menus as $val){
            $permissions[$val->slug]=  true;
        }
        $permission=implode(",",$request->get('role_arr'));
        $role=   Role::find($id);
        $role->role_title=$request->get('role_title');
        $role->permission=$permission;
        $role->permissions=json_encode($permissions);
        $role->last_modified_by=auth()->user()->id;
        $role->modified_ip=$ip;
        $date=date_create($request->get('date'));
        $format = date_format($date,"Y-m-d");
        $role->updated_at = strtotime($format);
        $role->save();
        return redirect()->back()->with('success', 'Role has been updated successfully.');
    
    }

    //For Deactivate
    public function deactivate($id)
    {
        $role =   Role::find($id);
        $role->status=2;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $role->updated_at = strtotime($format);
        $role->save();
        return redirect()->action(
            'Admin\RoleController@index'
        )->with('success', 'Navigation Role status has been deactivated for '.$role->role_title.'.');
    }
    //For Active
    public function active($id)
    {
        $role = Role::find($id);         
        $role->status=1;
        $date=now();
        $format = date_format($date,"Y-m-d");
        $role->updated_at = strtotime($format);
        $role->save();
        return redirect()->action(
            'Admin\RoleController@index'
        )->with('success', 'Navigation Role has been active for '.$role->role_title.'.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $role = Role::find($id);
            $role->delete();
            return redirect()->action(
                'Admin\RoleController@index' 
            )->with('success', 'Role has been deleted.');
        } catch(\Illuminate\Database\QueryException $ex){ 
            return redirect()->action(
                'Admin\RoleController@index' 
            )->with('failed', 'Unable to delete, this ROLE has linked record(s) in system.');
        }
    }
}
