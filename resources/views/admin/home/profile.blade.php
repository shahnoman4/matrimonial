@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
<?php
$user = Auth::user();
?>
<!-- some CSS styling changes and overrides -->
<style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 213px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
</style>
<div class="box box-info">


<div class="box-header with-border">
  <h3 class="box-title">Profile</h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
<form class="form-horizontal" action="{{action('Admin\UserController@update', $user->id)}}" method="post" enctype="multipart/form-data">
@csrf
<input name="_method" type="hidden" value="PATCH">
<input name="profile" type="hidden" value="1">
<div class="box-body" >
<div class="row">
  <div class="col-md-4 text-center">
      <div class="kv-avatar">
          <div class="file-loading">
              <input id="avatar-1" name="avatar-1" type="file">
          </div>
      </div>
      <div class="kv-avatar-hint"><small>Select file < 1000 KB</small></div>
  </div> 
  <div class="col-md-8">
    <div class="form-group">
      <label for="name" class="col-sm-3 control-label">Name</label>

      <div class="col-sm-9">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{ $user->name }}" require >
        @if ($errors->has('name'))
              <span class="text-red">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
      </div>
    </div>
    

    <div class="form-group">
      <label for="email" class="col-sm-3 control-label">Email</label>

      <div class="col-sm-9">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}" autocomplete="off" require>
        @if ($errors->has('email'))
              <span class="text-red">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
      </div>
    </div>


    <div class="form-group">
      <label for="mobile" class="col-sm-3 control-label">Mobile</label>

      <div class="col-sm-9">
        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{ $user->mobile }}" autocomplete="off" require>
        @if ($errors->has('mobile'))
              <span class="text-red">
                  <strong>{{ $errors->first('mobile') }}</strong>
              </span>
          @endif
      </div>
    </div>

  </div>
  </div>

</div>
  <!-- /.box-body -->
  <div class="box-footer">
    <a href="{!! url('/admin/admins'); !!}" class="btn btn-default">Cancel</a>
    <button type="submit" class="btn btn-info pull-right">Update</button>
  </div>
  <!-- /.box-footer -->
</form>
</div>
@endsection