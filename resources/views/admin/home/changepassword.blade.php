@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
@if(session('error'))
    <script>
      $( document ).ready(function() {
        swal("Failed", "{{session('error')}}", "error");
      });
      
    </script>
@endif
<?php
$user = Auth::user();
?>
<div class="col-md-6 col-md-offset-3">
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Change Your Password</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{action('Admin\UserController@update', $user->id)}}" method="post" autocomplete="off">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <input name="changepassword" type="hidden" value="1">
              <div class="box-body">
                <div class="form-group">
                  <label for="oldpassword" class="col-sm-3 control-label">Old Password</label>

                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="newpassword" class="col-sm-3 control-label">New Password</label>

                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                    @if ($errors->has('password'))
                          <span class="text-red">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="repassword" class="col-sm-3 control-label">Confirm Password</label>

                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/admin/dashboard'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Change Password</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
          </div>

 
@endsection