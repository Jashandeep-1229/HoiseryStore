<form action="{{ route('income.store') }}" method="post" id="updateForm" class="modal-content" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id"  value="{{$income->id ?? 0}}">
    <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalLabel">{{($income->id ?? 0) ? 'Edit' : 'Add'}} Income</h4>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
    </div>
    <div class="modal-body dark-modal">
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <h6>Date</h6>
                <input type="date" name="date" value="{{$income->date ?? ''}}" class="form-control" required>
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Income</h6>
                <select class="js-example-basic-single" name="income_id" id="income_id" required>
                    <option value="" selected disabled>Select Income</option>
                    @foreach($account_income as $acc)
                    <option value="{{$acc->id}}" {{$income->account_id == $acc->id ? 'selected' : ''}}>{{$acc->name ?? ''}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Payment Method</h6>
                <select class="js-example-basic-single" name="payment_method_id" id="payment_method_id" required>
                    <option value="" selected disabled>Select Payment Method</option>
                    @foreach($payment_master as $payment)
                    <option value="{{$payment->id}}" {{$income->payment_method_id == $payment->id ? 'selected' : ''}}>{{$payment->name ?? ''}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Amount</h6>
                <input type="number" step="any" name="amount" value="{{$income->amount ?? ''}}" class="form-control" required>
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Remarks</h6>
                <input type="text" name="remarks" value="{{$income->remarks ?? ''}}" class="form-control" required>
            </div>
        </div>

    </div>
    <div class="modal-footer text-end">
        <button type="submit" id="update" class="btn btn-primary">{{($income->id ?? 0) ? 'Update' : 'Add'}}</button>
    </div>
</form>