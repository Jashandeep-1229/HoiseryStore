<div class="dt-ext table-responsive">
    <table class="display table-striped table-hover" id="basic-test">
        <thead>
            <tr>
                <th class="all">#</th>
                <th class="all">Date</th>
                <th class="all">PO No</th>
                <th class="all">Vendor</th>
                <th class="all">Article Details</th>
                <th class="all">Amount</th>
                <th class="all">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase as $key => $list)
            <tr>
                <td>{{ $purchase->firstItem() + $key }}</td>
               
                <td>
                    {{date('d M,Y',strtotime($list->purchase_date)) ?? ''}}
                </td>
                <td>
                    {{$list->purchase_no ?? ''}}
                </td>
                <td>
                    {{$list->vendor->name ?? ''}}
                </td>
                
                <td>
                    @foreach($list->details ?? '[]' as  $xyz => $det)
                    {{$det->article_name}} <small class="text-primary">({{$det->size ?? ''}})</small>
                    
                    @if(!$loop->last)
                    <br>
                    @endif
                    @endforeach
                </td>
                <td>
                    Total - {{formatIndianNumber($list->total_purchase_amount ?? 0)}} <br>
                    
                </td>
                <td>
                   
                   
                    @if (auth()->user()->role_as == 'Admin')
                    <a href="{{route('purchase.edit',$list)}}" class="btn btn-warning btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                        <a onclick="delete_purchase({{$list->id}})" class="btn btn-danger btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Delete">
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
    {{$purchase->onEachSide(1)->links()}}
</div>