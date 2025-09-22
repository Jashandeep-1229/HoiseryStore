<form action="{{ route('season.store') }}" method="post" id="updateForm" class="modal-content" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="season_id"  value="{{$season->id ?? 0}}">
    <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalLabel">{{($season->id ?? 0) ? 'Edit' : 'Add'}} Season</h4>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
    </div>
    <div class="modal-body dark-modal">
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <h6>Name</h6>
                <input type="text" name="name" value="{{$season->name ?? ''}}" oninput="this.value = this.value.toUpperCase()" class="form-control" required>
            </div>
        </div>

    </div>
    <div class="modal-footer text-end">
        <button type="submit" id="update" class="btn btn-primary">{{($season->id ?? 0) ? 'Update' : 'Add'}}</button>
    </div>
</form>