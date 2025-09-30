<div class="dt-ext table-responsive">
    <table class="display table-striped table-hover" id="basic-test">
        <thead>
            <tr>
                <th class="all">#</th>
                <th class="all">Name</th>
                <th class="all">Credit</th>
                <th class="all">Debit</th>
                <th class="all">Pending</th>
                <th class="all">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ledger as $key => $list)
            <tr>
                <td>{{ $ledger->firstItem() + $key }}</td>
               
                <td>
                   {{$list->name ?? ''}}
                </td>
                <td>
                    {{formatIndianNumber($list->total_cr) ?? ''}}
                </td>
                <td>
                    {{formatIndianNumber($list->total_dr) ?? ''}}
                </td>
                
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
    </table>
</div>
<div class="mt-2">
    {{$ledger->onEachSide(1)->links()}}
</div>