<div class="modal fade" tabindex="-1" id="addAccount" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('add.admins') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h2 class="modal-title">
                        Add Account
                    </h2>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Employee:</label>
                        <select name="" id="empId" class="select2" onchange="getData()">
                            <option value=""></option>
                            @foreach($emps as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }} | {{ $emp->occupation }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Username:</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Assign Role:</label>
                        <select name="roles" class="form-select">
                            <option value="" disabled selected>Assign Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Admin or User:</label>
                        <select name="role" class="form-select">
                            <option value="" selected disabled>Please Select Here</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <input type="hidden" name="emp_id" id="emp_id">
                    <input type="hidden" name="email" id="email">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Account</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$('.select2').select2({
    placeholder: "Please select Here",
    width: "100%",
    dropdownParent: $('#addAccount')
});
</script>