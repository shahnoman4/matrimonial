<?php
$user = Auth::user();
//dd($user);
?>
 <!-- Main Header -->
 <header class="main-header">
<!-- Logo -->
<a href="{!! url('/admin/home'); !!}" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b></b></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>Matrimonial</b></span>
</a>

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">

      <!-- Notifications Menu -->
      <li class="dropdown notifications-menu">
        <!-- Menu toggle button -->
      {{--  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning">{{Auth::user()->unreadNotifications->count()}}</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have {{Auth::user()->unreadNotifications->count()}} unread notification(s)</li>
          <li>
            <!-- Inner Menu: contains the notifications -->
            <ul class="menu">
              @foreach(Auth::user()->unreadNotifications as $notification)
              <li><!-- start notification -->
                <a href="{{$notification->data['letter']['actionURL']}}/{{$notification->id}}" title="{{$notification->data['letter']['data']['name']}}" data-notif-id="{{$notification->id}}">
                  <i class="fa fa-users text-aqua"></i> {{$notification->data['letter']['body']}}
                </a>
              </li>
              <!-- end notification -->
              @endforeach
            </ul>
          </li>
          @if(Auth::user()->unreadNotifications->count() > 0)
          <li class="footer"><a href="{{route('notification.index')}}">View all</a></li>
          @endif
        </ul>
        --}}
      </li>
      
      
      <!-- User Account Menu -->
      <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <img src="{{asset('img/staff/'.$user->avatar)}}" class="user-image" alt="User Image">
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{$user->name}}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- The user image in the menu -->
          <li class="user-header">
            <img src="{{ asset('img/staff/'.$user->avatar)}}" class="img-circle" alt="User Image">
            <p>
              {{$user->name}}
              <small>Member since {{$user->created_at->format('M, Y')}}</small>
             {{-- <small>Last login at {{auth()->user()->lastLoginAt() !="" ? auth()->user()->lastLoginAt()->diffForHumans() : "NA"}}</small>--}}
              
            </p>
          </li>
          <li class="user-footer">
            <div>
              <a href="{!! url('/admin/profile'); !!}" class="btn btn-primary btn-flat">Profile</a>
              <a href="{!! url('/admin/changepassword'); !!}" class="btn btn-warning btn-flat">Change Password</a>
              <a class="btn btn-danger btn-flat" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
            
          </li>
        </ul>
      </li>
      
    </ul>
  </div>
</nav>
</header>