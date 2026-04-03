<div class="dt-ext table-responsive">
    <table class="display table-striped table-hover" id="basic-test">
        <thead>
            <tr>
                <th class="all">#</th>
                <th class="all">Date</th>
                <th class="all">Brand</th>
                <th class="all">Article</th>
                <th class="all">Quantity</th>
                <th class="all">From</th>
                <th class="all">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($manage_stock as $key => $item)
            @php
                if($item->in_out == 'Out'){
                    $color = '#ffe5e5';
                }else if($item->in_out == 'In'){
                    $color = '#e5ffe8';
                }else{
                    $color = '';
                }
            @endphp
            <tr style="background-color:{{$color}}">
                <td>{{ $manage_stock->firstItem() + $key }}</td>
                <td>{{ date('d M,Y',strtotime($item->date)) ?? 'N/A' }}</td>
                <td>{{ $item->brand->name ?? 'N/A' }} <small>({{$item->category->name ?? ''}})</small></td>
                <td>{{ $item->item_detail->article_name ?? 'N/A' }} - {{$item->item_detail->size ?? ''}}</td>
                <td>
                    {{ $item->quantity ?? 'N/A' }}
                </td>
                <td>
                    @php
                        $purchaseStockId = null;
                        $purchaseNo = null;

                        if (strpos($item->from, 'Purchase Stock - ') !== false) {
                            preg_match('/Purchase Stock - (\d+)/', $item->from, $matches);
                            $purchaseStockId = $matches[1] ?? null;

                            if ($purchaseStockId) {
                                // Safely get purchase_no
                                $purchase = \App\Models\PurchaseOrder::find($purchaseStockId);
                                $purchaseNo = $purchase->purchase_no ?? null;
                            }
                        }
                    @endphp

                    @if ($item->from == 'Sale')
                        <a href="{{ route('sale.pos', $item->from_id) }}" target="_blank">
                            {{ $item->sale->sale_no ?? '' }}
                        </a>

                    @elseif ($purchaseStockId && $purchaseNo)
                        <a href="{{ route('purchase.edit', $purchaseStockId) }}" target="_blank">
                            {{ $purchaseNo }}
                        </a>

                    @else
                        Manual
                    @endif

                </td>
                <td>
                   @if($item->from_id == 0 && auth()->user()->role_as == 'Admin')
                    <a onclick="edit_modal({{$item->id}},{{$key+1}})"  class="btn btn-warning btn-sm  pointer p-1 f-14" data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="tooltip" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if (auth()->user()->role_as == 'Admin')
                        <a onclick="delete_stock({{$item->id}})" class="btn btn-danger btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    @endif
                    @endif
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
<div class="mt-2">
    {{$manage_stock->onEachSide(1)->links()}}
</div>