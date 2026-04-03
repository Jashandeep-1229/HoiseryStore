<table class="display" id="basic-test">
    <thead>
        <tr>
            <th class="all">#</th>
            <th class="all">Date</th>
            <th class="all">Remarks</th>
            <th class="all">Plus Amt</th>
            <th class="all">Minus Amount</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total_plus = 0;
            $total_minus = 0;
        @endphp
        @foreach ($ledger as $key => $item)

        <tr>

            <td>{{$ledger->firstItem() + $key}}</td>
            <td>{{date('d M,Y',strtotime($item->date)) ?? ''}}</td>
            <td>
                @if(Str::contains($item->from, 'Payment Recd From Customer - '))
                @if($item->related_order)
                    <a href="{{ route('sale.edit', $item->related_order->id) }}" target="_blank">
                        {{ $item->related_order->order_no }}
                    </a>
                
                @else
                    {{ $item->from ?? '' }}
                @endif
            @elseif(Str::contains($item->from, 'Payment To Vendor - '))
            @if($item->related_order)
                    <a href="{{ route('purchase.edit', $item->related_order->id) }}" target="_blank">
                        {{ $item->related_order->order_no }}
                    </a>
                
                @else
                    {{ $item->from ?? '' }}
                @endif
            @elseif(Str::contains($item->from, 'Manually - Customer'))
            {{$item->account->name ?? ''}} <small>({{$item->remarks ?? ''}})</small>
            <a onclick="edit_modal({{$item->id}},{{$key+1}},'customer')"  class="btn btn-warning btn-sm  pointer p-1 f-14" data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="tooltip" title="Edit">
                <i class="fa fa-edit"></i>
            </a>
            @elseif(Str::contains($item->from, 'Manually - Vendor'))
            {{$item->account->name ?? ''}} <small>({{$item->remarks ?? ''}})</small>
            <a onclick="edit_modal({{$item->id}},{{$key+1}},'vendor')"  class="btn btn-warning btn-sm  pointer p-1 f-14" data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="tooltip" title="Edit">
                <i class="fa fa-edit"></i>
            </a>
            @else
                @if($item->remarks ?? 0)
                    {{ $item->remarks ?? '' }} 
                   
                @else
                    {{$item->from ?? ''}}
                @endif
                @if($item->from == 'Expense - Manually')
                <a onclick="edit_modal({{$item->id}},{{$key+1}},'expense')"  class="btn btn-warning btn-sm  pointer p-1 f-14" data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="tooltip" title="Edit">
                    <i class="fa fa-edit"></i>
                </a>
                @elseif($item->from == 'Income - Manually')
                <a onclick="edit_modal({{$item->id}},{{$key+1}},'income')"  class="btn btn-warning btn-sm  pointer p-1 f-14" data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="tooltip" title="Edit">
                    <i class="fa fa-edit"></i>
                </a>
                @elseif($item->from == 'Manually - Vendor')
                <a onclick="edit_modal({{$item->id}},{{$key+1}},'vendor')"  class="btn btn-warning btn-sm  pointer p-1 f-14" data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="tooltip" title="Edit">
                    <i class="fa fa-edit"></i>
                </a>
                @elseif($item->from == 'Manually - Customer')
                <a onclick="edit_modal({{$item->id}},{{$key+1}},'customer')"  class="btn btn-warning btn-sm  pointer p-1 f-14" data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="tooltip" title="Edit">
                    <i class="fa fa-edit"></i>
                </a>
                @endif
            @endif
            

            </td>
            <td class="text-success">
                @if($item->dr_cr == 'Cr')
                @php
                    $total_plus += $item->amount ?? 0;
                @endphp
                {{formatIndianNumber($item->amount)}}
                @endif
            </td>
            <td class="text-danger"> 
                @if($item->dr_cr == 'Dr')
                @php
                    $total_minus += $item->amount ?? 0;
                @endphp
                {{formatIndianNumber($item->amount)}}
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
            <td>{{formatIndianNumber($total_plus)}}</td>
            <td>{{formatIndianNumber($total_minus)}}</td>
        </tr>
    </tfoot>
   
</table>

<div class="mt-2">
    {{$ledger->onEachSide(1)->links()}}
</div>