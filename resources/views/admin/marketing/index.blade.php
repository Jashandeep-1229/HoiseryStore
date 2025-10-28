
@extends('layouts.admin.app')

@section('title', 'Marketing')

@section('css')
   {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-4.5.2.min.css') }}"> --}}
   {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-example.min.css') }}"> --}}
   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-multiselect.css') }}">
   <style>
    span.multiselect-native-select{
  position:relative;
}
span.multiselect-native-select select{
  border: 0 !important;
    clip: rect(0 0 0 0) !important;
    height: 1px !important;
    margin: -1px -1px -1px -3px !important;
    overflow: hidden !important;
    padding: 0 !important;
    position: absolute !important;
    width: 1px !important;
    left: 50%;
    top: 30px;
}
.btn-group, .btn-group-vertical{
  position: relative;
    display: -ms-inline-flexbox;
    display: inline-flex;
    vertical-align: middle;
}
[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled){
  cursor: pointer;
}
.dropdown-menu{
  position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 10rem;
    padding: .5rem 0;
    margin: .125rem 0 0;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .15);
    border-radius: .25rem;
}
.dropdown-menu.show{
  display:block;
}
.dropdown-menu[x-placement^=bottom], .dropdown-menu[x-placement^=left], .dropdown-menu[x-placement^=right], .dropdown-menu[x-placement^=top] {
  right: auto;
  bottom: auto;
}
.custom-select {
    display: inline-block;
    width: 100%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem 1.75rem .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    vertical-align: middle;
    background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right .75rem center/8px 10px;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none
}

.custom-select:focus {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 .2rem rgba(0,123,255,.25)
}

.custom-select:focus::-ms-value {
    color: #495057;
    background-color: #fff
}

.custom-select[multiple],.custom-select[size]:not([size="1"]) {
    height: auto;
    padding-right: .75rem;
    background-image: none
}

.custom-select:disabled {
    color: #6c757d;
    background-color: #e9ecef
}

.custom-select::-ms-expand {
    display: none
}

.custom-select:-moz-focusring {
    color: transparent;
    text-shadow: 0 0 0 #495057
}

.custom-select-sm {
    height: calc(1.5em + .5rem + 2px);
    padding-top: .25rem;
    padding-bottom: .25rem;
    padding-left: .5rem;
    font-size: .875rem
}

.custom-select-lg {
    height: calc(1.5em + 1rem + 2px);
    padding-top: .5rem;
    padding-bottom: .5rem;
    padding-left: 1rem;
    font-size: 1.25rem
}

   </style>
   {{-- <link rel="stylesheet" href="{{ asset('assets/css/prettify.min.css') }}"> --}}
@endsection
@section('breadcrumb-items')
    <li class="breadcrumb-item">Marketing</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- All marketing Table Start -->
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
<!-- marketing Form End-->
                <div class="card" id="add_marketing">
                    <form action="{{route('marketing.store')}}" method="POST" id="" class="modal-content" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            
                            <div class="col-md-4 mt-4">
                                {{-- <input type="text" name="select_type" autofocus id="select_type"  placeholder="marketing From" class="form-control" required> --}}
                                <select class="form-select" name="message_type" id="message_type" required>
                                    <option value=''>-- Select Type --</option>
                                    <option value='Simple Text'>Simple Text</option>
                                    <option value='Image'>Image</option>
                                    <option value='Video'>Video</option>
                                    <option value='PDF'>PDF</option>
                                </select>
                            </div>

                            <div class="col-md-4 mt-4">
                                <input type="file" name="file" id="file" autofocus class="form-control" accept="image/*,video/*,application/pdf">
                            </div>

                            @php
                                $currentDate = date('Y-m-d');
                            @endphp

                            <div class="col-md-4 mt-4">
                                <input type="date" name="message_date" autofocus id="message_date" min="{{ now()->toDateString() }}" placeholder="marketing From" value="{{$currentDate}}" class="form-control" >
                            </div>    

                            <div class="col-md-12 mt-4">
                                <textarea rows="3" name="message" autofocus id="message"  placeholder="Remarks" class="form-control" ></textarea>
                                <small>1) Bold - Use *-*. 2) For Next Line - \n </small>
                            </div>  
                          
                            
                            <div class="col-md-4 mt-4">
                                <select name="selected_customer[]" id="example-getting-started"   multiple>
                                    @foreach ($data as $state_city => $leads)
                                    <optgroup label="{{$state_city}}" class="{{$state_city}}">
                                        @foreach($leads as $data)
                                        <option value="{{$data->id}}">{{$data->name}} - {{$data->phone_no}}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                               
                               
                                </select>
                            </div>
                            <div class="col-md-2 mt-4 d-flex">
                                <label class="switch">
                                    <input type="checkbox" name="is_auto"><span class="switch-state"></span>
                                </label>
                                <label class="col-form-label m-l-10">Automatically</label>
                            </div>                        

                            <div class="col-md-2 mt-4">
                               <button type="submit" id="add_data" class="btn btn-primary w-100" >Add</button>
                            </div>
                        </div>
                    </form>
                </div>

