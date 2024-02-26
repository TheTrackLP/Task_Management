<div class="modal fade" tabindex="-1" id="editAcct" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('update.account') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h2>Edit Account</h2>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="id" id="id">
                        <label for="">Employee:</label>
                        <select name="" id="empIid" class="form-select">
                            <option value=""></option>
                            @foreach($emps as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }} | {{ $emp->occupation }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Username:</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" id="mail" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Assign Role:</label>
                        <select name="roles" id="roles" class="form-select">
                            <option value="" disabled selected>Assign Role</option>
                            @foreach($roless as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Admin or User:</label>
                        <select name="role" id="role" class="form-select">
                            <option value="" selected disabled>Please Select Here</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>