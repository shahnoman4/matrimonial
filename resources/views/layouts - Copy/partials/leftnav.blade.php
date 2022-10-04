<?php

//echo "string";exit();
$user = Auth::user();
//dd($user);
$permissions=explode(",",$user->role->permission);
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ asset('img/staff/'.$user->avatar) }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{$user->fname}} {{$user->lname}}</p>
      <!-- <p>Super Admin</p> -->
    </div>
  </div>
  <?php $urlpath=Request::path();  ?>
  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">NAVIGATION</li>
    @if(count($navs) > 0)
      @foreach($navs as $nav)
        @if(count($nav->childrenformenu) > 0)
         @if(in_array($nav->id,$permissions) &&  $nav->showinnav==1)
            <li class="treeview {{ (strpos($nav->mselect,$urlpath) !== false || strpos($nav->mselect, Route::currentRouteName()) !== false  )  ? "active" : "" }}">
              <a href="#"><i class="{{ $nav->iconclass  }}"></i> <span>{{ $nav->menutitle  }} </span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
                @if(! empty ($nav->childrenformenu))
                  <ul class="treeview-menu">
                  @foreach($nav->childrenformenu as $childnav)
                    @if(in_array($childnav->id,$permissions) && $childnav->showinnav==1)
                    <li class="{{ (strpos($childnav->mselect,$urlpath) !== false || strpos($childnav->mselect, Route::currentRouteName()) !== false  )  ? "active" : "" }}"><a href="{!! url($childnav->urllink); !!}">{{$childnav->menutitle}}
                      </a></li>
                    @endif
                  @endforeach
                  </ul>
                @endif
            </li> 
          @endif

        @else
          @if(in_array($nav->id,$permissions)  && $nav->showinnav==1)
            <li  class="{{ strpos($nav->mselect,$urlpath)  !== false ? "active" : "" }}"><a href="{!! url($nav->urllink); !!}"><i class="{{ $nav->iconclass  }}"></i> <span>{{ $nav->menutitle  }}</span></a></li>
          @endif
        @endif
        
      @endforeach

  
    @endif
    <li>
          <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out"></i> <span>Logout</span>
        </a>
      </li>
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>