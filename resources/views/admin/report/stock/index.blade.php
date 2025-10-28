@extends('layouts.admin.app')

@section('title', 'Stock Alert')

@section('css')

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Stock Alert</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- All Client Table Start -->
        <div class="row">
            <div class="col-12">
               
                <div class="card">
                    <div class="card-body">
                        <div  id="basic-2_wrapper" class="dataTables_wrapper px-2 row">
                            <div class="col-md-3">
                                <div class="dataTables_length">
                                    <label>Show 
                                        <select name="basic-2_value"  id="basic-2_value" aria-controls="basic-2" class="form-control form-control-sm">
                                            <option value="50">50</option>
                                            <option value="250">250</option>
                                            <option value="500">500</option>
                                            <option value="1000">1000</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dataTables_filter">
                                    <label>Filter 
                                        <select name="basic-2_filter"  id="basic-2_filter" aria-controls="basic-2" class="form-control form-control-sm">
                                            <option value="All" {{request()->title == 'all' ? 'selected':''}}>All</option>
                                            <option value="Alert Stock"  {{request()->title == 'Alert Stock' ? 'selected':''}} >Alert Stock</option>
                                            <option value="Zero Stock" {{request()->title == 'Zero Stock' ? 'selected':''}}>Zero Stock</option>
                                            <option value="Over Stock" {{request()->title == 'Over Stock' ? 'selected':''}}>Over Stock</option>
                                        </select> 
                                    </label>
                                    
                                </div>
                            </div>
                            <div class="col-md-3">
                                
                            </div>
                            <div class="col-md-3">
                                <div class="dataTables_filter">
                                    <label>Search:
                                        <input type="search"  id="basic-2_search" class="form-control form-control-sm" placeholder="Search" aria-controls="basic-2" data-bs-original-title="" title="">
                                    </label>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="dt-ext" id="get_datatable">
                            <div class="loader-box"><div class="loader-37"></div></div>
                            
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- All Client Table End -->
    </div>


    <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="ajax_html">
            
        </div>
    </div>

    <audio id="myAudio" controls class="d-none">
        <source src="{{ asset('audio/Beep.wav') }}" type="audio/wav">
    </audio>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            get_datatable();
        });

        $(document).on('click','.pages a',function(n){
            n.preventDefault();
            var page = $(this).attr('href').split("page=")[1];
            get_datatable(page);
        });
        $('#basic-2_wrapper').on('change keyup' ,function(){
            get_datatable(1);
        })

        function get_datatable(page){
            $('#get_datatable').html('<div class="loader-box"><div class="loader-37"></div></div>');
            var value = $('#basic-2_value').val();
            var search = $('#basic-2_search').val();
            var filter = $('#basic-2_filter').val();
            var page = page ?? 1;
            $.get('{{ route("manage_stock.report_datatable") }}?page='+page+'&value='+value+'&search='+search+'', { _token: "{{csrf_token() }}",filter:filter}, function(data){
                $('#get_datatable').html(data);
                $('#basic-test').DataTable({
                    dom: 'Brtp',
                    pageLength: -1,
                    responsive: true,
                    buttons: [
                        'copy', 
                        'excel', 
                        'csv', 
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            download: 'open', // This tells pdfMake to open instead of download
                            orientation: 'portrait', // Optional
                            pageSize: 'A4', // Optional
                            title: 'Aasha Fashion - Stock Alert' // Optional
                        },
                        'print'
                    ]
                });
            });
        }

      

      
    </script>
@endsection
