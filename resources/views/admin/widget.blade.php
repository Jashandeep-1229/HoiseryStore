<div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body primary"> <span class="f-light">Total Sale</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{$total_sale}}</h4><span class="font-primary f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-primary"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body success"> <span class="f-light">Total Purchase</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{$total_purchase}}</h4><span class="font-success f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-success"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body warning"> <span class="f-light">Total Profit</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{$total_profit}}</h4><span class="font-warning f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-warning"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body info"> <span class="f-light">Total Expense</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{$totals['expense'] + $totals['payment']}}</h4><span class="font-info f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-info"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body info"> <span class="f-light">Total Income</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{$totals['income'] + $totals['received']}}</h4><span class="font-info f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-info"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body info"> <span class="f-light">Overall Profit</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{($totals['income'] + $total_profit + $totals['received']) - ($totals['expense'] + $totals['payment'])}}</h4><span class="font-info f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-info"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body info"> <span class="f-light">Vendor Payment Due</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{($totalVendor->total_cr) - ($totalVendor->total_dr)}}</h4><span class="font-info f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-info"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card small-widget"> 
      <div class="card-body info"> <span class="f-light">Customer Payment Due</span>
        <div class="d-flex align-items-end gap-1">
          <h4>{{($totalCustomer->total_dr) - ($totalCustomer->total_cr)}}</h4><span class="font-info f-12 f-w-500"></span>
        </div>
        <div class="bg-gradient font-info"> 
          <i class="fa fa-inr f-18"></i>
        </div>
      </div>
    </div>
  </div>