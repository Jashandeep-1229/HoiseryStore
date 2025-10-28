@extends('layouts.admin.app')

@section('title', 'Manage User')

@section('css')

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">User</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- All Client Table Start -->
        <div class="row">
            <div class="col-12">
                <div class="card" id="add_brand">
                    <form action="{{route('user.store')}}" method="POST" class="modal-content" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="col-md-3 mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" autofocus placeholder="Name" oninput="this.value = this.value.toUpperCase()" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                                <div class="show-hide toggle-password"><span class="show"></span></div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="role_as">Role As</label>
                                <select name="role_as" id="role_as" class="form-control" required>
                                    <option value="Admin">Admin</option>
                                    <option value="Purchase_Management">Purchase Management</option>
                                    <option value="Order_Management">Order Management</option>
                                    <option value="Stock_Management">Stock Management</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Add +</button>
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
                                        <option value="250" selected>250</option>
                                        <option value="500">500</option>
                                        <option value="1000">1000</option>
                                    </select>
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


    <div class="modal fade" id="edit_modal" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="ajax_html">
            
        </div>
    </div>

@endsection
@section('script')
    <script>
      $(document).ready(function () {
        $(document).on('click', '.show-hide', function () {
            var $wrapper = $(this).closest('.form-group, .password-wrapper');
            var $input = $wrapper.find('input');
            var $toggle = $(this).find('.toggle-password');

            if ($input.attr('type') === 'password') {
                $input.attr('type', 'text');
                $toggle.text('Hide');
            } else {
                $input.attr('type', 'password');
                $toggle.text('Show');
            }
        });
    });
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
            var page = page ?? 1;
            $.get('{{ route("user.datatable") }}?page='+page+'&value='+value+'&search='+search+'', { _token: "{{csrf_token() }}"}, function(data){
                $('#get_datatable').html(data);
                  $('#basic-test').DataTable({ dom: 'Brt', "pageLength": -1 , responsive: true, scrollY: "50vh",
                scrollCollapse: true,});
            });
        }

        function edit_modal(id,key_value){
            var url = "{{route('user.edit_modal',":id")}}";
            url = url.replace(':id',id);
            $('#ajax_html').html('<div class="loader-box"><div class="loader-37"></div></div>');
            $.get(url,{key_value:key_value}, function(data){
                $('#ajax_html').html(data);
                $('.js-example-basic-multiple').select2();
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
                        $('#email').val('');
                        $('#password').val('');
                        $('#department_id').val('').trigger('change');
                        $('#category_id').val('').trigger('change');
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
        function delete_user(id){
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var url = "{{route('user.delete',":id")}}";
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
            var url = "{{route('user.change_status',":id")}}";
            url = url.replace(':id',id);
            $.get(url, function(data){
                if(data.result == 1){
                    $.notify({ title:'Status!', message:data.message }, { type:'info', });
                }
            })
        }
    </script>
@endsection
