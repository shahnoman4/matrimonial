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
<section class="content">
    <div class="error-page">
        <h2 class="headline text-yellow" style="margin-top: -15px;"> 404</h2>
        <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
        <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="{!! url('/dashboard/'); !!}">return to dashboard</a>.
        </p>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>
  @endsection