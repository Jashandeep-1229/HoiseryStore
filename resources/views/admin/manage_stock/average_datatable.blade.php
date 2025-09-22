<table class="display" id="basic-test">
    <thead>
        <tr>
            <th class="all">#</th>
            <th>Brand</th>
            <th>Article Details</th>
            <th>Size</th>
            <th>Purchase Price</th>
            <th>Sale Price</th>
            <th class="all">Quantity</th>
            <th class="all">Bundles</th>
            <th class="all">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total_pcs = 0;
            $total_purchase = 0;
            $total_selling = 0;
        @endphp
        @foreach ($remainingStock as $key => $item)
        @php
        if($item->remaining <= 0){
            $color_value = '#ffbfbf';
        }
       
        else{
            $color_value = '';
        }
        @endphp
        <tr style="background-color:{{$color_value}}">
            <td>{{++$key}}</td>
            <td>{{$item->brand->name ?? ''}}<small> ({{$item->category->name ?? ''}}) </small></td>
            <td class="text-primary">{{$item->item_detail->article_name ?? ''}} <small>({{$item->item_detail->quantity}})</small></td>
            <td style="text-transform: uppercase">{{$item->item_detail->size ?? ''}}</td>
            <td style="text-transform: uppercase">{{formatIndianNumber($item->item_detail->purchase_price * $item->remaining)}}</td>
            <td style="text-transform: uppercase">{{formatIndianNumber($item->item_detail->selling_price * $item->remaining)}}</td>
            @php
                $total_pcs += $item->remaining;
                $total_purchase += $item->item_detail->purchase_price * $item->remaining;
                $total_selling += $item->item_detail->selling_price * $item->remaining;
            @endphp
            <td>{{formatIndianNumber($item->remaining)}} Pcs</td>
            <td>{{formatIndianNumber($item->remaining/$item->item_detail->quantity)}} B</td>
            <td>
                <a  href="{{route('view_statement',$item->item_detail_id)}}" class="btn btn-sm btn-info p-1"><i class="fa fa-eye"></i></a>
            </td>
            
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <th>Total</th>
            <th>{{formatIndianNumber($total_purchase)}}</th>
            <th>{{formatIndianNumber($total_selling)}}</th>
            <th>
               
                {{formatIndianNumber($total_pcs)}} Pcs
                
            </th>
            <td></td>
        </tr>
    </tfoot>
</table>
<div class="mb-3">
    {{$remainingStock->onEachSide(1)->Links()}}
</div>