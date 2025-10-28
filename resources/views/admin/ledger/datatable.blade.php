<div class="dt-ext table-responsive">
    <table class="display table-striped table-hover" id="basic-test">
        <thead>
            <tr>
                <th class="all">#</th>
                <th class="all">Name</th>
                @if($title == 'Vendor')
                <th class="all">Payment Due</th>
                <th class="all">Payment Paid</th>
                @elseif($title == 'Customer')
                <th class="all">Payment Received</th>
                <th class="all">Total Sale</th>
                @endif
                <th class="all">Pending</th>
                <th class="all">Action</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $total_1 = 0;
                $total_2 = 0;
                $total_3 = 0;
            @endphp
            @foreach ($ledger as $key => $list)
            @php
                $total_1 += $list->total_cr;
                $total_2 += $list->total_dr;
                $total_3 += $list->remaining;
            @endphp
            <tr>
                <td>{{ $ledger->firstItem() + $key }}</td>
               
                <td>
                   {{$list->name ?? ''}}
                </td>
                @if($title == 'Vendor')
                <td class="text-danger">
                    {{formatIndianNumber($list->total_cr) ?? ''}}
                </td>
                <td class="text-success">
                    {{formatIndianNumber($list->total_dr) ?? ''}}
                </td>
                @elseif($title == 'Customer')
                <td class="text-success">
                    {{formatIndianNumber($list->total_cr) ?? ''}}
                </td>
                <td class="text-danger">
                    {{formatIndianNumber($list->total_dr) ?? ''}}
                </td>
                @endif
                
                <td>
                    {{formatIndianNumber($list->remaining) ?? ''}}
                </td>
               
                <td>
                   
                   
                    @if (auth()->user()->role_as == 'Admin')
                    <a href="{{route('ledger.show',$list->id)}}" class="btn btn-info btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Edit">
                        <i class="fa fa-eye"></i>
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th>{{formatIndianNumber($total_1)}}</th>
                <th>{{formatIndianNumber($total_2)}}</th>
                <th>{{formatIndianNumber($total_3)}}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>
<div class="mt-2">
    {{$ledger->onEachSide(1)->links()}}
</div>