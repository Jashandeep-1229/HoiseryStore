@extends('layouts.admin.app')

@section('title', 'Remaining Stock')

@section('css')

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Remaining Stock</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- All Client Table Start -->
        <div class="row">
            <div class="col-12">
              
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title">All Remaining Stock <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-eye"></i></a></h5>
                            <div class="collapse" id="collapseExample">
                                <div class="d-flex gap-4">
                                    <h5 class="card-title text-primary">Grand Total - {{formatIndianNumber($grand_total_stock)}} Pcs</h5>
                                    <h5 class="card-title text-info">
                                        Total Purchase - ₹ {{ formatIndianNumber($totals->total_purchase_amount, 2, '.', ',') }}
                                    </h5>
                                    <h5 class="card-title text-success">Total Sale - {{formatIndianNumber($totals->total_sale_amount)}}</h5>
                                </div>
                            </div>
                    </div>
                    <div class="card-body">
                        <div  id="basic-2_wrapper" class="dataTables_wrapper px-2" onchange="get_datatable()">
                            <div class="row justify-content-between">
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
                                    <select class="form-control js-example-basic-single" id="brand_id">
                                        <option value="">Select Brand</option>
                                        @foreach($brand as $brd)
                                        <option value="{{$brd->id}}">{{ $brd->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control js-example-basic-single" id="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($category as $cat)
                                        <option value="{{$cat->id}}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control js-example-basic-single" id="season_id">
                                        <option value="">Select Season</option>
                                        @foreach($season as $sea)
                                        <option value="{{$sea->id}}">{{ $sea->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                               
                                <div class="col-md-3">
                                    <div class="dataTables_filter" style="float:right !important">
                                        <label>Search:
                                            <input type="search"  id="basic-2_search" class="form-control form-control-sm" placeholder="" aria-controls="basic-2" data-bs-original-title="" title="">
                                        </label></div>
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


    <div class="modal fade" id="edit_modal"  aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="ajax_html">
            
        </div>
    </div>

    <audio id="myAudio" controls class="d-none">
        <source src="{{ asset('audio/Beep.wav') }}" type="audio/wav">
    </audio>
@endsection
@section('script')
<script>
    var x = document.getElementById("myAudio"); 
    
    function playAudio() { 
      x.play(); 
    } 
    </script>
    <script>
       
       $(document).on('click','.pages a',function(n){
            n.preventDefault();
            var page = $(this).attr('href').split("page=")[1];
            get_datatable(page);
        });
        $(document).ready(function(){
            get_datatable();
        })
        function get_datatable(page){
            $('#get_datatable').html('<div class="loader-box"><div class="loader-37"></div></div>');
            var value = $('#basic-2_value').val();
            var search = $('#basic-2_search').val();
            var brand_id = $('#brand_id').val();
            var category_id = $('#category_id').val();
            var season_id = $('#season_id').val();
            var page = page ?? 1;
            $.get('{{ route("average_stock.datatable") }}?page='+page+'&value='+value+'&search='+search+'', { _token: "{{csrf_token() }}",brand_id:brand_id,category_id:category_id,season_id:season_id}, function(data){
                $('#get_datatable').html(data);
                  $('#basic-test').DataTable({ dom: 'Brt', "pageLength": -1 , responsive: true, scrollY: "50vh",
                scrollCollapse: true,});
            });
        }
        
    </script>
@endsection
