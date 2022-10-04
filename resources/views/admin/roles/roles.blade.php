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
              <h3 class="box-title">Manage Admins Roles</h3>
              <span class="pull-right">
              <a href="{!! url('/roles/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add New Role</a>
              </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($roles) > 0)
              <table id="table_data" class="display table-striped table-bordered responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Menu Title</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th>Modified By</th>
                  <th>Modified At</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                  <tr>
                    <td>{{$role['role_title']}}</td>
                    <td>{{$role['createdby']['name']}}</td>
                    <td>{{$role['created_at']->format('d-m-Y')}}</td>
                    <td>{{$role['modifiedby']['name']}}</td>
                    <td>{{$role['updated_at']->format('d-m-Y')}}</td>
                    <td>{{ $role['status'] == "1" ? "Active" : "Deactive" }}</td>
                     <!-- For Delete Form begin -->
                    <form id="form{{$role['id']}}" action="{{action('Admin\RoleController@destroy', $role['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <!-- For Delete Form Ends -->
                    <td>

                      <a href="{!! url('/roles/'.$role['id'].'/edit'); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>
                      @if ($role['status'] === 1)
                        <a href="{!! url('/roles/deactivate/'.$role['id']); !!}"  class="btn btn-warning" title="Deactivate"><i class="fa fa-times"></i> </a>
                      @else
                        <a href="{!! url('/roles/active/'.$role['id']); !!}"  class="btn btn-info" title="Active"><i class="fa fa-check"></i> </a>
                      @endif
                      <button class="btn btn-danger" onclick="archiveFunction('form{{$role['id']}}')"><i class="fa fa-trash"></i></button>
                    </td> 
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Menu Title</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th>Modified By</th>
                  <th>Modified At</th>
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
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
  $('#table_data').DataTable();
</script>
@endpush