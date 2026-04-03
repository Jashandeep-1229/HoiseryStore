<div class="row widget-grid">
    
    <div class="col-md-2">
      <div class="card small-widget"> 
        <div class="card-body danger"> <span class="f-light">Total Purchase</span>
          <div class="d-flex align-items-end gap-1">
            <h4 class="text-danger">{{formatIndianNumberWithoutDecimal($total_purchase)}}</h4><span class="font-danger f-12 f-w-500"></span>
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
              <h4 class="text-danger">{{formatIndianNumberWithoutDecimal($totals['expense'])}}</h4><span class="font-danger f-12 f-w-500"></span>
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
              <h4 class="text-danger">{{formatIndianNumberWithoutDecimal($totals['payment'])}}</h4><span class="font-danger f-12 f-w-500"></span>
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
              <h4 class="text-danger">{{formatIndianNumberWithoutDecimal(($totalVendor->total_cr) - ($totalVendor->total_dr))}}</h4><span class="font-danger f-12 f-w-500"></span>
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
              <h4 class="text-success">{{formatIndianNumberWithoutDecimal($totals['income'])}}</h4><span class="font-success f-12 f-w-500"></span>
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
              <h4 class="text-success">{{formatIndianNumberWithoutDecimal($totals['received'])}}</h4><span class="font-success f-12 f-w-500"></span>
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
              <h4 class="text-success">{{formatIndianNumberWithoutDecimal(($totals['income'] + $totals['received']) - ($totals['expense'] + $totals['payment']))}}</h4><span class="font-success f-12 f-w-500"></span>
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
              <h4 class="text-success">{{formatIndianNumberWithoutDecimal(($totalCustomer->total_dr) - ($totalCustomer->total_cr))}}</h4><span class="font-success f-12 f-w-500"></span>
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
              <h4 class="text-success">{{formatIndianNumberWithoutDecimal($total_sale)}}</h4><span class="font-success f-12 f-w-500"></span>
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
              <h4 class="text-success"> {{formatIndianNumberWithoutDecimal($total_profit)}}</h4><span class="font-success f-12 f-w-500"></span>
            </div>
            <div class="bg-gradient font-success"> 
              <i class="fa fa-inr f-18"></i>
            </div>
          </div>
        </div>
      </div>
      <h6>Payment Report</h6>
      @foreach($paymentData as $name => $amount)
      <div class="col-md-2">
        <div class="card small-widget"> 
          <div class="card-body success"> <span class="f-light">{{$name}}</span>
            <div class="d-flex align-items-end gap-1">
              <h4 class="text-success"> {{formatIndianNumberWithoutDecimal($amount)}}</h4><span class="font-success f-12 f-w-500"></span>
            </div>
            <div class="bg-gradient font-success"> 
              <i class="fa fa-inr f-18"></i>
            </div>
          </div>
        </div>
      </div>
      @endforeach
</div>
<table class="display" id="basic-test">
    <thead>
        <tr>
            <th class="all">#</th>
            <th class="all">Date</th>
            <th class="all">Brand</th>
            <th class="all">Article</th>
            <th class="all">Profit</th>
            <th class="all">View</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($manage_stock as $key => $item)

        <tr>

            <td>{{$manage_stock->firstItem() + $key}}</td>
            <td>{{date('d M,Y',strtotime($item->date)) ?? ''}}</td>
            <td>
              {{$item->brand->name ?? ''}}
            </td>
            <td>
              {{$item->item_detail->article_name ?? ''}}
            </td>
            <td>{{formatIndianNumber($item->calculated_profit ?? '')}}</td>
            <td>
                <a href="{{route('sale.pos',$item->from_id ?? '0')}}" target="_blank" class="btn btn-dark btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-file"></i>
                </a>
            </td>            
          
           
        </tr>
        @endforeach
    </tbody>
   
</table>