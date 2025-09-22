<div class="dt-ext table-responsive">
    <table class="display table-striped table-hover" id="basic-test">
        <thead>
            <tr>
                <th class="all">#</th>
                <th class="all">Date</th>
                <th class="all">Category</th>
                <th class="all">Remarks</th>
                <th class="all">Amount</th>
                <th class="all">Method</th>
                <th class="all">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expense as $key => $item)
            <tr>
                <td>{{ $expense->firstItem() + $key }}</td>
                <td>{{ date('d M,Y',strtotime($item->date)) }}</td>
                <td>{{ $item->account->name ?? 'N/A' }}</td>
                <td>{{ $item->remarks ?? '' }}</td>
                <td>{{ $item->amount ?? '' }}</td>
                <td>{{ $item->payment_method->name ?? '' }}</td>
                
                <td>
                   
                    <a onclick="edit_modal({{$item->id}},{{$key+1}})"  class="btn btn-warning btn-sm  pointer p-1 f-14" data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="tooltip" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if (auth()->user()->role_as == 'Admin')
                        <a onclick="delete_expense({{$item->id}})" class="btn btn-danger btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Delete">
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
    {{$expense->onEachSide(1)->links()}}
</div>