<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">

  
  @if (\Request::is('profile') or \Request::is('customers/create') or Route::currentRouteName()=='customers.edit' or \Request::is('admins/create') or Route::currentRouteName()=='admins.edit' or \Request::is('categories/create') or Route::currentRouteName()=='categories.edit') 
  <link rel="stylesheet" href="{{ asset('css/fileinput.min.css') }}">
  @endif
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        
        <script src="{{ asset('js/app.js') }}"></script>

<!-- jQuery 3 
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
-->

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>


<!-- DataTables --> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

@if (Route::currentRouteName()=='createappointments' || Route::currentRouteName()=='createTasks' || Route::currentRouteName()=='editProjectTasks') 
  <!--For Date Pickers-->
  <!-- Date Picker CSS -->
  <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
  <!--Different JQuery Version only for Datepciker on Add/Edit Appintment Page-->
  <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
  <!-- DatePicker files  -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
@endif
<script>
console.log("{{Route::currentRouteName()}}");
</script>
<!--For Date Range Pickers-->
@if (Route::currentRouteName()=='leads.index' or Route::currentRouteName()=='leads.search' or Route::currentRouteName()=='createappointments') 
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endif
<!-- For Select2 -->
@if (Route::currentRouteName()=='leads.index' or Route::currentRouteName()=='leads.search' or Route::currentRouteName()=='createappointments' or Route::currentRouteName()=='leads.edit' ) 
<link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
@endif

   <!-- Theme style -->
   <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
   <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
           page. However, you can choose any other skin. Make sure you
           apply the skin class to the body tag so the changes take effect. -->
     <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-blue.min.css') }}">


     <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
     