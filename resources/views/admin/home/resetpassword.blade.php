@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif

<div class="col-md-12">
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Reset Password > {{$user->fname}} {{$user->lname}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{action('Admin\UserController@update', $id)}}" method="post" autocomplete="off">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <input name="resetpassword" type="hidden" value="1">
              <div class="box-body">
                <div class="form-group">
                  <label for="newpassword" class="col-sm-3 control-label">New Password</label>

                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" placeholder="New Password"  autocomplete="off" require>
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
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"  autocomplete="off" require>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/admins'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Reset Password</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
          </div>

 
@endsection