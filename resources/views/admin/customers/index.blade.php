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
<!-- Advance Filter Begins -->
{{--<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal filter_form"  enctype="multipart/form-data">
          @csrf
        <div class="box box-success collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">Search</h3>            
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="display: none;">
            
            <!--Search Form Begins -->
            <div class="col-md-6">
            <label class="" for=""> Enter Email </label>
            <input type="text" class="form-control" name="email" id="filter_email" placeholder="Enter Email"/>
            <label class="" for=""> Enter Phone </label>
            <input type="text" class="form-control" name="phonenumber" id="filter_phonenumber" placeholder="Enter Phone Number"/>
            </div>
  
                
             
              <script>
                 $(document).ready(function() { 
                    $('.select2').select2({
                        placeholder: "Select Staff",
                        multiple: false,
                    }); 
                  });
              </script>
            <!-- Search Form Ends -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-primary" id="filterRecords">Search
                <i class="fa fa-search"></i>
              </button>
              <button type="submit" class="pull-right btn btn-primary" style="margin-right: 20px;" id="filterClear">Clear Search
              </button>
            </div>
        </div>
        <!-- /.box -->
      </form>
      </div>
</div>
--}}
  <!-- Advance Filter Ends -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Customer</h3>
              
              <span class="pull-right">
              <a href="{!! route('customers.create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Customer</a>
              </span>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($users) > 0)
              <table id="table_data" class="display table-striped table-bordered responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Country</th>
                  <th>City</th>
                  <th>Mobile</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
              
                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Country</th>
                  <th>City</th>
                  <th>Mobile</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
              @else
              <div>No Record found.</div>
              @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->   

@endsection

@push('scripts')
<script src="{{ asset('script/app.js')}}" type="text/javascript"></script>
<link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
  var dataTableRoute = "{{ route('customers.fetch') }}";
  var activeRoute = "{{route('customers.active')}}";
  var disableRoute = "{{route('customers.disable')}}";
  var token = '{{csrf_token()}}';
  var data = [
                { "data": "name" },
                { "data": "email" },
                { "data": "my_country" },
                { "data": "my_city" },
                { "data": "mobile" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]
$( document ).ready(function() {

  InitTable();
});

// $(document).on('click', '.delete', function()
// {

//     var id = $(this).attr('data-id');
//     $.ajax({
//         "url": "",
//         type: "POST",
//         data: {'id': id,_token: token},
//         dataType : "json",
//         success: function(response)
//         {
//           InitTable();
//           swal("Success",response, "error");
//           //$('.delete').html(response);
//           //$('#delete').show();
//         },
//           error: function(){},          
//       });
// });

$(document).on('click', '.delete', function () {
    swal({
        title: "Are you sure?",
        text: "You want to delete this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var id = $(this).attr('data-id');
            $.ajax({
                "url": "{{ route('admins.delete') }}",
                type: "POST",
                data: {'id': id, _token: token},
                dataType: "json",
                success: function (response) {
                    InitTable();
                    swal("Success",response, "error");
                    //$('.delete').html(response);
                    //$('#delete').show();
                },
                error: function () {
                },
            });
        }
    });
});


$('.clearfix').on('click', '#filterRecords', function () {
       var email       =    $('#filter_email').val();
       var phonenumber =    $('#filter_phonenumber').val();
    event.preventDefault();  
   $.ajax({
            url: "{{url('getFilterData')}}",
            type: "POST",
            data: {_token:'{{csrf_token()}}','email':email,'phonenumber':phonenumber},
            dataType : "json",
            success: function(data){
              InitTable();
    },
    error: function(){},          
    });
});

$('.clearfix').on('click', '#filterClear', function () { 
   event.preventDefault();
       $('.filter_form')[0].reset();
       var email        =    $('#filter_email').val('');
       var phonenumber  =    $('#filter_phonenumber').val('');
  InitTable();
});  

</script> 
@endpush