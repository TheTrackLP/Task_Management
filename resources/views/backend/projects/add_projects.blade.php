@extends('admin.body.header')
@section('admin')

<style>
label {
    font-weight: bold;
}
</style>

<div class="container-fluid">
    <form action="{{ route('store.projects') }}" method="post">
        @csrf
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Project Name</label>
                        <input type="text" name="prj_name" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <select name="status" class="form-select">
                            <option value="" selected disabled>Pending</option>
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Start Date:</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">End Date:</label>
                        <input type="date" name="end_date" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Project Manager</label>
                        <select name="leader_empid" class="form-select sl2">
                            <option value=""></option>
                            @foreach($emps as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }} | {{ $emp->position }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Project Team Members</label>
                        <select name="prj_members" class="select2">
                            <option value=""></option>
                            @foreach($emps as $emp)
                            <option value="{{ $emp->emp_id }}">{{ $emp->name }} | {{ $emp->position }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="prj_description" id="summernote"></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-success">Add Project</button>
                <button type="button" class="btn btn-danger">Back</button>
            </div>
        </div>
    </form>
</div>
<script>
$('.select2').select2({
    placeholder: "Please select here",
    width: "100%",
    multiple: true,
});

$('.sl2').select2({
    placeholder: "Please select here",
    width: "100%",
});
</script>
@endsection