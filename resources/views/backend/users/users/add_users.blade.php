<div class="modal fade" tabindex="-1" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <form action="{{ route('store.user') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h3>Add Account</h3>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Employee</label>
                        <select name="user_id" id="user_id" class="select2" onchange="getvalue()">
                            <option value=""></option>
                            @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="email" id="email">
                        <input type="hidden" name="emp_id" id="emp_id">
                        <input type="hidden" name="status" id="status">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Acount</button>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$('.select2').select2({
    placeholder: "Please Select Here",
    width: "100%",
    dropdownParent: $('#addUser')
});
</script>