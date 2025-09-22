@extends('layouts.admin.app')

@section('title', 'Barcode Print')

@section('css')

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Barcode Print</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- All Client Table Start -->
        <div class="row">
            <div class="col-12">
               
                <div class="card">
                   
                    <div class="card-body">
                        <div  id="basic-2_wrapper" class="dataTables_wrapper px-2">
                            <div class="row justify-content-between">
                                
                                <div class="col-md-3">
                                    <select class="form-control js-example-basic-single" id="brand_id" onchange="get_item_list()">
                                        <option value="">Select Brand</option>
                                        @foreach($brand as $brd)
                                        <option value="{{$brd->id}}">{{ $brd->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control js-example-basic-single" id="category_id" onchange="get_item_list()">
                                        <option value="">Select Category</option>
                                        @foreach($category as $cat)
                                        <option value="{{$cat->id}}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control js-example-basic-single" name="item_detail_id[]" id="item_detail_id" multiple>
                                        <option value="">Select Article</option>
                                        @foreach($item_detail as $item)
                                        <option value="{{$item->id}}">{{ $item->article_name }}-{{$item->size}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button onclick="get_result()" id="add_data" class="btn btn-primary w-100" >Result</button>
                                </div>
                               
                               
                            </div>
                        </div>
                        <div class="dt-ext" id="get_datatable">
                            <h5 class="text-center mt-4">Please Select Brand | Category | Article </h5>
                            
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
       
       $(document).on('ready click change','#category_id,#brand_id',function(){
            get_item_list();
        })
        function get_item_list(){
            var brand_id = $('#brand_id').val();
            var category_id = $('#category_id').val();
            $('#item_detail_id').select2({
                disable:true,
            })
            $.get('{{ route("barcode.get_item_list") }}', { _token: "{{csrf_token() }}",brand_id:brand_id,category_id:category_id}, function(data){
                $('#item_detail_id').html(data);
                $('#item_detail_id').select2({
                    disable:false,
                })
            });
        }
        function get_result(){
            var item_detail_id = $('#item_detail_id').val();
            var brand_id = $('#brand_id').val();
            var category_id = $('#category_id').val();
            $.get('{{ route("barcode.get_result") }}', { _token: "{{csrf_token() }}",item_detail_id:item_detail_id,brand_id:brand_id,category_id:category_id}, function(data){
                $('#get_datatable').html(data);
            });
        }
        function get_print_barcode(){
            var item_detail_id = $('#item_detail_id').val();
            var brand_id = $('#brand_id').val();
            var category_id = $('#category_id').val();
            window.open('{{ url('admin/get-barcode-print') }}?item_detail_id='+item_detail_id+'&brand_id='+brand_id+'&category_id='+category_id, '_blank');
        }
        
    </script>
@endsection
