<div class="dt-ext table-responsive">
    <table class="display table-striped table-hover" id="basic-test">
        <thead>
            <tr>
                <th class="all">#</th>
                <th class="all">Date</th>
                @if($title == 'Vendor')
                <th class="all">Payment Due</th>
                <th class="all">Payment Paid</th>
                @elseif($title == 'Customer')
                <th class="all">Payment Received</th>
                <th class="all">Total Sale</th>
                @endif
                <th class="all">Payment Method</th>
                <th class="all">Balance</th>
                <th class="all">Remarks</th>
                <th class="all">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $balance = 0 @endphp
            @foreach ($ledger as $key => $item)
            <tr>
                <td>{{ $ledger->firstItem() + $key }}</td>
               
                <td>
                   {{date('d M,Y',strtotime($item->date)) ?? ''}}
                </td>
                <td>
                    @if($item->dr_cr == 'Cr')
                    {{formatIndianNumber($item->amount) ?? ''}}
                    @else
                    -
                    @endif
                </td>
                <td>
                    @if($item->dr_cr == 'Dr')
                    {{formatIndianNumber($item->amount) ?? ''}}
                    @else
                    -
                    @endif
                </td>
                <td>
                    {{$item->payment_method->name ?? ''}}
                </td>
                
                <td>
                    @php
                    if($item->account->from == 'Vendor' || $item->account->from == 'Income'){
                        $item->dr_cr == 'Cr' ? $balance += $item->amount : $balance -= $item->amount;
                    }
                    else{
                        $item->dr_cr == 'Dr' ? $balance += $item->amount : $balance -= $item->amount;
                    }
                    @endphp
                    {{formatIndianNumber($balance) ?? 0}}
                </td>
               <td>
                @if($item->remarks)
                    {{$item->remarks}}
                @elseif($item->related_order)
                <a href="{{ route($item->related_order->type . '.edit', $item->related_order->id) }}">
                    #{{ $item->related_order->order_no }}
                </a>
                
                @else
                    -
                @endif
               </td>
                <td>
                   
                   
                   @if($item->from_id == 0 || $item->from == 'Add More Stock')
                   <a onclick="edit_modal({{$item->id}},{{$key+1}})"  class="btn btn-warning btn-sm  pointer p-1 f-14" data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="tooltip" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a onclick="delete_ledger({{$item->id}})" class="btn btn-danger btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Delete">
                        <i class="fa fa-trash-o"></i>
                    </a>
                   @endif
                </td>
            </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{formatIndianNumber($totals->remaining ?? 0)}}</td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
<div class="mt-2">
    {{$ledger->onEachSide(1)->links()}}
</div>