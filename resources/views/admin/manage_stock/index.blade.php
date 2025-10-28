@extends('layouts.admin.app')

@section('title', 'Manage Stock')

@section('css')

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Manage Stock ({{ucfirst($title)}})</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- All Client Table Start -->
        <div class="row">
            <div class="col-12">
                <div class="card" id="add_brand">
                    <form action="{{route('manage_stock.store')}}" method="POST" id="" class="modal-content" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="col-md-3 form-group mb-3">
                                @if($title != 'View Statement')
                                <h6>Select Article <span>*</span></h6>
                                <select class="form-control js-example-basic-single" name="item_detail_id" id="item_detail_id">
                                    @foreach($item_detail as $detail)
                                    <option value="{{$detail->id}}">{{$detail->article_name}} - {{$detail->size ?? ''}}</option>
                                    @endforeach
                                </select>
                                @else
                                <h6>Article <span>*</span></h6>
                                <input type="hidden" name="item_detail_id" value="{{$article->id}}">
                                <input type="text" value="{{$article->article_name ?? ''}} {{$article->size ?? ''}}" readonly class="form-control">
                                @endif
                            </div>
                            @if($title != 'View Statement')
                            <div class="col-md-3 form-group mb-3">
                                <h6>Scan Barcode</h6>
                                <input type="text" class="form-control" id="barcode" name="barcode" placeholder = "Scan Barcode">
                            </div>
                            @endif
                            <div class="col-md-2 form-group mb-3">
                                <h6>Quantity <span>*</span></h6>
                                <input type="number" class="form-control"  step="any" id="quantity"  name="quantity" placeholder = "Enter Qty" required {{$title == 'out' ? 'disabled':''}}>
                                
                                <label class="text-primary f-w-600" id="quantity_label" style="display:none">Available Qty : <span id="get_quantity" class="text-primary"></span></label>
                            </div>
                            <div class="col-md-2 form-group mb-3">
                                <h6>Date <span>*</span></h6>
                                <input type="date" class="form-control" id="date" name="date" value="{{date('Y-m-d')}}" required  max="{{date('Y-m-d')}}">
                                
                            </div>
                            @if($title != 'View Statement')
                            <div class="col-md-1 form-group mb-3 d-none">
                                <h6>Type <span>*</span></h6>
                                <select class="form-control" name="in_out" id="in_out">
                                    <option value="In" {{$title == 'in' ? 'selected':''}} >In</option>
                                    <option value="Out" {{$title == 'out' ? 'selected':''}}>Out</option>
                                </select>
                               </div>
                            @else
                            <div class="col-md-1 form-group mb-3">
                                <h6>Type <span>*</span></h6>
                                <select class="form-control" name="in_out" id="in_out">
                                    <option value="In"  >In</option>
                                    <option value="Out">Out</option>
                                </select>
                               </div>
                            @endif
                            <div class="col-md-2">
                                <h6>&nbsp;</h6>
                               <button type="submit" id="add_data" class="btn btn-primary w-100" >Add +</button>
                            </div>
                           
                        </div>
                    </form>
                </div>
                <div class="card">
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
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="dataTables_filter">
                                    <label>From:
                                        <input type="date"  id="from_date" class="form-control form-control-sm" placeholder="">
                                    </label></div>
                                    
                                </div>
                                <div class="col-md-2">
                                    <div class="dataTables_filter" style="float:left !important">
                                    <label>To:
                                        <input type="date"  id="to_date" class="form-control form-control-sm" placeholder="">
                                    </label></div>

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
         let scanLock = false;
        $(document).on('ready click change','#item_detail_id,#barcode',function(){
            calculate_quantity();
        })
        $(document).ready(function(){
            get_datatable();
            $("#name").focus();
            $('#barcode').on('keydown', function (e) {
                if (e.key === "Enter") {
                    e.preventDefault(); // Stop form submission
                    const articleNo = $(this).val(); // Get input value
                    if (articleNo) {
                        if (scanLock) return;
                           scanLock = true;
                        get_article_id(articleNo);
                    } else {
                        alert("Please enter correct barcode.");
                    }
                }
            });
        });
        function get_article_id(barcode){
            var title = "{{$title}}";
            if(barcode){
                var url = "{{route('item.get_barcode')}}";
                $.get(url,{barcode:barcode}, function(data){
                    if(data.result == 1){
                        $('#item_detail_id').val(data.data.id).trigger('change');
                       
                        if(title == 'in' || title == 'out'){
                            let currentQty = parseInt($('#quantity').val()) || 0;
                            $('#quantity').val(currentQty + parseInt(data.data.quantity));
                            playAudio();
                            $('#barcode').val('');
                        }
                       
                        calculate_quantity();
                    }else if(data.result == -2){
                        $.notify({ title:'Danger', message:data.message }, { type:'danger', });
                    }
                    }).always(function(){
                       // release the lock after the request finishes
                       scanLock = false;
                   });
            }
        }

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
            var article = "{{$article->id ?? ''}}"
            var page = page ?? 1;
            $.get('{{ route("manage_stock.datatable") }}?page='+page+'&value='+value+'&search='+search+'', { _token: "{{csrf_token() }}",title:"{{$title}}",from_date:from_date,to_date:to_date,article:article}, function(data){
                $('#get_datatable').html(data);
                  $('#basic-test').DataTable({ dom: 'Brt', "pageLength": -1 , responsive: true, scrollY: "50vh",
                scrollCollapse: true,});
            });
        }

        function edit_modal(id,key_value){
            var url = "{{route('manage_stock.edit_modal',":id")}}";
            url = url.replace(':id',id);
            $('#ajax_html').html('<div class="loader-box"><div class="loader-37"></div></div>');
            $.get(url,{key_value:key_value}, function(data){
                $('#ajax_html').html(data);
                $('.js-example-basic-single').select2();
            });
        }

        $(document).on('submit','form',function(event){
            event.preventDefault();
            var form = event.target;
            var form_data = new FormData(form);
            $('form button[type="submit"]').addClass('disabled');
            $.ajax({
                url: $(event.target).attr('action'),
                type: 'POST',
                data: form_data,
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.result == 1){
                        $.notify({ title:'Success', message:data.message }, { type:'success', });
                        var page = Number($(".pages").find('span[aria-current="page"] span').text());
                        $('#name').val('');
                        $('form button[type="submit"]').html('Save');
                        $('form button[type="submit"]').removeClass('disabled');
                        get_datatable(page);
                        $('#edit_modal').modal('hide');
                    }else{
                        $.notify({ title:'Error', message:data.message }, { type:'danger', });
                        $('form button[type="submit"]').html('Save');
                        $('form button[type="submit"]').removeClass('disabled');
                    }
                }
            });
        });
        function delete_stock(id){
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var url = "{{route('manage_stock.delete',":id")}}";
                    url = url.replace(':id',id);
                    $.get(url, function(data){
                        if(data.result == 1){
                            var page = Number($(".pages").find('span[aria-current="page"] span').text());
                            get_datatable(page);
                            $.notify({ title:'Deleted', message:data.message}, { type:'danger', });
                        }
                    })
                }
            })
        }
        function calculate_quantity(){
            var in_out = $('#in_out').val();
            var item_detail_id = $('#item_detail_id').val();
            var quantity = $('#quantity').val();
          
            if(item_detail_id != null){
                var url = "{{route('manage_stock.get_quantity')}}";
                $.get(url,{in_out:in_out,item_detail_id:item_detail_id,quantity:quantity}, function(data){
                    if(data.result != null){
                        $('#quantity_label').show(200);
                        $('#get_quantity').html(data.result.remaining);
                        if(in_out == 'Out'){
                            $('#quantity').removeAttr('disabled');
                            $('#quantity').attr({
                                "max" : data.result.remaining,
                            });
                        }
                    }
                    else{
                        $('#quantity_label').show(200);
                        $('#get_quantity').html(0);
                        if(in_out == 'Out'){
                            $('#quantity').attr('disabled',true);
                        }
                        $('#get_quantity').text(data.quantity);
                    }
                });
            }
            else{
                $('#quantity_label').hide(200);
                if(in_out == 'Out'){
                    $('#quantity').removeAttr('max');
                }
            }
        }

        
    </script>
@endsection
