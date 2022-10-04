<!-- Content Header (Page header) -->
<style>
.custom-form-control{
    display: initial;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }
.custom-input-group {
    position: relative;
    display: inline-grid;
    border-collapse: separate;
}
</style>
<style type="text/css">
.breadcrumb {
    padding: 8px 15px;
    margin-bottom: 20px;
    list-style: none;
    background-color: #f5f5f5;
    border-radius: 4px;
}

  .content-header .breadcrumb {
    float: right;
    background: transparent;
    margin-top: 0;
    margin-bottom: 0;
    font-size: 14px;
    padding: 7px 5px;
    position: absolute;
    top: 15px;
    right: 10px;
    border-radius: 2px;
}
.breadcrumb > li {
    margin-top: 0px;
}
.content-header .breadcrumb li a {
    color: #444;
    text-decoration: none;
    display: inline-block;
}

</style>
<section class="content-header">
{{--
   <h1>
    {{ ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard' }}
   
  </h1>
 {{ Breadcrumbs::render() }}
  @if (\Request::is('dashboard'))  
<span class="pull-right">
          <div class="custom-input-group">
              <button type="button" class="btn btn-default" id="daterange-btndashboard">
                <span>{{date('F d, Y')}} - {{date('F d, Y')}}</span>
                <input type="hidden" name="dateFrom" id="dateFrom" value="{{date('Y-m-d')}}">
                <input type="hidden" name="dateTo" id="dateTo" value="{{date('Y-m-d')}}">
                <i class="fa fa-caret-down"></i>
              </button>
            </div>
          <script>
              
              $(document).ready(function() { 
                
                //Date range as a button
                $('#daterange-btndashboard').daterangepicker(
                  {
                    ranges   : {
                      'Today'       : [moment(), moment()],
                      'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                      'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                      'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                      'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                  },
                  function (start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    $('#dateFrom').val(start.format('YYYY-MM-DD'));
                    $('#dateTo').val(end.format('YYYY-MM-DD'));
                    var maintabledate = $('#table_data').DataTable();
                    maintabledate.column('6').search(
                    $('#dateFrom').val()+','+$('#dateTo').val()
                    ).draw();
                  }
                );
              
                  
                });

          </script>

          <select class="custom-form-control">
            <option value="0">Overall</option>
            <option value="1">Florin Ristea</option>
            <option value="2">Dave Miller</option>
            <option value="3">Dale Styne</option>
          </select>
          <button type="button" class="btn btn-primary"><li class="fa fa-search"></li></button>
        </span>
        @endif

        @if (Route::currentRouteName()=='statistics.index')
        <span class="pull-right">
            <div class="custom-input-group">
                <select class="custom-form-control" name="country" id="country">
                    <option value="0">All Country</option>
                    <option value="1" selected>South Africa</option>
                    <option value="2">Australia</option>
                    <option value="3">USA</option>
                </select>
            </div>  
            <div class="custom-input-group">
                <select class="custom-form-control" name="city" id="city">
                    <option value="0">All City</option>
                    <option value="1" selected>Johannesburg</option>
                    <option value="2">Cape Town</option>
                    <option value="3">Port Elizabeth</option>
                </select>
            </div>
           
            <div class="custom-input-group">
                <button type="button" class="btn btn-default" id="daterange-btndashboard">
                  <span>{{date('F d, Y')}} - {{date('F d, Y')}}</span>
                  <input type="hidden" name="dateFrom" id="dateFrom" value="{{date('Y-m-d')}}">
                  <input type="hidden" name="dateTo" id="dateTo" value="{{date('Y-m-d')}}">
                  <i class="fa fa-caret-down"></i>
                </button>
              </div>
            <script>
                
                $(document).ready(function() { 
                  
                  //Date range as a button
                  $('#daterange-btndashboard').daterangepicker(
                    {
                      ranges   : {
                        'Today'       : [moment(), moment()],
                        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                      },
                      startDate: moment().subtract(29, 'days'),
                      endDate  : moment()
                    },
                    function (start, end) {
                      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                      $('#dateFrom').val(start.format('YYYY-MM-DD'));
                      $('#dateTo').val(end.format('YYYY-MM-DD'));
                      var maintabledate = $('#table_data').DataTable();
                      maintabledate.column('6').search(
                      $('#dateFrom').val()+','+$('#dateTo').val()
                      ).draw();
                    }
                  );
                
                    
                  });
  
            </script>

          <button type="button" class="btn btn-primary"><li class="fa fa-search"></li></button>
        </span>
        @endif
 --}}        
</section>
<div class="clearfix"></div>