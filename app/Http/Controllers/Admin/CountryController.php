<?php

namespace App\Http\Controllers\Admin;

use App\models\Country;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::where('status','Active')->get();
        return view('admin.countries.index')->with('countries',$countries);
    }

   

    public function fetch(){

        $data = Country::orderBy('id','desc')->get();
        return DataTables::of($data)
        ->addColumn('created_at',function($data){
            return $data->created_at->format('Y-m-d');
        })
        ->addColumn('status',function($data){
          if($data->status=='Disable') {
            return '<span class="label label-danger">Disable</span>';
          }else if($data->status=='Active'){
            return '<span class="label label-success">Active</span>';
          }
          else{
            return '<span class="label  label-primary">'.$data->status.'</span>';
          }
        })

        ->addColumn('options',function($data){
            if($data->status=='Active'){
            return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Disable' class='btn btn-danger disable' data-original-title='Disable' href='#' data-id='".$data->id."'><i class='fa fa-close'></i></a>
                                     ";
            }else if($data->status=='Disable'){
             return "&emsp;<a class='btn btn-success edit_model'
                                     href='#' data-id='".$data->id."'><i class='fa fa-edit'></i></a>
                                     <a data-toggle='tooltip' data-placement='bottom' title='Active' class='btn btn-success active' data-original-title='Active' href='#' data-id='".$data->id."'><i class='fa fa-check'></i></a>
                                     "; 
            }                         
        })
     
        ->rawColumns(['created_at', 'status','options'])
        ->make(true);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'country_name' => 'required',
            'status' => 'required',
        );

        $data = [
            'country_name' => trim($request->get('country_name')),
            'status' => trim($request->get('status')),
            ];
        $validator = Validator::make($data,$rules);
     
    if($validator->fails())
       {
        return  response()->json(['errors'=>$validator->errors()]);
       }else
       {
        $user_id = Auth::user()->id;

         
            if(isset($request->edit_id) && ($request->edit_id !="") )
            {
            
            $data = Country::findOrFail($request->edit_id);
            $data->country_name = $request->country_name;
            $data->status     = $request->status;
            $data->user_id     = $user_id;
            $data->save(); 
            $success = 'Country has been updated.';
            return response()->json($success);
            }else{

            $data = New Country;
            $data->country_name = $request->country_name;
            $data->user_id     = $user_id;
            $data->status        = 'Active';
            $data->save();
            $success = 'Country has been created.';
            return response()->json($success);
           }
        }
    
    }


    
    public function edit(Request $request)
    {
      $data = Country::findOrFail($request->id);
      return response()->json($data);

    }


    public function countryActive(Request $request)
    {
      $data = Country::findOrFail($request->id);
      $data->status = 'Active';
      $data->save();
      $message = 'Successfully Active.';
      return response()->json($message);

    }
     

    public function countryDisable(Request $request)
    {
      $data = Country::findOrFail($request->id);
      $data->status = 'Disable';
      $data->save();
      $message = 'Successfully Disable.';
      return response()->json($message);

    }

   
}
