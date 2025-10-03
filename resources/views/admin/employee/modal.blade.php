<form action="{{ route('user.store') }}" method="post" id="updateForm" class="modal-content" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="user_id"  value="{{$user->id ?? 0}}">
    <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalLabel">{{$user->id ? 'Edit User' : 'Add User'}}</h4>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
    </div>
    <div class="modal-body dark-modal">
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <h6>Name</h6>
                <input type="text" name="name"  value="{{ old('name', $user->name ?? '') }}"class="form-control" required>
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Email</h6>
                <input type="email" name="email"  value="{{ old('email', $user->email ?? '') }}"class="form-control" required>
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Password</h6>
                <input type="password" name="password"  value="{{ old('password', $user->show_password ?? '') }}"class="form-control" required>
                <div class="show-hide toggle-password"><span class="show"></span></div>
            </div>
            <div class="col-md-12 form-group mb-3">
                <h6>Role As</h6>
                <select name="role_as" id="role_as" class="form-control" required>
                    <option value="Order_Management" {{ (old('role_as', $user->role_as ?? '') == 'Order_Management') ? 'selected' : '' }}>Order Management</option>
                    <option value="Stock_Management" {{ (old('role_as', $user->role_as ?? '') == 'Stock_Management') ? 'selected' : '' }}>Stock Management</option>
                </select>
            </div>

        
            <!-- role select removed as it's derived from sub_admin_id -->
        </div>
    </div>
    <div class="modal-footer text-end">
        <button type="submit" id="update" class="btn btn-primary">Upload</button>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        var subSelect = document.getElementById('sub_admin_id');
        if(!subSelect) return;
        function toggleBlocks(){
            var isSub = subSelect.value == '1';
            var dept = document.querySelectorAll('select[name="department_id[]"]');
            var cat = document.querySelectorAll('select[name="category_id[]"]');
            dept.forEach(function(el){ el.closest('.form-group').style.display = isSub ? '' : 'none'; });
            cat.forEach(function(el){ el.closest('.form-group').style.display = isSub ? 'none' : ''; });
        }
        subSelect.addEventListener('change', toggleBlocks);
        toggleBlocks();
    });
</script>