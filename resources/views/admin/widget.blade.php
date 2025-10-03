<div class="col-md-2">
  <div class="card small-widget"> 
    <div class="card-body danger"> <span class="f-light">Total Purchase</span>
      <div class="d-flex align-items-end gap-1">
        <h4>{{formatIndianNumberWithoutDecimal($total_purchase)}}</h4><span class="font-danger f-12 f-w-500"></span>
      </div>
      <div class="bg-gradient font-danger"> 
        <i class="fa fa-inr f-18"></i>
      </div>
    </div>
  </div>
</div>

  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body danger"> <span class="f-light">Office Expense</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{formatIndianNumberWithoutDecimal($totals['expense'])}}</h4><span class="font-danger f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-danger"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body danger"> <span class="f-light">Vendor Payment</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{formatIndianNumberWithoutDecimal($totals['payment'])}}</h4><span class="font-danger f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-danger"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body danger"> <span class="f-light">Vendor Payment Due / Out</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{formatIndianNumberWithoutDecimal(($totalVendor->total_cr) - ($totalVendor->total_dr))}}</h4><span class="font-danger f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-danger"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2"><!--  --></div>
  <div class="col-md-2"><!--  --></div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body success"> <span class="f-light">Cash In Hand</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{formatIndianNumberWithoutDecimal($totals['income'])}}</h4><span class="font-success f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-success"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body success"> <span class="f-light">Customer Payment</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{formatIndianNumberWithoutDecimal($totals['received'])}}</h4><span class="font-success f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-success"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body success"> <span class="f-light">Balance</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{formatIndianNumberWithoutDecimal(($totals['income'] + $totals['received']) - ($totals['expense'] + $totals['payment']))}}</h4><span class="font-success f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-success"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
 
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body success"> <span class="f-light">Customer Payment Due / In</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{formatIndianNumberWithoutDecimal(($totalCustomer->total_dr) - ($totalCustomer->total_cr))}}</h4><span class="font-success f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-success"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body success"> <span class="f-light">Total Sale</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{formatIndianNumberWithoutDecimal($total_sale)}}</h4><span class="font-success f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-success"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body success"> <span class="f-light">Total Profit</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{formatIndianNumberWithoutDecimal($total_profit)}}</h4><span class="font-success f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-success"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>