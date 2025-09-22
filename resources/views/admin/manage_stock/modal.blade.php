<form action="{{ route('manage_stock.update',$stock) }}" method="post" id="updateForm" class="modal-content" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="stock_id"  value="{{$stock->id ?? 0}}">
    <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalLabel">{{($stock->id ?? 0) ? 'Edit' : 'Add'}} Quantity</h4>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
    </div>
    <div class="modal-body dark-modal">
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <h6>Quantity</h6>
                <input type="number" step="any" name="quantity" value="{{$stock->quantity ?? ''}}"class="form-control" required>
            </div>
        </div>

    </div>
    <div class="modal-footer text-end">
        <button type="submit" id="update" class="btn btn-primary">{{($stock->id ?? 0) ? 'Update' : 'Add'}}</button>
    </div>
</form>