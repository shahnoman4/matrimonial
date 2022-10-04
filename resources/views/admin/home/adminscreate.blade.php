@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        //swal("Success", "{{session('success')}}", "success");

        swal({
       text: "{{session('success')}}",
       icon: "success",
       //dangerMode: true,
      buttons: ["Go Back", "Add Another"],
    }) .then((willDelete) => {
        if (willDelete) { 
        console.log('Add Another');  
        }else{
          window.location = "{{url('admins')}}";
          console.log('Go Back');  
        }
        });
      });
      
    </script>
@endif
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
              <h3 class="box-title">Add Staff</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
            <form class="form-horizontal" action="{!! url('/admin/admins'); !!}" method="post" enctype="multipart/form-data" id="add-form">
            @csrf
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
                  <label for="fname" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{ old('name') }}" require >
                   <span class="text-red">
                      <strong class="name"></strong>
                    </span>
                  </div>
                </div>
               

                <div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" require>
                    <span class="text-red">
                                <strong class="email"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="password" class="col-sm-3 control-label">Password</label>

                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" require>
                    <span class="text-red">
                                <strong class="password"></strong>
                      </span>
                  </div>
                </div>

               
                <div class="form-group">
                  <label for="mobile" class="col-sm-3 control-label">Mobile</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{ old('mobile') }}" autocomplete="off" require>
                    <span class="text-red">
                                <strong class="mobile"></strong>
                      </span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Select Role</label>

                  <div class="col-sm-9">
                    <select name="role_id" class="form-control">
                            @if(count($roles) > 0)
                                <option value="" selected>None</option>
                                @foreach($roles as $role)    
                                    <option value="{{$role->id}}">{{$role->role_title}}</option>                    
                                @endforeach
                            @else
                                <option value="">None</option>
                            @endif
                        </select>
                        <span class="text-red">
                                <strong class="role_id"></strong>
                      </span>
                  </div>
                </div>

                

              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/admin/admins'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" id="add-form-btn">Add</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>

@endsection
@push('scripts')
<script type="text/javascript">
$('#add-form-btn').on('click', function(e) {
  //var data = $('#add-form').serializeArray();
  var data = $('#add-form')[0];
  var formData = new FormData(data);
  event.preventDefault();
  $.ajax({
      data: formData,
      type: $('#add-form').attr('method'),
      url: $('#add-form').attr('action'),
      processData: false,
      contentType: false,
      success: function(response)
      {
      if(response.errors)
      {
        //console.log(response.errors.email);
      $.each(response.errors, function( index, value ) {
        //console.log(value[0]);
      $("."+index).html(value[0]);
      $("."+index).fadeIn('slow', function(){
        $("."+index).delay(3000).fadeOut(); 
      });
      });
      var success = $("."+response.errors.email);
      scrollTo(success,-100);
      }
      else
      {

      //swal("Success",response, "success");
      $('#add-form')[0].reset();
      location.reload();
      }
      }
      });
});
</script>
@endpush