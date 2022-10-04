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
<?php


 $user = Auth::user();

?>






 <script type="text/javascript" src="{{asset('public/js/FileSaver.js')}}"></script> 
<script type="text/javascript" src="{{asset('public/js/tableExport.js')}}"></script>   
<script type="text/javascript">
function fnExcelReport() 
{ 
  //$(".loading").fadeIn();
 $("table").tableExport({
  headings: false, 
  type:'excel'
}); 
 //$(".loading").fadeOut();
 }
</script>
@push('scripts')
<!-- For Charts -->
<!-- <script src="{{asset('bower_components/chart.js/Chart.js')}}"></script>
 -->
@can('show-dashboard-calendar')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> -->





{{-- $calendar->script() --}}
@endcan
@endpush

@stop 