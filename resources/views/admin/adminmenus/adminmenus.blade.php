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
              <h3 class="box-title">Manage Admin Menu</h3>
              <span class="pull-right">
              <a href="{!! url('/menu/create'); !!}" class="btn btn-info"><span class="fa fa-plus"></span> Add New Menu</a>
              </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($adminmenus) > 0)
              <table id="table_data" class="display table-striped table-bordered responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Menu Title</th>
                  <th>Slug</th>
                  <th>Parent</th>
                  <th>Show in Nav</th>
                  <th>Default</th>
                  <th>URL/Route</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($adminmenus as $menu)
                  <tr>
                    <td>{{$menu['menutitle']}}</td>
                    <td>{{$menu['slug']}}</td>
                    <td>{{ $menu['parentid'] === null ? "-" : $menu['parent']['menutitle'] }} </td>
                    <td>{{ $menu['showinnav'] == "1" ? "Yes" : "No" }}</td>
                    <td>{{ $menu['setasdefault'] == "1" ? "Yes" : "No" }}</td>
                    <td>{{$menu['urllink']}}</td>
                    <td>{{ $menu['status'] == "1" ? "Active" : "Deactive" }}</td>
                     <!-- For Delete Form begin -->
                    <form id="form{{$menu['id']}}" action="{{action('Admin\AdminmenuController@destroy', $menu['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                    <!-- For Delete Form Ends -->
                    <td>
                      <!--<a href="{!! url('/menu/'.$menu['id']); !!}" class="btn btn-primary" title="View Detail"><i class="fa fa-eye"></i> </a>-->
                      <a href="{!! url('/admin/menu/'.$menu['id'].'/edit'); !!}"  class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>
                      @if ($menu['status'] === 1)
                        <a href="{!! url('/admin/menu/deactivate/'.$menu['id']); !!}"  class="btn btn-warning" title="Deactivate"><i class="fa fa-times"></i> </a>
                      @else
                        <a href="{!! url('/admin/menu/active/'.$menu['id']); !!}"  class="btn btn-info" title="Active"><i class="fa fa-check"></i> </a>
                      @endif
                      <button class="btn btn-danger" onclick="archiveFunction('form{{$menu['id']}}')"><i class="fa fa-trash"></i></button>
                    </td> 
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Menu Title</th>
                  <th>Slug</th>
                  <th>Parent</th>
                  <th>Show in Nav</th>
                  <th>Is Default</th>
                  <th>URL/Route</th>
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