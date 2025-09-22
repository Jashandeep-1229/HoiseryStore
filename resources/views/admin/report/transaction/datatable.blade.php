<div class="row widget-grid">
    <div class="col-md-2">
      <div class="card small-widget"> 
        <div class="card-body primary"> <span class="f-light">Total Expense</span>
          <div class="d-flex align-items-end gap-1">
            <h4>{{$totals['expense'] + $totals['payment']}}</h4><span class="font-primary f-12 f-w-500"></span>
          </div>
          <div class="bg-gradient font-primary"> 
            <i class="fa fa-inr f-18"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card small-widget"> 
        <div class="card-body success"> <span class="f-light">Total Income</span>
          <div class="d-flex align-items-end gap-1">
            <h4>{{$totals['income'] + $totals['received']}}</h4><span class="font-success f-12 f-w-500"></span>
          </div>
          <div class="bg-gradient font-success"> 
            <i class="fa fa-inr f-18"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card small-widget"> 
        <div class="card-body warning"> <span class="f-light">Total Purchase</span>
          <div class="d-flex align-items-end gap-1">
            <h4>{{$totals['purchase']}}</h4><span class="font-warning f-12 f-w-500"></span>
          </div>
          <div class="bg-gradient font-warning"> 
            <i class="fa fa-inr f-18"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card small-widget"> 
        <div class="card-body info"> <span class="f-light">Total Sale</span>
          <div class="d-flex align-items-end gap-1">
            <h4>{{$totals['sale']}}</h4><span class="font-info f-12 f-w-500"></span>
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
            <th class="all">From</th>
            <th class="all">Account</th>
            <th class="all">Payment Method</th>
            <th class="all">Dr</th>
            <th class="all">Cr</th>
            <th class="all">View</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ledger as $key => $item)

        <tr>
            <td>{{$ledger->firstItem() + $key}}</td>
            <td>{{date('d M,Y',strtotime($item->date)) ?? ''}}</td>
            <td>
                @if($item->remarks)
                    {{$item->remarks}}
                @elseif($item->related_order)
                <a href="{{ route($item->related_order->type . '.edit', $item->related_order->id) }}">
                   {{$item->related_order->from}} #{{ $item->related_order->order_no }}
                </a>
                
                @else
                    -
                @endif
            </td>
            <td>{{$item->account->name ?? ''}}</td>
            <td>{{$item->payment_method->name ?? ''}}</td>
            <td>{{$item->dr_cr == 'Dr' ? $item->amount : '-'}}</td>
            <td>{{$item->dr_cr == 'Cr' ? $item->amount : '-'}}</td>
          
            <td>
                <a href="{{route('ledger.show',$item->account->id)}}" class="btn btn-info btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-eye"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
   
</table>