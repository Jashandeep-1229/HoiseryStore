@foreach($result as $key => $payment)
<div class="col-md-2 payment-widget" 
     data-id="{{ $payment['payment_method_id'] }}" 
     data-name="{{ $payment['payment_method_name'] }}">
    <div class="card small-widget"> 
      <div class="card-body success"> <span class="f-light">{{$payment['payment_method_name']}}</span>
        <div class="d-flex align-items-end gap-1">
          <h4 class="text-success">{{formatIndianNumberWithoutDecimal($payment['closing_balance'])}}</h4><span class="font-danger f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-sucess"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach