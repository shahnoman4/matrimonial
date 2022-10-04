@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");



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
              <h3 class="box-title">Edit Staff/User {{$user->name}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
            <form class="form-horizontal" action="{!! route('admins.store'); !!}" method="post" enctype="multipart/form-data" id="add-form">
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
                  <label for="fname" class="col-sm-3 control-label"> Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{ $user->name }}" require >
                    <strong class="name"></strong>
                  </div>
                </div>
               
                <div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}" autocomplete="off" require>
                    <strong class="email"></strong>
                  </div>
                </div>


                <div class="form-group">
                  <label for="phonenumber" class="col-sm-3 control-label">Mobile</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Phone Number" value="{{ $user->mobile }}" autocomplete="off" require>
                    <strong class="mobile"></strong>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">Select Role</label>

                  <div class="col-sm-9">
                    <select name="role_id" class="form-control">
                            @if(count($roles) > 0)
                                <option value="" selected>None</option>
                                @foreach($roles as $role)    
                                    <option value="{{$role->id}}" <?php echo ($user->role_id==$role->id) ? "selected" : ""; ?>>{{$role->role_title}}</option>                    
                                @endforeach
                            @else
                                <option value="">None</option>
                            @endif
                        </select>
                      <strong class="role_id"></strong>  
                  </div>
                </div>
                <div class="form-group">
                  <label for="status" class="col-sm-3 control-label">Status</label>

                  <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option value="1" <?php echo ($user->status==1) ? "selected" : ""; ?>>Active</option>
                        <option value="2" <?php echo ($user->status==2) ? "selected" : ""; ?>>Deactivate</option>
                    </select>
                    <strong class="status"></strong>
                  </div>
                </div>
                <input name="edit_id" type="hidden" value="{{ $user->id }}" id="edit_id">

              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/admin/admins'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right" id="add-form-btn">Update</button>
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

<script>
  @if(isset($user->avatar) && $user->avatar!='')
      var avatarName="{{ asset ('img/staff/'.$user->avatar)}}";
    @else
    var avatarName="{{ asset ('img/placeholder.png') }}";
    @endif

  $("#avatar-1").fileinput({
      overwriteInitial: true,
      maxFileSize: 1000,
      showClose: false,
      showCaption: false,
      browseLabel: '',
      removeLabel: '',
      browseOnZoneClick: true,
      browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
      removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
      removeTitle: 'Cancel or reset changes',
      elErrorContainer: '#kv-avatar-errors-1',
      msgErrorClass: 'alert alert-block alert-danger',
      defaultPreviewContent: '<img src="'+ avatarName +'" alt="Avatar" width="100%">',
      layoutTemplates: {main2: '{preview} {browse}'},
      allowedFileExtensions: ["jpg", "png", "gif"]
  });
  </script>
@endpush