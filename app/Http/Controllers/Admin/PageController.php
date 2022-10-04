<?php

namespace App\Http\Controllers\Admin;

use App\models\Page;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Page::where('status','Active')->get();
        return view('admin.page.index')->with('data',$data);
    }

   

    public function fetch(){

        $data = Page::orderBy('id','desc')->get();
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



    public function create()
    {
        $data = Page::where('status','Active')->get();
        return view('admin.page.create')->with('data',$data);
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
            'site_title' => 'required',
            'page_url_name' => 'required',
            'main_title' => 'required',
            'main_description' => 'required',
            'feature_free' => 'required',
            'feature_daily' => 'required',
            'feature_secure' => 'required',
            'feature_notification' => 'required',
            'feature_message' => 'required',
            'feature_search' => 'required',
            'gallery_title' => 'required',
            'gallery_description' => 'required',
            'protip_description_1' => 'required',
            'protip_description_2' => 'required',
            'download_title' => 'required',
            'download_description' => 'required',
            
        );

        $data = [
            'site_title' => trim($request->get('site_title')),
            'page_url_name' => trim($request->get('page_url_name')),
            'main_title' => trim($request->get('main_title')),
            'main_description' => trim($request->get('main_description')),
            'feature_free' => trim($request->get('feature_free')),
            'feature_daily' => trim($request->get('feature_daily')),
            'feature_secure' => trim($request->get('feature_secure')),
            'feature_notification' => trim($request->get('feature_notification')),
            'feature_message' => trim($request->get('feature_message')),
            'feature_search' => trim($request->get('feature_search')),
            'gallery_title' => trim($request->get('gallery_title')),
            'gallery_description' => trim($request->get('gallery_description')),
            'protip_description_1' => trim($request->get('protip_description_1')),
            'protip_description_2' => trim($request->get('protip_description_2')),
            'download_title' => trim($request->get('download_title')),
            'download_description' => trim($request->get('download_description')),
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
            
            $data = Page::findOrFail($request->edit_id);
            $data->site_title = $request->site_title;
            $data->page_url_name = $request->page_url_name;
            $data->main_title = $request->main_title;
            $data->main_description = $request->main_description;
            $data->feature_free = $request->feature_free;
            $data->feature_daily = $request->feature_daily;
            $data->feature_secure = $request->feature_secure;
            $data->feature_notification = $request->feature_notification;
            $data->feature_message = $request->feature_message;
            $data->feature_search = $request->feature_search;
            $data->gallery_title = $request->gallery_title;
            $data->gallery_description = $request->gallery_description;
            $data->protip_description_1 = $request->protip_description_1;
            $data->protip_description_2 = $request->protip_description_2;
            $data->download_title = $request->download_title;
            $data->download_description = $request->download_description;
            $data->updated_by     = $user_id;
            $data->save(); 
            $success = 'Page has been updated.';
            return response()->json($success);
            }else{

            $data = New Page;
            $data->site_title = $request->site_title;
            $data->page_url_name = $request->page_url_name;
            $data->main_title = $request->main_title;
            $data->main_description = $request->main_description;
            $data->feature_free = $request->feature_free;
            $data->feature_daily = $request->feature_daily;
            $data->feature_secure = $request->feature_secure;
            $data->feature_notification = $request->feature_notification;
            $data->feature_message = $request->feature_message;
            $data->feature_search = $request->feature_search;
            $data->gallery_title = $request->gallery_title;
            $data->gallery_description = $request->gallery_description;
            $data->protip_description_1 = $request->protip_description_1;
            $data->protip_description_2 = $request->protip_description_2;
            $data->download_title = $request->download_title;
            $data->download_description = $request->download_description;
            $data->created_by     = $user_id;
            $data->status        = 'Active';
            $data->save();
            $success = 'Page has been created.';
            return response()->json($success);
           }
        }
    
    }

    
    public function edit(Request $request)
    {
      $data = Page::findOrFail($request->id);
      return response()->json($data);

    }


    public function pageActive(Request $request)
    {
      $data = Page::findOrFail($request->id);
      $data->status = 'Active';
      $data->save();
      $message = 'Successfully Active.';
      return response()->json($message);

    }
     

    public function pageDisable(Request $request)
    {
      $data = Page::findOrFail($request->id);
      $data->status = 'Disable';
      $data->save();
      $message = 'Successfully Disable.';
      return response()->json($message);

    }

   
}
