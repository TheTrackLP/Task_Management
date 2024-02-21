<div class="modal fade" tabindex="-1" id="AddRnP" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Role in Permission</h3>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.roles.permissions') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="">Role Name</label>
                        <select name="role_id" id="" class="form-select">
                            <option value="" selected disabled>Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="checkMain" id="checkMain" class="form-check-input">
                        <label for="">Permission All</label>
                    </div>
                    <hr>
                    @foreach($permi_groups as $groups)
                    <div class="row">
                        <div class="col-3">
                            <div class="form-check mb-3">
                                <input type="checkbox" name="" id="" class="form-check-input">
                                <label for="">{{ $groups->group_name }}</label>
                            </div>
                        </div>
                        <div class="col-9">
                            @php
                            $permissions = App\Models\User::getpermissionByGroupName($groups->group_name)
                            @endphp
                            @foreach($permissions as $permi)
                            <div class="form-check mb-3">
                                <input type="checkbox" name="permission[]" id="checkDefault{{ $permi->id }}"
                                    class="form-check-input" value="{{ $permi->id }}">
                                <label for="checkDefault{{ $permi->id }}">{{ $permi->name }}</label>
                            </div>
                            @endforeach
                            <br>
                        </div>
                    </div>
                    @endforeach
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add</button>
                        <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#checkMain').click(function() {
    if ($(this).is(':checked')) {
        $('input[type=checkbox]').prop('checked', true);
    } else {
        $('input[type=checkbox]').prop('checked', false);
    }
});
</script>