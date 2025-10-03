<div class="dt-ext table-responsive">
    <table class="display table-striped table-hover" id="basic-test">
        <thead>
            <tr>
                <th class="all">#</th>
                <th class="all">Name</th>
                <th class="all">Email</th>
                
                <th class="all">Category</th>
                <th class="all">Role</th>
                <th class="all">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $item)
            <tr>
                <td>{{ $users->firstItem() + $key }}</td>
                <td>{{ $item->name ?? 'N/A' }} </td>
                <td>{{ $item->email ?? 'N/A' }}</td>
               
                <td>{{ $item->getCategoryNamesAttribute() ?? 'N/A' }}</td>
                <td>
                    {{$item->role_as ?? ''}}
                </td>
                <td>
                  
                    <a onclick="edit_modal({{$item->id}},{{$key+1}})"  class="btn btn-warning btn-sm  pointer p-1 " data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="tooltip" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if (auth()->user()->role_as == 'Admin')
                        <a onclick="delete_user({{$item->id}})" class="btn btn-danger btn-sm  pointer p-1 " data-toggle="tooltip" title="Delete">
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
    {{$users->onEachSide(1)->links()}}
</div>