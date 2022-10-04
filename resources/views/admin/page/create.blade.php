@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
@if(session('failed'))
    <script>
      $( document ).ready(function() {
        swal("Failed", "{{session('failed')}}", "error");
      });
      
    </script>
@endif


<!-- Form end -->
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Page Create</h3>
              <div class="box-tools pull-right">
                    
                  </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
           

                    <div class="alert alert-danger alert-styled-left" style="display: none;" id="delete">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="delete"></p>
                    </div>

                    <div class="alert alert-success alert-styled-left" style="display: none;" id="success">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="success"></p>
                    </div>

              <div class="col-md-10">
                <h3>Page Form</h3>
                <div class="" style="height:20px;"></div>
              <form class="form-horizontal form" action="{{route('page.store')}}" method="post"  id="add_form">
                  @csrf 

                  <div class="form-group">
                      <label for="" class="col-sm-3">Page Url Name</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="page_url_name" id="page_url_name" placeholder="" >
                        <span class="text-red">
                                <strong class="page_url_name"></strong>
                        </span>
                      </div>
                    </div> 

                  <div class="form-group">
                      <label for="" class="col-sm-3">Site Title</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="site_title" id="site_title" placeholder="" >
                        <span class="text-red">
                                <strong class="site_title"></strong>
                        </span>
                      </div>
                    </div> 
                    
                    <div class="form-group">
                      <label for="" class="col-sm-3">Main Title</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="main_title" id="main_title" placeholder="" >
                        <span class="text-red">
                                <strong class="main_title"></strong>
                        </span>
                      </div>
                    </div>   
                  
                   <div class="form-group">
                      <label for="" class="col-sm-3">Main Description</label>
                      <div class="col-sm-8">
                        <textarea id="editor1" class="editor1 description" name="main_description" rows="10" cols="80" required>
                        
                        </textarea>
                        <span class="text-red">
                                <strong class="main_description"></strong>
                        </span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="" class="col-sm-3">Feature Free</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="feature_free" id="feature_free" placeholder="" >
                        <span class="text-red">
                                <strong class="feature_free"></strong>
                        </span>
                      </div>
                    </div> 

                    <div class="form-group">
                      <label for="" class="col-sm-3">Feature Daily</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="feature_daily" id="feature_daily" placeholder="" >
                        <span class="text-red">
                                <strong class="feature_daily"></strong>
                        </span>
                      </div>
                    </div> 

                   

                    <div class="form-group">
                      <label for="" class="col-sm-3">Feature Secure</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="feature_secure" id="feature_secure" placeholder="" >
                        <span class="text-red">
                                <strong class="feature_secure"></strong>
                        </span>
                      </div>
                    </div> 

                    <div class="form-group">
                      <label for="" class="col-sm-3">Feature Notification</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="feature_notification" id="feature_notification" placeholder="" >
                        <span class="text-red">
                                <strong class="feature_notification"></strong>
                        </span>
                      </div>
                    </div> 

                    <div class="form-group">
                      <label for="" class="col-sm-3">Feature Message</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="feature_message" id="feature_message" placeholder="" >
                        <span class="text-red">
                                <strong class="feature_message"></strong>
                        </span>
                      </div>
                    </div> 

                    <div class="form-group">
                      <label for="" class="col-sm-3">Feature Search</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="feature_search" id="feature_search" placeholder="" >
                        <span class="text-red">
                                <strong class="feature_search"></strong>
                        </span>
                      </div>
                    </div> 

                     <div class="form-group">
                      <label for="" class="col-sm-3">Gallery Title</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="gallery_title" id="gallery_title" placeholder="" >
                        <span class="text-red">
                                <strong class="gallery_title"></strong>
                        </span>
                      </div>
                    </div> 

                    <div class="form-group">
                      <label for="" class="col-sm-3">Gallery Description</label>
                      <div class="col-sm-8">
                        <textarea id="editor2" class="editor2 description" name="gallery_description" rows="10" cols="80" required>
                        
                        </textarea>
                        <span class="text-red">
                                <strong class="gallery_description"></strong>
                        </span>
                      </div>
                    </div>


                 
                  <div class="form-group">
                      <label for="" class="col-sm-3">Protip Description 1</label>
                      <div class="col-sm-8">
                        <textarea id="editor3" class="editor3 description" name="protip_description_1" rows="10" cols="80" required>
                        
                        </textarea>
                        <span class="text-red">
                                <strong class="protip_description_1"></strong>
                        </span>
                      </div>
                    </div>

                  <div class="form-group">
                      <label for="" class="col-sm-3">Protip Description 2</label>
                      <div class="col-sm-8">
                        <textarea id="editor4" class="editor4 description" name="protip_description_2" rows="10" cols="80" required>
                        
                        </textarea>
                        <span class="text-red">
                                <strong class="protip_description_2"></strong>
                        </span>
                      </div>
                    </div>

                     
                    <div class="form-group">
                      <label for="" class="col-sm-3">Download Title</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="download_title" id="download_title" placeholder="" >
                        <span class="text-red">
                                <strong class="download_title"></strong>
                        </span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="" class="col-sm-3">Download Description</label>
                      <div class="col-sm-8">
                        <textarea id="editor5" class="editor5 description" name="download_description" rows="10" cols="80" required>
                        
                        </textarea>
                        <span class="text-red">
                                <strong class="download_description"></strong>
                        </span>
                      </div>
                    </div> 
                   
                
                 
                
              </div>

            </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="add_form_btn">Save</button>
              </div>
              <!-- /.box-footer -->
              </form>
    </div>

 

@endsection
@push('scripts')
      <!-- /.row -->  
 <script src="{{ asset('bower_components/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
// code for add form
$('#add_form_btn').on('click', function(e) {
  //var data = $('#add_form').serializeArray();
   for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
  e.preventDefault();
  var data = $('#add_form')[0];
  var formData = new FormData(data);
  $.ajax({
  data: formData,
  type: $('#add_form').attr('method'),
  url: $('#add_form').attr('action'),
  processData: false,
  contentType: false,
  success: function(response)
  {
  if(response.errors)
  {
  $.each(response.errors, function( index, value ) {
    $("."+index).html(value);
    $("."+index).fadeIn('slow', function(){
      $("."+index).delay(3000).fadeOut(); 
    });
  });
  }
  else 
  {
        location.reload();
     
  }
  
  }
  });
}); 
$(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
   // CKEDITOR.instances['editor1'].setData('');
});

$(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor2');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
   // CKEDITOR.instances['editor1'].setData('');
});

$(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor3');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
   // CKEDITOR.instances['editor1'].setData('');
});

$(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor4');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
   // CKEDITOR.instances['editor1'].setData('');
});

$(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor5');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
   // CKEDITOR.instances['editor1'].setData('');
});


</script>
@endpush