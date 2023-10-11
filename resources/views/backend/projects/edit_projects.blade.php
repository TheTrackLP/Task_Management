@extends('admin.header')
@section('admin')

<form action="{{ route('update.projects') }}" method="post">
    @csrf
    <div class="col-md-12 grid-margin stretch-card">
        <div class="row">
            <div class="form-group col-lg-6">
                <input type="hidden" name="id" value="{{ $projectData->id }}">
                <label>Project Name:</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ $projectData->name }}">
                @error('name')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-lg-6">
                <label>Status:</label>
                <select class="form-control" name="status">
                    <option value="0" {{ $projectData->status == 0 ? 'selected' : ''}}>Pending</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label>Start Date:</label>
                <input type="date" name="start_date" class="form-control" value="{{ $projectData->start_date }}">
            </div>
            <div class="form-group col-lg-6">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $projectData->end_date }}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label>Project Manager:</label>
                <input type="text" name="manager" class="form-control @error('manager') is-invalid @enderror"
                    value="{{ $projectData->manager }}">
                @error('manager')
                <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-lg-6">
                <label>Team Members:</label>
                <select class="form-control" name="members">
                    <option value="asd" {{ $projectData->members == 'asd' ? 'selected' : ''}}>Team</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <label>Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                    rows="10">{{ $projectData->description }}</textarea>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-info">Update Project</button>
        <a href="{{ route('all.projects') }}" class="btn btn-danger">Close</a>
    </div>
</form>
@endsection