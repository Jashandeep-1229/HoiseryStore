@extends('layouts.admin.app')

@section('title', 'Add Sale Order')

@section('css')

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Add Sale Order</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('sale.store')}}" class="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$sale->id ?? 0}}">
                    <div class="card-body row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <h6>Sale Date<span>*</span></h6>
                                <input type="date" name="sale_date" id="sale_date" value="{{ $sale->sale_date ?? old('sale_date') ?? date('Y-m-d')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 form-group mb-3">
                            <h6>Select Customer <span class="badge badge-success text-white p-1" onclick="add_customer()"><i class="fa fa-plus"></i></span> </h6>
                            
                            <select class="js-example-basic-single" name="account_id" id="account_id" required>
                                <option value="" selected disabled>Select Customer...</option>
                                @foreach($account_master as $item)
                                <option value="{{ $item->id }}" {{ ($sale->account_id ?? '') == $item->id ? 'selected':'' }}>{{ $item->name }} <small> ({{$item->phone_no ?? ''}} - {{$item->business_name ?? ''}})</small></option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                      
                        
                      
                        <div class="col-md-12 mt-2">
                            <fieldset class="border px-md-3 p-2">
                                <legend class="float-none w-auto">Item List</legend>
                                <div class="row" style="position: sticky;top:12%; z-index:999; background: #fff;">
                                    <div class="col-md-6">
                                        <h6>Article (Barcode/Manually)</h6>
                                        <input type="text" name="selected_article" style="position: sticky; top: 12%; z-index: 999; background: #fff;" placeholder="Scan\Enter" id="selected_article" class="form-control  mb-3">
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Enter Article</h6>
                                        <input type="text" name="article_name" style="position: sticky; top: 12%; z-index: 999; background: #fff;"  id="article_name" class="form-control typeahead2"  onkeydown="return (event.keyCode!=13);" placeholder="Please Enter Article Name">
                                    </div>
                                </div>
                                <div class="dt-ext table-responsive">
                                    <table class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td width="40%">Article Details</td>
                                                <td>Amount</td>
                                                <td>Discount</td>
                                                <td>Quantity</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody id="get_data_list">
                                            @foreach($sale->details ?? [] as $key => $detail)
                                            <tr class="item_article_row" id="article_id-{{$detail->id}}" data-article="{{$detail->id}}">
                                                <td class="sr" rowspan="1">{{ $key+1 }}</td>
                                                <td rowspan="1">
                                                    <input type="hidden" name="add[{{$key}}][id]" value="{{$detail->id}}">
                                                    <input type="hidden" name="add[{{$key}}][item_id]" value="{{$detail->item_id}}">
                                                    <input type="hidden" name="add[{{$key}}][item_detail_id]" value="{{$detail->item_detail->id}}">
                                                    <input type="hidden" name="add[{{$key}}][article_name]" value="{{$detail->item_detail->article_name ?? ''}}">
                                                    <small>{{$detail->item_detail->article_name ?? ''}}</small>  <small>{{$detail->item_detail->size ?? ''}}</small> 
                                                   
                                                </td>
                                                <td> <input type="number" step="any" name="add[{{$key}}][selling_price]"  value="{{$detail->selling_price ?? $detail->item_detail->selling_price}}"  oninput="recalculate_totals({{ $detail->id }})" class="form-control form-control-sm"> </td>
                                                <td> <input type="number" step="any" name="add[{{$key}}][discount]" value="{{$detail->discount}}" oninput="recalculate_totals({{ $detail->id }})" class="form-control form-control-sm"> </td>
                                                <td> <input type="number" step="any" name="add[{{$key}}][quantity]" max="{{($detail->item_detail->remaining_stock  ?? 0) + $detail->quantity}}" value="{{$detail->quantity}}" oninput="recalculate_totals({{ $detail->id }})" class="form-control form-control-sm"> </td>
                                                
                                            
                                                <td rowspan="1">
                                                    <a class="btn btn-danger btn-xs" onclick="remove_article($(this),{{$detail->item_detail->id}})" href="javascript:void(0)">-</a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <textarea class="form-control mb-2" name="remarks" id="remarks"  rows="4" placeholder="Remarks Here">{{$sale->remarks ?? ''}}</textarea>
                                                    <div class="input-group input-group-sm mb-2">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Tax/Transport/Packing</span>
                                                        <input type="number" step="any" name="total_tax" id="total_tax" class="form-control" oninput="recalculate_totals(0)" value="{{$sale->total_tax ?? 0}}" placeholder="Total Tax">
                                                    </div>
                                                    {{-- <div class="input-group input-group-sm mb-2">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Courier</span>
                                                        <input type="number" step="any" name="total_courier" id="total_courier" class="form-control" oninput="recalculate_totals(0)" value="{{$sale->total_courier ?? 0}}"  placeholder="Total Courier">
                                                    </div> --}}
                                                </td>
                                                <td colspan="3">
                                                    <div class="input-group input-group-sm mb-2">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Total Items</span>
                                                        <input type="text" name="total_items" id="total_items" class="form-control" value="{{$sale->total_items ?? 0}}" readonly placeholder="Total Items">
                                                    </div>
                                                    <div class="input-group input-group-sm mb-2">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Total Quantity</span>
                                                        <input type="text" name="total_quantity" id="total_quantity" class="form-control" value="{{$sale->total_quantity ?? 0}}" readonly placeholder="Total Quantity In Pcs">
                                                    </div>
                                                    <div class="input-group input-group-sm mb-2">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Total Amount</span>
                                                        <input type="text" name="total_sale_amount" id="total_sale_amount" class="form-control" value="{{$sale->total_sale_amount ?? 0}}" readonly placeholder="Total Amount">
                                                    </div>
                                                    <div class="input-group input-group-sm mb-2">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Adjusted</span>
                                                        <input type="number" step="any" name="adjusted_amount" id="adjusted_amount" oninput="recalculate_totals(0)" class="form-control" value="{{$sale->adjusted_amount ?? 0}}" placeholder="Adjusted Amt">
                                                    </div>
                                                    <div class="input-group input-group-sm mb-2">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Discount</span>
                                                        <input type="text" name="total_discount" id="total_discount" class="form-control" value="{{$sale->total_discount ?? 0}}" readonly placeholder="Total Amount">
                                                    </div>
                                                    <div class="input-group input-group-sm mb-2">
                                                        <span class="input-group-text" id="inputGroup-sizing-default">Net Amount</span>
                                                        <input type="text" name="total_net_amount" id="total_net_amount" class="form-control" value="{{$sale->total_net_amount ?? 0}}" readonly placeholder="Total Net Amount">
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-end">Payment Method</td>
                                                <td colspan="3">
                                                    @php
                                                    // Decode the JSON string into an array (ensure it's an array even if null)
                                                    $paymentMethods = json_decode(($sale->payment_method ?? ''), true) ?? [];
                                                @endphp
                                                <select class="from-control js-example-basic-single" name="payment_method[]" id="payment_method" onchange="get_payment()" multiple>
                                                    @foreach($payment_method as $method)
                                                    <option value="{{ $method->name }}" {{ in_array($method->name, $paymentMethods) ? 'selected' : '' }}>{{ $method->name }}</option>
                                                    @endforeach
                                                </select>
                                                
                                                <div id="payment_value">
                                                    @if(isset($sale))
                                                    @foreach ($sale->getPaymentHistoryAttribute()  ?? '[]' as $key => $value)
                                                        
                                                        <div class="input-group mt-2 input-group-sm">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm">{{ $value->payment_method->name ?? '' }}</span>
                                                            <input type="number" step="any" name="payment_details[{{ $value->payment_method->name ?? '' }}]" placeholder="Enter {{ $value->payment_method->name ?? '' }} Details" class="form-control paid_amount" value="{{ $value->amount ?? 0 }}" required oninput="get_pending_amount()">
                                                        </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <tr>
                                                    <td colspan="2" class="text-end">Pending Amt</td>
                                                
                                                    <td colspan="3">
                                                        <input type="text" readonly class="form-control" id="total_pending_amount" name="total_pending_amount" value="{{$sale->total_pending_amount ?? 0}}">
                                                        <input type="hidden" class="form-control" id="total_paid_amount" name="total_paid_amount" value="{{$sale->total_paid_amount ?? 0}}">
                                                        
                                                    </td>
                                                </tr>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mb-2">
                        <button type="submit" id="save_btn" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="ajax_html">
        
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>

