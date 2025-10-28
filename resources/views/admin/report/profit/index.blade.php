@extends('layouts.admin.app')

@section('title', 'Profit Report')

@section('css')

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Profit Report</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- All Client Table Start -->
        <div class="row">
            <div class="col-12">
               
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
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dataTables_filter">
                                    <label>From Date 
                                       <input type="date" name="from_date" value="{{date('Y-m-d')}}" id="from_date" class="form-control form-control-sm">
                                    </label>
                                    
                                </div>
                            </div>
                                
                                <div class="col-md-3">
                                    <div class="dataTables_filter">
                                        <label>To Date 
                                           <input type="date" name="to_date" id="to_date" class="form-control form-control-sm">
                                        </label>
                                        
                                    </div>
                                </div>
                            {{-- <div class="col-md-3">
                                <select class="form-control js-example-basic-single" multiple name="filter[]">
                                    <option value="Income">Income</option>
                                    <option value="Expense">Expense</option>
                                    <option value="Payment">Payment</option>
                                </select>
                            </div> --}}
                            <div class="col-md-4">
                                {{-- <div class="dataTables_filter">
                                    <label>Search:
                                        <input type="search"  id="basic-2_search" class="form-control form-control-sm" placeholder="Search" aria-controls="basic-2" data-bs-original-title="" title="">
                                    </label>
                                    
                                </div> --}}
                            </div>
                        </div>
                       
                       
                    </div>
                    <div class="dt-ext p-2" id="get_datatable">
                        <div class="loader-box"><div class="loader-37"></div></div>
                        
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
       

        function get_datatable(page){
            $('#get_datatable').html('<div class="loader-box"><div class="loader-37"></div></div>');
            var value = $('#basic-2_value').val();
            var search = $('#basic-2_search').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var page = page ?? 1;
            $.get('{{ route("profit.report.datatable") }}?page='+page+'&value='+value+'&search='+search+'', { _token: "{{csrf_token() }}",from_date:from_date,to_date:to_date}, function(data){
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
                            title: 'Aasha Fashion - Profit Report' // Optional
                        },
                        'print'
                    ]
                });
            });
        }

      

      
    </script>
@endsection
