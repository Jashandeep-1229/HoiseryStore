@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('css')
   
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
@endsection
@section('custom_title')
    <div class="dataTables_wrapper">
      <div id="datatable_filter" class="dataTables_filter mb-0" style="float:left !important;">
        <label>From Date 
           <input type="date" name="from_date" id="from_date"  value="{{date('Y-m-01')}}" onchange="get_widget();get_datatable();"  class="form-control form-control-sm">
        </label>
        
    </div>
      <div id="datatable_filter" class="dataTables_filter mb-0" style="float:left !important;">
        <label>To Date 
           <input type="date" name="to_date" id="to_date"  onchange="get_widget();get_datatable();"  class="form-control form-control-sm">
        </label>
        
    </div>
    <div class="dataTables_filter mb-0" style="float:left !important; margin-left:10px;">
      <button id="toggle_widget" class="btn btn-sm btn-primary">
        Show 
      </button>
    </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row widget-grid" id="get_widget" style="display:none;">
    <div class="loader-box"><div class="loader-37"></div></div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div  id="basic-2_wrapper" class="dataTables_wrapper px-2 row" onchange="get_datatable()">
            <div class="col-md-2">
                <div class="dataTables_length">
                    <label>Show 
                        <select name="basic-2_value"  id="basic-2_value" aria-controls="basic-2" class="form-control form-control-sm">
                            <option value="50">50</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select> entries
                    </label>
                </div>
            </div>
            <div class="col-md-3">
               
            </div>
                
                <div class="col-md-3">
                   
                </div>
          
            <div class="col-md-4">
                <div class="dataTables_filter">
                    <label>Search:
                        <input type="search"  id="basic-2_search" class="form-control form-control-sm" placeholder="Search" aria-controls="basic-2" data-bs-original-title="" title="">
                    </label>
                    
                </div>
            </div>
        </div>
       <div class="dt-ext p-2" id="get_datatable">
          <div class="loader-box"><div class="loader-37"></div></div>
          
      </div>
    </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){
          // get_widget();
          get_datatable();
          $('#toggle_widget').click(function(){
            $('#get_widget').toggle(); // show/hide widget section

            if($('#get_widget').is(':visible')){
                $(this).text('Hide');
                get_widget(); // load widget data only when visible
            } else {
                $(this).text('Show');
            }
        });
    });
    $(document).on('click','#get_datatable .pages a',function(n){
        n.preventDefault();
        var page = $(this).attr('href').split("page=")[1];
        get_datatable(page);
    });
    function get_datatable(page){
      $('#get_datatable').html('<div class="loader-box"><div class="loader-37"></div></div>');
      var value = $('#basic-2_value').val();
      var search = $('#basic-2_search').val();
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      var page = page ?? 1;
      $.get('{{ route("dashboard.datatable") }}?page='+page+'&value='+value+'&search='+search+'', { _token: "{{csrf_token() }}",from_date:from_date,to_date:to_date}, function(data){
        $('#get_datatable').html(data);
        $('#basic-test').DataTable({ dom: 'Brt', "pageLength": -1 , responsive: true, scrollY: "50vh",
        scrollCollapse: true,});
      });
    }
    function get_widget(){
      $('#get_widget').html('<div class="loader-box"><div class="loader-37"></div></div>');
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      $.get('{{ route("dashboard.widget") }}', { _token: "{{csrf_token() }}",from_date:from_date,to_date:to_date}, function(data){
        $('#get_widget').html(data);
      });
    }
</script>
@endsection