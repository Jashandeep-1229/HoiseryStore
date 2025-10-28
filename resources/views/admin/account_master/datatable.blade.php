<div class="dt-ext table-responsive">
    <table class="display table-striped table-hover" id="basic-test">
        <thead>
            <tr>
                <th class="all">#</th>
                <th class="all">Name</th>
                <th class="all">Business Name</th>
                <th class="all">Phone</th>
                <th class="all">City</th>
                <th class="all">From</th>
                <th class="all">Status</th>
                <th class="all">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($account_master as $key => $item)
            <tr>
                <td>{{ $account_master->firstItem() + $key }}</td>
                <td>{{ $item->name ?? 'N/A' }}</td>
                <td>{{ $item->business_name ?? 'N/A' }}</td>
                <td>{{ $item->phone_no ?? 'N/A' }}</td>
                <td>{{ $item->city ?? 'N/A' }}</td>
                <td>{{ $item->from ?? 'N/A' }}</td>
                <td>
                    <div class="media-body text-start ">
                        <label class="switch">
                          <input type="checkbox" {{$item->status == 1 ? 'checked':''}} onchange="change_status({{$item->id}})"><span class="switch-state"></span>
                        </label>
                      </div>
                </td>
                <td>
                   
                    <a onclick="edit_modal({{$item->id}},{{$key+1}})"  class="btn btn-warning btn-sm  pointer p-1 f-14" data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="tooltip" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if (auth()->user()->role_as == 'Admin')
                        <a onclick="delete_account_master({{$item->id}})" class="btn btn-danger btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Delete">
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
    {{$account_master->onEachSide(1)->links()}}
</div>