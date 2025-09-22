@extends('layouts.admin.app')

@section('title', 'Expense')

@section('css')

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Expense</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- All Client Table Start -->
        <div class="row">
            <div class="col-12">
                <div class="card" id="add_expense">
                    <form action="{{route('expense.store')}}" method="POST" id="" class="modal-content" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value=0>
                        <div class="card-body row">
                            <div class="col-md-2">
                                <input type="date" name="date" id="date" autofocus  class="form-control" value="{{date('Y-m-d')}}" required>
                            </div>
                            <div class="col-md-3">
                                <h6>Select Expense <span class="badge badge-success text-white p-1" onclick="add_expense()"><i class="fa fa-plus"></i></span> </h6>
                                <select class="js-example-basic-single" name="expense_id" id="expense_id" required>
                                    <option value="" selected disabled>Select Expense</option>
                                    @foreach($account_expense as $acc)
                                    <option value="{{$acc->id}}">{{$acc->name ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <h6>Select Payment <span class="badge badge-success text-white p-1" onclick="add_payment()"><i class="fa fa-plus"></i></span> </h6>
                                <select class="js-example-basic-single" name="payment_method_id" id="payment_method_id" required>
                                    <option value="" selected disabled>Select Payment</option>
                                    @foreach($payment_master as $payment)
                                    <option value="{{$payment->id}}">{{$payment->name ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" step="any" placeholder="Enter Amt" name="amount" id="amount" class="form-control">
                            </div>
                           
                            <div class="col-md-6 mt-3">
                                <input type="text" placeholder="Remarks" name="remarks" id="remarks" class="form-control">
                            </div>
                           
                            
                           
                            <div class="col-md-2 mt-3">
                               <button type="submit" id="add_data" class="btn btn-primary w-100" >Add +</button>
                            </div>
                           
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-body">
                        <<div  id="basic-2_wrapper" class="dataTables_wrapper px-2" onchange="get_datatable()">
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
        function add_expense(){
            $('#edit_modal').modal('show');
            var url = "{{route('account_master.edit_modal',":id")}}";
            url = url.replace(':id',0);
            $('#ajax_html').html('<div class="loader-box"><div class="loader-37"></div></div>');
            $.get(url, {modal_from:'Expense'},function(data){
                $('#ajax_html').html(data);
            });
        }

        function add_payment(){
            $('#edit_modal').modal('show');
            var url = "{{route('payment_master.edit_modal',":id")}}";
            url = url.replace(':id',0);
            $('#ajax_html').html('<div class="loader-box"><div class="loader-37"></div></div>');
            $.get(url, {modal_from:'Payment'},function(data){
                $('#ajax_html').html(data);
            });
        }

        $(document).ready(function(){
            get_datatable();
            $("#name").focus();
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
            $.get('{{ route("expense.datatable") }}?page='+page+'&value='+value+'&search='+search+'', { _token: "{{csrf_token() }}",from_date:from_date,to_date:to_date}, function(data){
                $('#get_datatable').html(data);
                $('#basic-test').DataTable({ dom: 'Brt', "pageLength": -1 , responsive: true,});
            });
        }

        function edit_modal(id,key_value){
            var url = "{{route('expense.edit_modal',":id")}}";
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
                        if(form_data.get('account_master_id') == 0){
                            $('#expense_id').append(
                                `<option value="${data.id}">${data.name}</option>`
                            ).trigger('change');
                        }else{
                            var page = Number($(".pages").find('span[aria-current="page"] span').text());
                            $('#expense_id').prop('selectedIndex', 0);
                            $('#payment_method_id').prop('selectedIndex', 0);
                            $('#remarks').val('');
                            $('#amount').val('');
                            $('form button[type="submit"]').html('Save');
                            $('form button[type="submit"]').removeClass('disabled');
                            get_datatable(page);
                     }
                        $('#edit_modal').modal('hide');
                    }else{
                        $.notify({ title:'Error', message:data.message }, { type:'danger', });
                        $('form button[type="submit"]').html('Save');
                        $('form button[type="submit"]').removeClass('disabled');
                    }
                }
            });
        });
        function delete_expense(id){
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var url = "{{route('expense.delete',":id")}}";
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
        
    </script>
@endsection
