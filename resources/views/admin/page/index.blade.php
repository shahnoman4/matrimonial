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



<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pages</h3>
              <span class="pull-right">
                <a href="{{route('page.create')}}" class="btn btn-info"><span class="fa fa-plus"></span> Add</a>
                
              </span>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
              
                    <div class="alert alert-danger alert-styled-left" style="display: none;" id="delete">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="delete"></p>
                    </div>

                    <div class="alert alert-success alert-styled-left" style="display: none;" id="success">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="success"></p>
                    </div> 

              <table id="table_data" class="display table-striped responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Page Url Name</th>
                  <th>Site Title</th>
                  <th>Main Title</th>
                  <th>Gallery Title</th>
                  <th>Download Title</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Page Url Name</th>
                  <th>Site Title</th>
                  <th>Main Title</th>
                  <th>Gallery Title</th>
                  <th>Download Title</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </tfoot>
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Table end -->


@endsection
@push('scripts')
<script src="{{ asset('script/app.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  var dataTableRoute = "{{ route('page.fetch') }}";
  var editRoute = "";
  var activeRoute = "{{route('page.active')}}";
  var disableRoute = "{{route('page.disable')}}";
  var token = '{{csrf_token()}}';
  var data = [
                { "data": "id" },
                { "data": "page_url_name" },
                { "data": "site_title" },
                { "data": "main_title" },
                { "data": "gallery_title" },
                { "data": "download_title" },
                { "data": "created_at" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]
$( document ).ready(function() {

  InitTable();
});
</script> 
@endpush