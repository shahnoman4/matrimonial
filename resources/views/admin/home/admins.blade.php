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

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Admins</h3>
              @can('create-staff')
              <span class="pull-right">
              <a href="{!! url('/admin/admins/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add Staff</a>
              </span>
              @endcan
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($users) > 0)
              <table id="table_data" class="display table-striped table-bordered responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Role</th>
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
                  <th>Mobile</th>
                  <th>Role</th>
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
<script type="text/javascript">
  var dataTableRoute = "{{ route('admins.fetch') }}";
  var token = '{{csrf_token()}}';
  var data = [
                { "data": "name" },
                { "data": "email" },
                { "data": "mobile" },
                { "data": "role" },
                { "data": "status" },
                { "data": "options" ,"orderable":false},
            ]
$( document ).ready(function() {

  InitTable();
});

$(document).on('click', '.disable', function () {
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


  
</script> 
@endpush