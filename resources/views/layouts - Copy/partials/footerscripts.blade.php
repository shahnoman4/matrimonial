<!-- REQUIRED JS SCRIPTS -->


<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- Sweet Alert JS -->
<script src="{{ asset('js/sweetalert.min.js') }}" defer></script>

<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>

<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
     <!-- page script -->
@if (\Request::is('admins') or \Request::is('roles')  or \Request::is('projects') or \Request::is('categories') or \Request::is('menu') or \Request::is('customers') or \Request::is('leads') or Route::currentRouteName()=='leads.show' or \Request::is('recordings') or Route::currentRouteName()=="appointments.index" or Route::currentRouteName()=="appointments" or Route::currentRouteName()=="recordings.index" or Route::currentRouteName()=="recordings"  or Route::currentRouteName()=="tasks" or \Request::is('dashboard') or Route::currentRouteName()=='leads.search' or \Request::is('chapters') or \Request::is('topics') or Route::currentRouteName()=="leads.indexmain")  
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

  <script>
    $(function () {
      $('#example1').DataTable( {
        "order": [[ 0, "desc" ]]
      });
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>
@endif
@if (Route::currentRouteName()=='leads.show')
  <script>
      $(function () {
        $('#nofeatures').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false
        })
      });
      $(function () {
        $('#nofeaturesapp').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false
        })
      });
      $(function () {
        $('#nofeaturesdocs').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false
        })
      });
      $(function () {
        $('#nofeaturesproposal').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false
        })
      }); 
    </script> 
@endif
@if (Route::currentRouteName()=='admins.show' or Route::currentRouteName()=='customers.show')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script>
      $(function () {
        $('#loginlogs').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
        })
      });
    </script> 
@endif


@if(\Request::is('admins')  or \Request::is('categories') or \Request::is('projects') or \Request::is('menu') or \Request::is('roles') or \Request::is('customers') or \Request::is('leads') or Route::currentRouteName()=='leads.search' or \Request::is('topics'))
<script>
  function archiveFunction(formid) {
    event.preventDefault(); // prevent form submit
      
    swal({
            title: "Delete",
            text: "Are you sure want to delete?", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $('#'+formid).submit();
          } 
        });
      

    }
</script>  
@endif

@if (\Request::is('profile') or \Request::is('admins/create') or Route::currentRouteName()=='admins.edit' or \Request::is('categories/create') or Route::currentRouteName()=='categories.edit' or Route::currentRouteName()=='customers.edit'   or \Request::is('customers/create'))
<script src="{{ asset('js/fileinput.min.js') }}"></script>
  <script>
  @if(Route::currentRouteName()=='admins.edit' or \Request::is('profile') or Route::currentRouteName()=='customers.edit')
      var avatarName="{{ asset ('img/staff/'.$user->avatar)}}";
    @else
    var avatarName="{{ asset ('img/placeholder.png') }}";
    @endif

  $("#avatar-1").fileinput({
      overwriteInitial: true,
      maxFileSize: 1000,
      showClose: false,
      showCaption: false,
      browseLabel: '',
      removeLabel: '',
      browseOnZoneClick: true,
      browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
      removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
      removeTitle: 'Cancel or reset changes',
      elErrorContainer: '#kv-avatar-errors-1',
      msgErrorClass: 'alert alert-block alert-danger',
      defaultPreviewContent: '<img src="'+ avatarName +'" alt="Avatar" width="100%">',
      layoutTemplates: {main2: '{preview} {browse}'},
      allowedFileExtensions: ["jpg", "png", "gif"]
  });
  </script>
@endif
@if (\Request::is('dashboard'))  
<script>
  $(function () {
    $('#nofeaturesproposal').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    })
  }); 
</script> 
@endif
<script>
$('a[data-notif-id]').hover(function () {

var notif_id   = $(this).data('notifId');
var targetHref = $(this).data('href');
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$.post('/readnofication', {'id': notif_id}, function (data) {
    data.success ? (console.log('Done')) : false;
    //data.success ? (window.location.href = targetHref) : false;

});

return false;
});
</script>
