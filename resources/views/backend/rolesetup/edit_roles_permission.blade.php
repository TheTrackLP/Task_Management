@extends('admin.body.header')
@section('admin')
<style>
tr,
td {
    text-transform: capitalize;
}
</style>
<div class="container-fluid">
    <div class="col-md-8">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Roles and Permission</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('update.roles.permission', $role->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="">Role Name</label>
                            <h4>{{ $role->name }}</h4>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="checkMain" id="checkMain" class="form-check-input">
                            <label for="checkMain">Permission All</label>
                        </div>
                        <hr>
                        @foreach($permi_groups as $groups)
                        <div class="row">
                            <div class="col-3">
                                @php
                                $permissions = App\Models\User::getpermissionByGroupName($groups->group_name)
                                @endphp
                                <div class="form-check mb-3">
                                    <input type="checkbox" name="" id="" class="form-check-input"
                                        {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="">{{ $groups->group_name }}</label>
                                </div>
                            </div>
                            <div class="col-9">

                                @foreach($permissions as $permi)
                                <div class="form-check mb-3">
                                    <input type="checkbox" name="permission[]" id="checkDefault{{ $permi->id }}"
                                        class="form-check-input" value="{{ $permi->id }}"
                                        {{$role->hasPermissionTo($permi->name) ? 'checked' : ''}}>
                                    <label class="form-check-label"
                                        for="checkDefault{{ $permi->id }}">{{ $permi->name }}</label>
                                </div>
                                @endforeach
                                <br>
                            </div>
                        </div>
                        @endforeach
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Add</button>
                            <button type="button" class="btn btn-danger text-white"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
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
@endsection