<!-- marketing Form End-->

                <div class="card">
                    <div class="card-body">
                        <div  id="basic-2_wrapper" class="dataTables_wrapper px-2">
                            <div class="dataTables_length">
                                <label>Show 
                                    <select name="basic-2_value"  id="basic-2_value" aria-controls="basic-2" class="form-control form-control-sm">
                                        <option value="50">50</option>
                                        <option value="250" selected>250</option>
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
                        <div class="dt-ext" id="get_marketing_table">
                            <div class="loader-box"><div class="loader-37"></div></div>
                            
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
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
{{-- <script src="{{asset('assets/js/jquery-2.2.4.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/js/require-2.3.5.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/js/prettify.min.js')}}"></script> --}}
<script src="{{asset('assets/js/bootstrap.bundle-4.5.2.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-multiselect.js')}}"></script>
    <script>
        
       
       
        $(document).ready(function(){
            get_datatable();
            $("#name").focus();
            $('#example-getting-started').multiselect({
                enableClickableOptGroups: true,
                enableCollapsibleOptGroups: true,
                enableFiltering: true,
                includeSelectAllOption: true,
                enableCaseInsensitiveFiltering: true,
                collapseOptGroupsByDefault: true,
                maxHeight: 400,
                buttonWidth: '100%'
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
            $.get('{{ route('marketing.datatable')}}?page='+page+'&value='+value+'&search='+search+'', { _token: "{{csrf_token() }}"}, function(data){
                $('#get_marketing_table').html(data);
                  $('#basic-test').DataTable({ dom: 'Brt', "pageLength": -1 , responsive: true, scrollY: "50vh",
                scrollCollapse: true,});
            });
        }

       
      
        
       
        function edit_modal(id,key_value){
            var url = "{{route('marketing.edit_modal',":id")}}";
            url = url.replace(':id',id);
            $('#ajax_html').html('<div class="loader-box"><div class="loader-37"></div></div>');
            $.get(url,{key_value:key_value}, function(data){
                $('#ajax_html').html(data);
                $('#example-getting-started2').multiselect({
                    enableClickableOptGroups: true,
                    enableCollapsibleOptGroups: true,
                    enableFiltering: true,
                    includeSelectAllOption: true,
                    enableCaseInsensitiveFiltering: true,
                    collapseOptGroupsByDefault: true,
                    maxHeight: 400,
                    buttonWidth: '100%'
                });
               
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
                        $('#message_type').val('');
                        $('#message_date').val('');
                        $('#message').val('');
                        $('#file').val('');
                        $('#example-getting-started').multiselect('deselectAll');
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


        function change_status(id){
            var url = "{{route('marketing.change_status',":id")}}";
            url = url.replace(':id',id);
            $.get(url,function(data){
                if(data == 1){
                    var notify = $.notify('<i class="fa fa-bell-o"></i><strong>Message! </strong> Status Updated Successfully', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 1500,
                        showProgressbar: true,
                        timer: 500,
                        animate:{
                            enter:'animated fadeInDown',
                            exit:'animated fadeOutUp'
                        }
                    });
                }
            })
        }
        function send_whatsapp(id){
            $('#send-whatsapp-'+id).addClass('disabled');
            var url = "{{route('marketing.send_whatsapp',":id")}}";
            url = url.replace(':id',id);
            $.get(url,function(data){
                if(data == 1){
                    $('#send-whatsapp-'+id).removeClass('disabled');
                    var event = $.Event("click");
                    var page = Number($(".pages").find('span[aria-current="page"] span').text());
                    get_datatable(event,page);
                    var notify = $.notify('<i class="fa fa-bell-o"></i><strong>Message! </strong> WhatsApp Sent Successfully', {
                        type: 'success',
                        allow_dismiss: true,
                        delay: 1500,
                        showProgressbar: true,
                        timer: 500,
                        animate:{
                            enter:'animated fadeInDown',
                            exit:'animated fadeOutUp'
                        }
                    });
                }
            })
        }
        function delete_marketing(id){
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var url = "{{route('marketing.delete',":id")}}";
                    url = url.replace(':id',id);
                    $.get(url,{}, function(data){
                        if(data.result == 1){
                           
                            var page = Number($(".pages").find('span[aria-current="page"] span').text());
                            get_datatable(page);
                            $.notify({ title:'Deleted', message:data.message}, { type:'danger', });
                        }
                    });
                }
            })
        }
    </script>
@endsection

