<div class="dt-ext table-responsive">
    <table class="display table-striped table-hover" id="basic-test">
        <thead>
            <tr>
                <th class="all">#</th>
                <th class="all">Date</th>
                <th class="all">Sale No</th>
                <th class="all">Customer</th>
                <th class="all">Article Details</th>
                <th class="all">Amount</th>
                <th class="all">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale as $key => $list)
            <tr>
                <td>{{ $sale->firstItem() + $key }}</td>
               
                <td>
                    {{date('d M,Y',strtotime($list->sale_date)) ?? ''}}
                </td>
                <td>
                    {{$list->sale_no ?? ''}}
                </td>
                <td>
                    {{$list->account->name ?? ''}}
                </td>
                
                <td>
                    @foreach($list->details ?? '[]' as  $xyz => $det)
                    {{$det->item_detail->article_name ?? ''}} <small class="text-primary">({{$det->item_detail->size ?? ''}})</small>
                    
                    @if(!$loop->last)
                    <br>
                    @endif
                    @endforeach
                </td>
                <td>
                    Total - 
                    @if(($list->total_sale_amount ?? 0) > ($list->total_net_amount ?? 0))
                        <s class="text-muted">{{formatIndianNumber($list->total_sale_amount)}}</s>
                    @endif
                    <span class="text-success">{{formatIndianNumber($list->total_net_amount ?? 0)}}</span> <br>
                    @if($list->getProfitAttribute() > 0)
                    Profit - <span class="text-success">{{formatIndianNumber(($list->getProfitAttribute() ?? 0) - ($list->adjusted_amount ?? 0))}} @if($list->total_net_amount > 0)<small>({{formatIndianNumber((($list->getProfitAttribute() ?? 0) - ($list->adjusted_amount ?? 0))/$list->total_net_amount * 100 ) ?? 0}}%)</small>@endif</span> <br>
                    
                    @else
                    Loss - <span class="text-danger">{{formatIndianNumber(($list->getProfitAttribute() ?? 0) - ($list->adjusted_amount ?? 0))}}  @if($list->total_net_amount > 0)<small>({{formatIndianNumber((($list->getProfitAttribute() ?? 0) - ($list->adjusted_amount ?? 0))/$list->total_net_amount * 100 ) ?? 0}}%)</small>@endif</span> <br>
                    @endif
                </td>
                <td>
                   
                    <a href="{{route('sale.pos',$list)}}" target="_blank" class="btn btn-dark btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Edit">
                        <i class="fa fa-file"></i>
                    </a>
                    @if (auth()->user()->role_as == 'Admin')
                    <a href="{{route('sale.edit',$list)}}" class="btn btn-warning btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                        <a onclick="delete_sale({{$list->id}})" class="btn btn-danger btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    @endif
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
<div class="mt-2">
    {{$sale->onEachSide(1)->links()}}
</div>