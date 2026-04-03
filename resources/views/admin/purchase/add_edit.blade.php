@extends('layouts.admin.app')

@section('title', 'Add Purchase Order')

@section('css')

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Add Purchase Order</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('purchase.store')}}" class="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$purchase->id ?? 0}}">
                    <div class="card-body row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <h6>Purchase Date<span>*</span></h6>
                                <input type="date" name="purchase_date" id="purchase_date" value="{{ $purchase->date ?? old('purchase_date') ?? date('Y-m-d')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 form-group mb-3">
                            <h6>Select Vendor <span class="badge badge-success text-white p-1" onclick="add_vendor()"><i class="fa fa-plus"></i></span> </h6>
                            
                            <select class="js-example-basic-single" name="vendor_id" id="vendor_id" required>
                                <option value="0" selected disabled>Select Vendor...</option>
                                @foreach($vendors as $item)
                                <option value="{{ $item->id }}" {{ ($purchase->vendor_id ?? '') == $item->id ? 'selected':'' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <h6>Select Brand <span class="badge badge-success text-white p-1" onclick="add_brand()"><i class="fa fa-plus"></i></span></h6>
                                <select class="js-example-basic-single" name="selected_brand_id" id="selected_brand_id">
                                    <option value="0" selected disabled>Select Brand...</option>
                                    @foreach($brands as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <h6>Select Category <span class="badge badge-success text-white p-1" onclick="add_category()"><i class="fa fa-plus"></i></span></h6>
                                <select class="js-example-basic-single" name="selected_category_id" id="selected_category_id">
                                    <option value="0" selected disabled>Select Category...</option>
                                    @foreach($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <h6>Select Season </h6>
                                <select class="js-example-basic-single" name="selected_season_id" id="selected_season_id" >
                                    <option value="" selected disabled>Select Season...</option>
                                    @foreach($seasons as $seas)
                                    <option value="{{ $seas->id }}" >{{ $seas->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <h6>Article No *</h6>
                                <input type="text" name="selected_article_no" oninput="this.value = this.value.toUpperCase()" id="selected_article_no" class="form-control">
                            </div>
                        </div>
                        {{-- <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <h6>Color *</h6>
                                <input type="text" name="selected_color" oninput="this.value = this.value.toUpperCase()" id="selected_color" class="form-control">
                            </div>
                        </div> --}}
                        <div class="col-md-2 mt-2">
                            <div class="form-group">
                                <h6>Size *</h6>
                                <input type="text" name="selected_size" oninput="this.value = this.value.toUpperCase()" id="selected_size" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="form-group">
                                <h6>Purchase Price *</h6>
                                <input type="number" step="any" name="selected_purchase_price" id="selected_purchase_price" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="form-group">
                                <h6>Sale Price *</h6>
                                <input type="number" step="any" name="selected_selling_price" id="selected_selling_price" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="form-group">
                                <h6>Bundles</h6>
                                <input type="number" step="any" name="selected_quantity" id="selected_quantity" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="form-group">
                                <h6>Total Quantity <small>(in Pcs)</small></h6>
                                <input type="number" step="any" name="selected_opening_stock" id="selected_opening_stock" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <div class="form-group">
                                <h6>&nbsp;</h6>
                                <a class="btn btn-primary" onclick="add_article()" href="javascript:void(0)">Add +</a>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <fieldset class="border px-md-3 p-2">
                                <legend class="float-none w-auto">Item List</legend>
                                <div class="dt-ext table-responsive">
                                    <table class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Article Details</td>
                                              
                                                <td>Purchase Price</td>
                                                <td>Sale Price</td>
                                                <td>Bundles</td>
                                                <td>Total Qty.</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody id="get_data_list">
                                            @foreach($purchase->details ?? [] as $key => $detail)
                                            <tr class="item_article_row" id="article_id-{{$detail->id}}" data-article="{{$detail->id}}">
                                                <td class="sr" rowspan="1">{{ $key+1 }}</td>
                                                <td rowspan="1">
                                                    <input type="hidden" name="add[{{$key}}][item_id]" value="{{$detail->item_id}}">
                                                    <input type="hidden" name="add[{{$key}}][item_detail_id]" value="{{$detail->id}}">
                                                    <input type="hidden" name="add[{{$key}}][article_name]" value="{{$detail->article_name}}">
                                                    <small>{{$detail->article_name ?? ''}}</small><br>
                                                    <small>{{$detail->size ?? ''}}</small>
                                                </td>
                                                <td> <input type="number" step="any" name="add[{{$key}}][purchase_price]" value="{{$detail->purchase_price}}"  oninput="recalculate_totals({{ $detail->id }})" class="form-control form-control-sm"> </td>
                                                <td> <input type="number" step="any" name="add[{{$key}}][selling_price]" value="{{$detail->selling_price}}"  oninput="recalculate_totals({{ $detail->id }})" class="form-control form-control-sm"> </td>
                                                <td> <input type="number" step="any" name="add[{{$key}}][quantity]" value="{{$detail->quantity}}" oninput="recalculate_totals({{ $detail->id }})" class="form-control form-control-sm"> </td>
                                                <td> 
                                                    <input type="number" step="any" name="add[{{$key}}][opening_stock]" value="{{$detail->opening_stock}}"  oninput="recalculate_totals({{ $detail->id }})" class="form-control form-control-sm"> 
                                                    <span class="f-12"> Bundle: <span class="mutha_text">@if($detail->quantity > 0){{ round($detail->opening_stock / $detail->quantity, 2)}}@else{{0}}@endif</span></span>
                                                    <input type="hidden" name="add[{{$key}}][mutha]"  value="@if($detail->quantity > 0){{ round($detail->opening_stock / $detail->quantity, 2)}}@else{{0}}@endif" class="mutha_input">
                                                </td>
                                            
                                                <td rowspan="1">
                                                    <a class="btn btn-danger btn-xs" onclick="remove_article({{$key}},{{$detail->id}},{{$detail->item_id}})" href="javascript:void(0)">-</a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4">
                                                    <textarea class="form-control" name="remarks" id="remarks"  rows="4" placeholder="Remarks Here"></textarea>
                                                </td>
                                                <td colspan="3">
                                                    <input type="text" name="total_items" id="total_items" class="form-control mb-2" value="{{$purchase->total_items ?? 0}}" readonly placeholder="Total Items">
                                                    <input type="text" name="total_quantity" id="total_quantity" class="form-control mb-2" value="{{$purchase->total_quantity ?? 0}}" readonly placeholder="Total Quantity In Pcs">
                                                    <input type="text" name="total_mutha" id="total_mutha" class="form-control mb-2" value="{{$purchase->total_mutha ?? 0}}" readonly placeholder="Total Mutha">
                                                    <input type="text" name="total_purchase_amount" id="total_purchase_amount" class="form-control" value="{{$purchase->total_purchase_amount ?? 0}}" readonly placeholder="Total Amount">
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end">Payment Method</td>
                                                <td colspan="3">
                                                    @php
                                                    // Decode the JSON string into an array (ensure it's an array even if null)
                                                    $paymentMethods = json_decode(($purchase->payment_method ?? ''), true) ?? [];
                                                @endphp
                                                <select class="from-control js-example-basic-single" name="payment_method[]" id="payment_method" onchange="get_payment()" multiple>
                                                    @foreach($payment_method as $method)
                                                    <option value="{{ $method->name }}" {{ in_array($method->name, $paymentMethods) ? 'selected' : '' }}>{{ $method->name }}</option>
                                                    @endforeach
                                                </select>
                                                
                                                <div id="payment_value">
                                                    @if(isset($purchase))
                                                    @foreach ($purchase->getPaymentHistoryAttribute()  ?? '[]' as $key => $value)
                                                        
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
                                                    <td colspan="4" class="text-end">Pending Amt</td>
                                                
                                                    <td colspan="3">
                                                        <input type="text" readonly class="form-control" id="total_pending_amount" name="total_pending_amount" value="{{$purchase->total_pending_amount ?? 0}}">
                                                        
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
<script>
    function add_vendor(){
        $('#edit_modal').modal('show');
        var url = "{{route('account_master.edit_modal',":id")}}";
        url = url.replace(':id',0);
        $('#ajax_html').html('<div class="loader-box"><div class="loader-37"></div></div>');
        $.get(url, {modal_from:'Vendor'},function(data){
            $('#ajax_html').html(data);
        });
    }
    function add_brand(){
        $('#edit_modal').modal('show');
        var url = "{{route('brand.edit_modal',":id")}}";
        url = url.replace(':id',0);
        $('#ajax_html').html('<div class="loader-box"><div class="loader-37"></div></div>');
        $.get(url, {},function(data){
            $('#ajax_html').html(data);
        });
    }
    function add_category(){
        $('#edit_modal').modal('show');
        var url = "{{route('category.edit_modal',":id")}}";
        url = url.replace(':id',0);
        $('#ajax_html').html('<div class="loader-box"><div class="loader-37"></div></div>');
        $.get(url, {},function(data){
            $('#ajax_html').html(data);
        });
    }
    function brand_list(){
        $.get('{{ route("brand.list") }}', function(data) {
            $('#selected_brand_id').html(data);
            $('#selected_brand_id').select2({
                disabled: false
            });
        });
    }
    function category_list(){
        $.get('{{ route("category.list") }}', function(data) {
            $('#selected_category_id').html(data);
            $('#selected_category_id').select2({
                disabled: false
            });
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
                        if(response.from == 'Brand'){
                            brand_list();
                        }
                        else if(response.from == 'Category'){
                            category_list();
                        }
                        else{
                            get_vendor_list();
                        }
                       $('#edit_modal').modal('hide');
                       $('form button[type="submit"]').html('Add ');
                       $('form button[type="submit"]').removeClass('disabled');
                       $.notify({ title:'Success', message:'Vendor Added Successfully' }, { type:'success', });
                      
                   }
                   else{
                    $.notify({ title:'Error', message:response.message }, { type:'danger', });
                    $('form button[type="submit"]').html('Add ');
                    $('form button[type="submit"]').removeClass('disabled');
                   }
                },
            });
    })
    function get_vendor_list(){
        $.get('{{ route("vendor.list") }}', function(data) {
            $('#vendor_id').html(data);
            $('#vendor_id').select2({
                disabled: false
            });
        });
    }
    function add_article(){
        var brand_id = $('#selected_brand_id').val() || 0;
        var category_id = $('#selected_category_id').val() || 0;
        var season_id = $('#selected_season_id').val() || 0;
        var article_no = $('#selected_article_no').val();
        // var color = $('#selected_color').val();
        var size = $('#selected_size').val();
        var purchase_price = $('#selected_purchase_price').val();
        var selling_price = $('#selected_selling_price').val();
        var quantity = $('#selected_quantity').val();
        var opening_stock = $('#selected_opening_stock').val();
        var key = $('.sr').length ?? 0;
        if(brand_id == 0 || category_id == 0 || season_id == 0 || article_no == 0 || size == 0){
            $.notify({ title:'Error', message:'Please select all fields' }, { type:'danger', });
            return false;
        }
        else{
            $.get("{{route('purchase.add_article_list')}}", {brand_id: brand_id, category_id: category_id, season_id: season_id, article_no: article_no, size: size, purchase_price: purchase_price, selling_price: selling_price, quantity: quantity, opening_stock: opening_stock,key:key}, function(data){
                if(data.result == 1){
                    $('#get_data_list').append(data);
                    $('#selected_article_no').focus();
                    $('#selected_article_no').val('');
                    // $('#selected_color').val('');
                    $('#selected_size').val('');
                    $('#selected_purchase_price').val('');
                    $('#selected_selling_price').val('');
                    $('#selected_quantity').val('');
                    $('#selected_opening_stock').val('');
                    $('#get_data_list').append(data.view);
                    recalculate_totals(data.item_detail.id);
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
        let totalMutha = 0;
        let totalPurchaseAmount = 0;

        $('.item_article_row').each(function() {
            let quantity = parseFloat($(this).find('input[name*="[quantity]"]').val()) || 0;
            let openingStock = parseFloat($(this).find('input[name*="[opening_stock]"]').val()) || 0;
            let purchasePrice = parseFloat($(this).find('input[name*="[purchase_price]"]').val()) || 0;
            let mutha = 0;

            if(quantity > 0){
                mutha = (openingStock / quantity).toFixed(2);
            }

            // Set mutha value in hidden input and display
            $(this).find('input.mutha_input').val(mutha);
            $(this).find('.mutha_text').text(mutha);

            totalItems += 1;
            totalQuantity += openingStock;
            totalMutha += parseFloat(mutha);
            totalPurchaseAmount += (openingStock * purchasePrice);
        });

        totalMutha = totalMutha.toFixed(2);
        totalPurchaseAmount = totalPurchaseAmount.toFixed(2);

        $('#total_items').val(totalItems);
        $('#total_quantity').val(totalQuantity);
        $('#total_mutha').val(totalMutha);
        $('#total_purchase_amount').val(totalPurchaseAmount);
        get_pending_amount();
    }

    function remove_article(key,item_detail_id,item_id){
        $.get("{{ route('purchase.remove_article') }}", { item_detail_id: item_detail_id,item_id:item_id }, function(data){
        if(data.result == 1){
            $.notify({ title:'Success', message:data.message }, { type:'success', });
        }
        else{
            $.notify({ title:'Failed', message:data.message }, { type:'danger', });  
        }
        $('#article_id-' + item_detail_id).remove();
        reindex_articles();
        
        recalculate_totals(item_detail_id);
    })
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
        $('#selected_brand_id, #selected_category_id, #selected_season_id, #selected_article_no, #selected_size, #selected_purchase_price, #selected_selling_price, #selected_quantity, #selected_opening_stock').on('keydown', function (e) {
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
        var grand_total = $('#total_purchase_amount').val();
        var total_paid = 0;
        $(".paid_amount").each(function() {
            var paid_amount = $(this).val() || 0;
            if (!isNaN(paid_amount)) {
                total_paid += parseFloat(paid_amount);
            }
        });
        var pending_amount = grand_total - total_paid;
        $('#total_pending_amount').val(pending_amount);
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