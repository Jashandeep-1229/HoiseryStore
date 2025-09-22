@extends('layouts.admin.app')

@section('title', 'Account Master')

@section('css')

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Account Master</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- All Client Table Start -->
        <div class="row">
            <div class="col-12">
                <div class="card" id="add_account_master">
                    <form action="{{route('account_master.store')}}" method="POST" id="" class="modal-content" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="col-md-4">
                                <input type="text" name="name" id="name" autofocus  placeholder="Name" oninput="this.value = this.value.toUpperCase()" class="form-control" required>
                            </div>
                            {{-- <div class="col-md-3">
                                <input type="text" name="phone_no" id="phone_no" autofocus  placeholder="Phone No" class="form-control" required>
                            </div> --}}
                            <div class="col-md-3">
                                <select class="form-control" name="from" id="from" required>
                                    <option value="" selected disabled>Select From</option>
                                    <option value="Vendor">Vendor</option>
                                    <option value="Customer">Customer</option>
                                    <option value="Expense">Expense</option>
                                    <option value="Income">Income</option>
                                </select>
                            </div>
                                <!-- Dynamic Fields Start -->
                                <div class="col-md-3 d-none" id="business_name_div">
                                    <input type="text" name="business_name" id="business_name" placeholder="Business Name" class="form-control">
                                </div>
                                <div class="col-md-2 d-none" id="phone_no_div">
                                    <input type="text" name="phone_no" id="phone_no" placeholder="Phone Number" class="form-control">
                                </div>
                                <!-- Dynamic Fields End -->
                           
                            <div class="col-md-2">
                               <button type="submit" id="add_data" class="btn btn-primary w-100" >Add +</button>
                            </div>
                           
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div  id="basic-2_wrapper" class="dataTables_wrapper px-2" onchange="get_datatable()">
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
                            <div class="dataTables_filter">
                                <label>Search:
                                    <input type="search"  id="basic-2_search" class="form-control form-control-sm" placeholder="Search" aria-controls="basic-2" data-bs-original-title="" title="">
                                </label>
                                
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
        $(document).ready(function(){
            get_datatable();
            $("#name").focus();
            // Show/hide fields based on 'from' selection
            $('#from').on('change', function() {
                var val = $(this).val();
                if(val === 'Vendor' || val === 'Customer') {
                    $('#business_name_div').removeClass('d-none');
                    $('#phone_no_div').removeClass('d-none');
                } else {
                    $('#business_name_div').addClass('d-none');
                    $('#phone_no_div').addClass('d-none');
                }
            });
            // Reset fields on form reset
            $('form').on('reset', function() {
                $('#business_name_div').addClass('d-none');
                $('#phone_no_div').addClass('d-none');
            });
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
            var page = page ?? 1;
            $.get('{{ route("account_master.datatable") }}?page='+page+'&value='+value+'&search='+search+'', { _token: "{{csrf_token() }}"}, function(data){
                $('#get_datatable').html(data);
                $('#basic-test').DataTable({ dom: 'Brt', "pageLength": -1 , responsive: true,});
            });
        }

        function edit_modal(id,key_value){
            var url = "{{route('account_master.edit_modal',":id")}}";
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
                        $('#business_name').val('');
                        $('#phone_no').val('');
                        $('#from').prop('selectedIndex', 0).trigger('change');
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
        function delete_account_master(id){
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var url = "{{route('account_master.delete',":id")}}";
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
        function change_status(id){
            var url = "{{route('account_master.change_status',":id")}}";
            url = url.replace(':id',id);
            $.get(url, function(data){
                if(data.result == 1){
                    $.notify({ title:'Status!', message:data.message}, { type:'info', });
                }
            })
        }
    </script>
@endsection
