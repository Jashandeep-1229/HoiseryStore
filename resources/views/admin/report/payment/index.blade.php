@extends('layouts.admin.app')

@section('title', 'Payment Transaction Report')

@section('css')
<style>
    .active-widget .small-widget{
    border: 2px solid #00a326;
    box-shadow: 5px 7px 10px rgba(35, 148, 0, 0.3);
}

</style>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Payment Transaction Report</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- All Client Table Start -->
        <div class="row">
            <div class="col-12">
               <input type="hidden" name="payment_method_id" value="1" id="payment_method_id">
                <div class="card">
                    <div class="card-body p-2">
                        <div  id="basic-2_wrapper" class="dataTables_wrapper px-2 row justify-content-center">
                            
                            <div class="col-md-6">
                                <div class=" text-end">
                                    <label>From Date 
                                       <input type="date" name="from_date" value="{{date('Y-m-d')}}" id="from_date" class="form-control form-control-sm">
                                    </label>
                                    
                                </div>
                            </div>
                                
                                <div class="col-md-6">
                                    <div class="">
                                        <label>To Date 
                                           <input type="date" name="to_date" id="to_date" class="form-control form-control-sm">
                                        </label>
                                        
                                    </div>
                                </div>
                          
                            
                            </div>
                        </div>
                       
                       
                    </div>
                    <div class="row widget-grid" id="get_widget">
                        <div class="loader-box"><div class="loader-37"></div></div>
                      </div>
                      <div class="card">
                        <div class="card-body">
                            <div id="basic-2_wrapper" class="dataTables_wrapper px-2 align-items-center row">
                                <div class="col-md-3 dataTables_length">
                                    <label>Show 
                                        <select name="basic-2_value" id="basic-2_value" aria-controls="basic-2" class="form-control form-control-sm">
                                            <option value="50">50</option>
                                            <option value="250" selected>250</option>
                                            <option value="500">500</option>
                                            <option value="1000">1000</option>
                                        </select>
                                    </label>
                                </div>
                            
                                <!-- ✅ Payment name in center -->
                                <div class="col-md-6 text-center">
                                    <h5 id="selected_payment_name" class="text-uppercase f-w-900 text-primary"></h5>
                                </div>
                            
                                <div class="col-md-3 dataTables_filter text-end m-0">
                                    <label>Search:
                                        <input type="search" id="basic-2_search" class="form-control form-control-sm" placeholder="Search">
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
       
        $(document).ready(function() {
            // Load stored ID and name if available
            if (localStorage.getItem("payment_method_id")) {
                $('#payment_method_id').val(localStorage.getItem("payment_method_id"));
            }
            if (localStorage.getItem("payment_method_name")) {
                $('#selected_payment_name').text(localStorage.getItem("payment_method_name"));
            }

            // Load widgets and table
            get_widget();
            get_datatable(1, $('#payment_method_id').val());

            // When clicking a widget (payment card)
            $(document).on('click', '.payment-widget', function() {
                $('.payment-widget').removeClass('active-widget');
                $(this).addClass('active-widget');
                var payment_method_id = $(this).data('id');
                var payment_method_name = $(this).data('name');

                // Save both ID and name in localStorage
                localStorage.setItem("payment_method_id", payment_method_id);
                localStorage.setItem("payment_method_name", payment_method_name);

                // Update hidden input + UI
                $('#payment_method_id').val(payment_method_id);
                $('#selected_payment_name').text(payment_method_name);

                // Reload datatable
                get_datatable(1, payment_method_id);
            });

            // Date change → update both
            $(document).on('change', '#from_date, #to_date', function() {
                get_widget();
                get_datatable(1, $('#payment_method_id').val());
            });

            // Show or search → only update datatable
            $(document).on('change keyup', '#basic-2_value, #basic-2_search', function() {
                get_datatable(1, $('#payment_method_id').val());
            });

            // Pagination click
            $(document).on('click', '.pages a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split("page=")[1];
                get_datatable(page, $('#payment_method_id').val());
            });
        });

        function get_widget(){
            $('#get_widget').html('<div class="loader-box"><div class="loader-37"></div></div>');
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            $.get('{{ route("payment_method.report.widget") }}', { _token: "{{csrf_token() }}",from_date:from_date,to_date:to_date}, function(data){
                $('#get_widget').html(data);
            });
            }

        function get_datatable(page,payment_method_id){
            $('#get_datatable').html('<div class="loader-box"><div class="loader-37"></div></div>');
            var value = $('#basic-2_value').val();
            var search = $('#basic-2_search').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var page = page ?? 1;
            $('#payment_method_id').val(payment_method_id);

            $.get('{{ route("payment_method.report.datatable") }}?page='+page+'&value='+value+'', { _token: "{{csrf_token() }}",from_date:from_date,to_date:to_date,payment_method_id:payment_method_id}, function(data){
                $('#get_datatable').html(data);
                $('#basic-test').DataTable({ dom: 'Brt', "pageLength": -1 , responsive: true, scrollY: "50vh",
                scrollCollapse: true,});
            });
        }
        function edit_modal(id,key_value,title){
            if(title == 'expense'){
                var url = "{{route('expense.edit_modal',":id")}}";
            }
            else if(title == 'income'){
                var url = "{{route('income.edit_modal',":id")}}";
            }
            else{
                var url = "{{route('ledger.edit_modal',":id")}}";
            }
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
                      
                        $('form button[type="submit"]').html('Save');
                        $('form button[type="submit"]').removeClass('disabled');
                        get_datatable(page, $('#payment_method_id').val());
                        get_widget();
                        $('#edit_modal').modal('hide');
                    }else{
                        $.notify({ title:'Error', message:data.message }, { type:'danger', });
                        $('form button[type="submit"]').html('Save');
                        $('form button[type="submit"]').removeClass('disabled');
                    }
                }
            });
        });

      

      
    </script>
@endsection
