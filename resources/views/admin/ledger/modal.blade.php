<form action="{{ route('ledger.store') }}" method="post" id="updateForm" class="modal-content" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id"  value="{{$ledger->id ?? 0}}">
    <input type="hidden" name="account_id"  value="{{$ledger->account_id ?? 0}}">
    <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalLabel">{{($ledger->id ?? 0) ? 'Edit' : 'Add'}} Ledger</h4>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
    </div>
    <div class="modal-body dark-modal">
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <h6>Date</h6>
                <input type="date" name="date" value="{{$ledger->date ?? ''}}" class="form-control" required>
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Amount</h6>
                <input type="text" name="amount" id="amount" autofocus value="{{$ledger->amount}}"  placeholder="Amount" class="form-control" required>
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Dr/Cr</h6>
                <select class="form-control" name="dr_cr" id="dr_cr" required>
                                   
                    <option value="Dr" {{$ledger->dr_cr == 'Dr' ? 'selected' : ''}}>Debit/In</option>
                    <option value="Cr" {{$ledger->dr_cr == 'Cr' ? 'selected' : ''}}>Credit/Out</option>
                </select>
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Payment Method</h6>
                <select class="form-control" name="payment_method_id" id="payment_method_id" required>
                    @foreach($payment_master as $payment)
                    <option value="{{$payment->id}}" {{$ledger->payment_method_id == $payment->id ? 'selected' : ''}}>{{$payment->name ?? ''}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Remarks</h6>
                <textarea name="remarks" id="remarks" class="form-control">{{$ledger->remarks ?? ''}}</textarea>
            </div>
          
          
        </div>

    </div>
    <div class="modal-footer text-end">
        <button type="submit" id="update" class="btn btn-primary">{{($ledger->id ?? 0) ? 'Update' : 'Add'}}</button>
    </div>
</form>