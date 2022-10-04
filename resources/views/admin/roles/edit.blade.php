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
<style>
/* Customize the label (the container) */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 18px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/*  Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update New Role</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{action('Admin\RoleController@update', $role->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="box-body">
                <!--Roles -->
                <div class="form-group col-sm-12">
                    <label for="role_title">Role Title*</label>
                    <input id="role_title" name="role_title" type="text" class="form-control" placeholder="Enter Role Title" require value="{{$role->role_title}}">
                    @if ($errors->has('role_title'))
                          <span class="text-red">
                              <strong>{{ $errors->first('role_title') }}</strong>
                          </span>
                      @endif
                </div>
                @if(count($menulist) > 0)
                <div class="form-group  col-sm-12">
                    <h4>
                    <span class='fa fa-bars text-blue role_title' ></span> Menu/Navigation in side bar, 
                    <span class='fa fa-lock text-red role_title' ></span> Permissions on action
                    </h4>
                  </div>
                <div class="form-group  col-sm-12">
                    <label>Assign Permissions*</label>
                </div>
                <div class="form-group col-sm-6">
                     <ul style="list-style:none">
                     @foreach($menulist as $menu)
                        @if(count($menu->children))
                            <li>
                            <label class="container">
                            <input type="checkbox" name="role_arr[]" value="{{$menu->id}}" {{(in_array($menu->id, $permission)) ? "checked":""}}>
                            <span class="checkmark"></span>
                            {!! $menu->showinnav==1 ? "<span class='fa fa-bars text-blue' ></span>" : "<span class='fa fa-lock text-red'></span>" !!} {{$menu->menutitle}}</label>
                                @if(! empty ($menu->children))
                                <ul  style="list-style:none;">
                                    @foreach($menu->children as $cmenu)
                                        <li>
                                            <label class="container">
                                            <input type="checkbox" id="child_menu_2" name="role_arr[]" value="{{$cmenu->id}}" {{(in_array($cmenu->id, $permission)) ? "checked":""}}>
                                            <span class="checkmark"></span>
                                            {!! $cmenu->showinnav==1 ? "<span class='fa fa-bars text-blue' ></span>" : "<span class='fa fa-lock text-red'></span>" !!} {{$cmenu->menutitle}}</label>
                                        </li>
                                        @endforeach
                                </ul>
                                @endif
                                </li>
                        @else
                         <li>
                            <label class="container">
                            <input type="checkbox"  name="role_arr[]" value="{{$menu->id}}" {{(in_array($menu->id, $permission)) ? "checked":""}}>
                            <span class="checkmark"></span>
                            {!! $menu->showinnav==1 ? "<span class='fa fa-bars text-blue' ></span>" : "<span class='fa fa-lock text-red'></span>" !!} {{$menu->menutitle}}
                            </label>
                        </li>
                        @endif
                    @endforeach
                    </ul>
                    </div>
                @else
                    No Record found.
                @endif
                <!-- Roles -->
            </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/roles'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Update Role</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
@endsection