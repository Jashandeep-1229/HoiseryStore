<form action="{{ route('account_master.store') }}" method="post" id="updateForm" class="modal-content" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="account_master_id"  value="{{$account_master->id ?? 0}}">
    <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalLabel">{{($account_master->id ?? 0) ? 'Edit' : 'Add'}} Account Master</h4>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
    </div>
    <div class="modal-body dark-modal">
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <h6>Name</h6>
                <input type="text" name="name" value="{{$account_master->name ?? ''}}" oninput="this.value = this.value.toUpperCase()" class="form-control" required>
            </div>
            @if(($account_master->from ?? '') == 'Vendor' || ($account_master->from ?? '') == 'Customer' || request()->modal_from == 'Vendor' || request()->modal_from == 'Customer')
            <div class="col-md-12 form-group mb-3">
                <h6>Business Name</h6>
                <input type="text" name="business_name" value="{{$account_master->business_name ?? ''}}" oninput="this.value = this.value.toUpperCase()" class="form-control" >
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Phone No</h6>
                <input type="text" name="phone_no" value="{{$account_master->phone_no ?? ''}}" class="form-control" >
            </div>
            @endif
            
            @if($account_master->is_editable ?? 0)
            <div class="col-md-12 form-group mb-3">
                <h6>From</h6>
                <select class="form-control" name="from" required>
                    <option value="Vendor" {{$account_master->from == 'Vendor' ? 'selected' : ''}}>Vendor</option>
                    <option value="Customer" {{$account_master->from == 'Customer' ? 'selected' : ''}}>Customer</option>
                    <option value="Expense" {{$account_master->from == 'Expense' ? 'selected' : ''}}>Expense</option>
                    <option value="Income" {{$account_master->from == 'Income' ? 'selected' : ''}}>Income</option>
                </select>
            </div>
            @endif

            @if((request()->modal_from ?? 0) != 0)
            <input type="hidden" name="from" value="{{request()->modal_from}}">
            @endif
        </div>

    </div>
    <div class="modal-footer text-end">
        <button type="submit" id="update" class="btn btn-primary">{{($account_master->id ?? 0) ? 'Update' : 'Add'}}</button>
    </div>
</form>