<script>
    (function($) {
        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
            var matches, substringRegex;
            matches = [];
            substrRegex = new RegExp(q, 'i');
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                matches.push(str);
                }
            });
            cb(matches);
            };
        };
        var states = @json($article_name);
        $('.typeahead2').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            },
            {
                name: 'states',
                source: substringMatcher(states)
            }).on('typeahead:select', function(event, suggestion) {
                $('#selected_article').val(suggestion);
                add_article();
            });
           
            var states = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: states
            });
        })(jQuery);
    function add_customer(){
        $('#edit_modal').modal('show');
        var url = "{{route('account_master.edit_modal',":id")}}";
        url = url.replace(':id',0);
        $('#ajax_html').html('<div class="loader-box"><div class="loader-37"></div></div>');
        $.get(url, {modal_from:'Customer'},function(data){
            $('#ajax_html').html(data);
        });
    }
    $('#edit_modal').on('submit','form', function (event) {
        event.preventDefault();
            var url = $(this).attr('action');
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function (response) {
                   if(response.result == 1){
                       $('#edit_modal').modal('hide');
                       $('form button[type="submit"]').html('Add ');
                       $('form button[type="submit"]').removeClass('disabled');
                       $.notify({ title:'Success', message:'Vendor Added Successfully' }, { type:'success', });
                       get_vendor_list();
                   }
                   else{
                    $.notify({ title:'Error', message:response.message }, { type:'danger', });
                    $('form button[type="submit"]').html('Add ');
                    $('form button[type="submit"]').removeClass('disabled');
                   }
                },
            });
    })
    function get_customer_list(){
        $.get('{{ route("customer.list") }}', function(data) {
            $('#account_id').html(data);
            $('#account_id').select2({
                disabled: false
            });
        });
    }
    function add_article(){
        var barcode_value = $('#selected_article').val() || 0;
        // var color = $('#selected_color').val();
      
        var key = $('.sr').length ?? 0;
        if(barcode_value == 0){
            $.notify({ title:'Error', message:'Please Enter Barcode First' }, { type:'danger', });
            return false;
        }
        else{
            
            $.get("{{route('sale.add_item')}}", {barcode_value: barcode_value,key:key}, function(data){
                if(data.result == 1){
                    var existingInput = $('input[data-source="' + barcode_value + '"]');
                    if (existingInput.length > 0) {
                        var quantityInput = existingInput.closest('tr').find('input[name*="[quantity]"]');
                        var currentQuantity = parseFloat(quantityInput.val()) || 0;
                        var newQuantity = currentQuantity + parseFloat(data.item_detail.quantity);
                        var maxQuantity = parseFloat(quantityInput.attr('max')) || 0;
                        if (newQuantity > maxQuantity) {
                            quantityInput.val(maxQuantity);
                            $.notify({ title: 'Warning', message: 'Maximum stock limit reached' }, { type: 'warning' });
                        } else {
                            quantityInput.val(newQuantity);
                            $.notify({ title: 'Info', message: 'Quantity Updated' }, { type: 'info' });
                        }
                        recalculate_totals(data.item_detail.id);
                    }
                    else{
                        $('#get_data_list').append(data.view);
                        recalculate_totals(data.item_detail.id);
                        reindex_articles();
                        $('html, body').animate({
                            scrollTop: $(document).height()
                        }, 250);
                    }
                   
                    $('#selected_article').focus();
                    $('#selected_article').val('');
                    $('#article_name').val('');
                   
                }
                else{
                    $.notify({ title:'Error', message:data.message }, { type:'danger', });
                }
            });
        }
    }
    function recalculate_totals(id){
        let totalItems = 0;
        let totalQuantity = 0;
        let totalSaleAmount = 0;
        let totalDiscount = 0;
        let adjustedAmount = parseFloat($('#adjusted_amount').val() || 0);
        let totalTax = parseFloat($('#total_tax').val() || 0);
        let totalCourier = parseFloat($('#total_courier').val() || 0);

        $('.item_article_row').each(function() {
            let quantity = parseFloat($(this).find('input[name*="[quantity]"]').val()) || 0;
            let sellingPrice = parseFloat($(this).find('input[name*="[selling_price]"]').val()) || 0;
            let discount = parseFloat($(this).find('input[name*="[discount]"]').val()) || 0;
            let mutha = 0;

           

            // Set mutha value in hidden input and display

            totalItems += 1;
            totalQuantity += quantity;
            totalSaleAmount += (quantity * sellingPrice);
            totalDiscount += (quantity * discount);
        });
        totalDiscount += adjustedAmount;
        totalSaleAmount = totalSaleAmount.toFixed(2);

        $('#total_items').val(totalItems);
        $('#total_quantity').val(totalQuantity);
        $('#total_sale_amount').val(totalSaleAmount);
        $('#total_discount').val(totalDiscount);
        $('#total_net_amount').val(totalSaleAmount - totalDiscount + totalTax + totalCourier);
        get_pending_amount();
    }

    function remove_article(e,item_detail_id){
        e.parent().parent().remove();
        recalculate_totals(item_detail_id);
        reindex_articles();
    }
    function reindex_articles(){
        $('tr.item_article_row').each(function(articleIndex){
            const $articleRow = $(this);
            const articleRowId = $articleRow.attr('id') || '';
            const articleId = articleRowId.replace('article_id-','');

            // 1) update visible serial number
            $articleRow.find('td.sr').first().text(articleIndex + 1);

            // 2) update all article-level input/select/textarea names that start with add[OLD]
            $articleRow.find('input[name], select[name], textarea[name]').each(function(){
            let name = $(this).attr('name');
            if(!name) return;
            // replace only the leading add[<num>] part
            name = name.replace(/^add\[\d+\]/, 'add[' + articleIndex + ']');
            $(this).attr('name', name);
            });

        });
    }
    $(document).ready(function () {
    // Only listen for Enter on the article_no input
        $('#selected_article').on('keydown', function (e) {
            if (e.key === "Enter") {
                e.preventDefault(); // Stop form submission
                const value = $(this).val(); // Get input value
                if (value) {
                    add_article(); // Call your function
                } else {
                    $.notify({ title:'Error', message:'Please enter a value before adding.' }, { type:'danger', });
                }
            }
        });
    });
    function get_payment(value){
       
       var selectedValues = $('#payment_method').val();
           var paymentDiv = $("#payment_value");
           var existingValues = {};
           $(".paid_amount").each(function() {
               var key = $(this).attr("name").match(/\[([^\]]+)\]/)[1]; // Extract payment method name
               existingValues[key] = $(this).val(); // Store entered value
           });
           paymentDiv.html(""); // Clear previous input fields

           if (selectedValues) {
           $.each(selectedValues, function(index, value) {
               var inputValue = existingValues[value] || ""; // Restore previous value if exists

               paymentDiv.append(
                   ` <div class="input-group mt-2 input-group-sm"> <span class="input-group-text" id="inputGroup-sizing-sm">${value}</span><input type="number" step="any" name="payment_details[${value}]" 
                       placeholder="Enter ${value} Details" 
                       class="form-control paid_amount" 
                       value="${inputValue}" required oninput="get_pending_amount()"></div>`
               );
           });
           get_pending_amount();
       }
   }
   function get_pending_amount(){
        var grand_total = $('#total_net_amount').val();
        var total_paid = 0;
        $(".paid_amount").each(function() {
            var paid_amount = $(this).val() || 0;
            if (!isNaN(paid_amount)) {
                total_paid += parseFloat(paid_amount);
            }
        });
        var pending_amount = grand_total - total_paid;
        $('#total_pending_amount').val(pending_amount);
        $('#total_paid_amount').val(total_paid);
        if(pending_amount >= 0){
               $('#save_btn').removeClass('disabled');
               $('#updateForm').attr('disabled', false);
           }else{
               $('#save_btn').addClass('disabled');
               $('#updateForm').attr('disabled', true);
           }
    }

</script>
@endsection