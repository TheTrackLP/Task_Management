@extends('admin.header')
@section('admin')

<form action="{{ route('store.projects') }}" method="post">
    @csrf
    <div class="col-md-12 grid-margin stretch-card">
        <div class="row">
            <div class="form-group col-lg-6">
                <label>Name:</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Project Name...">
                @error('name')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-lg-6">
                <label>Status:</label>
                <select class="form-control" name="status">
                    <option value="0">Pending</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label>Start Date:</label>
                <input type="date" name="start_date" class="form-control">
            </div>
            <div class="form-group col-lg-6">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label>Project Manager:</label>
                <select name="emp_id" class="form-control">
                    <option value="" disable>Select Manager:</option>
                    @foreach($employees as $employee)
                    <option value="{{$employee->emp_id}}">{{ $employee->name}} | {{ $employee->position}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <label>Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                    rows="10"></textarea>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-info">New Project</button>
        <button class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>
@endsection