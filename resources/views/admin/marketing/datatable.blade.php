<div class="dt-ext table-responsive">
    <table class="display " id="basic-test">
        <thead>
            <tr>
                <th class="all">#</th>
                <th class="all">Type</th>
                <th class="all">Video/Image</th>
                <th class="all">Date</th>
                <th class="all">Remarks</th>
                <th class="all">Status</th>
                <th class="all">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($marketing as $key => $item)
            <tr id="marketing_data_{{$item->id}}">
                <td>{{ $marketing->firstItem() + $key }}</td>
                <td>{{ $item->message_type ?? 'N/A' }}</td>
                {{-- <td>{{ $item->uploaded_file ?? 'N/A' }}</td> --}}
                {{-- <td>'env.('APP_URL')'{{ $item->uploaded_file ?? 'N/A' }}</td> --}}
                <td>
                    @if($item->file)
                    @php
                        $fileUrl = env('APP_URL') . $item->file;
                        $extension = strtolower(pathinfo($item->file, PATHINFO_EXTENSION));
                    @endphp
                
                    @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                        <!-- Image Preview -->
                        <a href="{{ $fileUrl }}" target="_blank">
                            <img src="{{ $fileUrl }}" alt="Uploaded Image" style="max-height: 100px; border-radius:6px;">
                        </a>
                
                    @elseif(in_array($extension, ['mp4', 'webm', 'ogg']))
                        <!-- Video Preview -->
                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-primary">
                            🎥 Preview Video
                        </a>
                
                    @elseif($extension === 'pdf')
                        <!-- PDF Preview -->
                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-success">
                            📄 View PDF
                        </a>
                
                    @else
                        <span class="text-muted">Unsupported File Type</span>
                    @endif
                @else
                    <span class="text-danger">No File</span>
                @endif
                
                </td>


                <td>{{ $item->message_date ?? 'N/A' }}</td>
                <td>{{ $item->message ?? 'N/A' }}</td>
                <td>
                <div class="btn btn-{{($item->status ?? 0) == 0 ? 'warning':'success'}} btn-xs">
                    
                    <span>{{$item->status == 0 ? 'Pending':'Completed'}}</span>
                </div>
                </td>
             
                <td>
                    @if($item->is_auto == 0 && $item->status == 0)
                    <a onclick="send_whatsapp({{$item->id}})" id="send-whatsapp-{{$item->id}}" class="btn btn-success btn-sm  pointer p-1 f-14">
                        <i class="fa fa-paper-plane"></i>
                    </a>
                    @endif
                    <a onclick="edit_modal({{$item->id}},{{$key+1}})"  class="btn btn-warning btn-sm  pointer p-1 f-14" data-bs-toggle="modal" data-bs-target="#edit_modal"  data-toggle="tooltip" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if (auth()->user()->role_as == 'Admin')
                        <a onclick="delete_marketing({{$item->id}})" class="btn btn-danger btn-sm  pointer p-1 f-14" data-toggle="tooltip" title="Delete">
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
    {{$marketing->onEachSide(1)->links()}}
</div>

