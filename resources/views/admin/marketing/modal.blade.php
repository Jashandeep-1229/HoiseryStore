<form action="{{ route('marketing.update',$marketing->id) }}" method="post" id="updateForm" class="modal-content" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="key_value" value="{{$key_value}}">
    <input type="hidden" id="marketing_id"  value="{{$marketing->id}}">
    @method('PUT')
    <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalLabel">Edit Marketing Details</h4>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
    </div>
    <div class="modal-body dark-modal">
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <h6>Media Type</h6>
                {{-- <input type="text" name="name" value="{{$marketing->select_type ?? ''}}" class="form-control"> --}}
                
                <select class="form-select" name="message_type" id="message_type" required>
                    <option value='Simple Text' {{$marketing->message_type == 'Simple Text' ? 'selected':''}}>Simple Text</option>
                    <option value='Image' {{$marketing->message_type == 'Image' ? 'selected':''}}>Image</option>
                    <option value='Video' {{$marketing->message_type == 'Video' ? 'selected':''}}>Video</option>
                    <option value='PDF' {{$marketing->message_type == 'PDF' ? 'selected':''}}>PDF</option>
                </select>

            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Media</h6>
                <input type="file" name="file" value="{{$marketing->file ?? ''}}" class="form-control">
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Date</h6>
                <input type="date" name="message_date" value="{{$marketing->message_date ?? ''}}" class="form-control">
            </div>
            
            
            <div class="col-md-12 form-group mb-3">
                <h6>Message</h6>
                <textarea type="text" rows='3' name="message" class="form-control">{{$marketing->message ?? ''}}</textarea>
            </div>
            <div class="col-md-12 form-group mb-3">
                <select name="selected_customer[]" id="example-getting-started2"   multiple>
                    @foreach ($data as $state_city => $leads)
                    <optgroup label="{{$state_city}}" class="{{$state_city}}">
                        @foreach ($leads as $data)
                        <option value="{{$data->id}}" {{ in_array($data->id, json_decode($marketing->selected_customer) ?? []) ? 'selected' : '' }} >{{$data->name}} - {{$data->phone_no}}</option>
                        @endforeach
                    </optgroup>
                    @endforeach
               
                </select>
            </div>
            <div class="col-md-12  d-flex">
                <label class="switch">
                    <input type="checkbox" name="is_auto" {{$marketing->is_auto == 1 ? 'checked':''}}><span class="switch-state"></span>
                </label>
                <label class="col-form-label m-l-10">Automatically</label>
            </div>                        

        </div>
    </div>
    <div class="modal-footer text-end">
        <button type="submit" id="update" class="btn btn-primary">Update</button>
    </div>
</form>


