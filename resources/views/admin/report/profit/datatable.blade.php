<div class="row widget-grid">
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
            <td>{{$item->calculated_profit ?? ''}}</td>
            <td>
                <a href="{{route('sale.pos',$item->from_id ?? '0')}}" target="_blank" class="btn btn-dark btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-file"></i>
                </a>
            </td>            
          
           
        </tr>
        @endforeach
    </tbody>
   
</table>