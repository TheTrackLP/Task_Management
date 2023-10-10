@extends('admin.header')
@section('admin')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title font-weight-bold">Edit Employee</h4>
            <hr>
            <form action="{{ route('update.employee') }}" method="post">
                @csrf
                <div class="col-md-12 grid-margin stretch-card">
                    <input type="hidden" name="id" value="{{ $employeeData->id }}">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Employee ID#:</label>
                            <input type="text" name="emp_id" value="{{ $employeeData->emp_id }}"
                                class="form-control shadow-sm" placeholder="Employee ID#...">
                            <small class="font-weight-bold">Note: Leave if Employee has ID# Already</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label>First Name:</label>
                            <input type="text" name="firstname" value="{{ $employeeData->firstname }}"
                                class="form-control @error('firstname') is-invalid @enderror shadow-sm"
                                placeholder="First Name...">
                            @error('firstname')
                            <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Middle Name:</label>
                            <input type="text" name="middlename" value="{{ $employeeData->middlename }}"
                                class="form-control @error('middlename') is-invalid @enderror shadow-sm"
                                placeholder="Middle Name...">
                            @error('middlename')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Last Name:</label>
                            <input type="text" name="lastname" value="{{ $employeeData->lastname }}"
                                class="form-control @error('lastname') is-invalid @enderror shadow-sm"
                                placeholder="Last Name...">
                            @error('lastname')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label>Contact #:</label>
                            <input type="text" name="contact" value="{{ $employeeData->contact }}"
                                class="form-control @error('contact') is-invalid @enderror shadow-sm"
                                placeholder="Contact #...">
                            @error('contact')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Email:</label>
                            <input type="email" name="email" value="{{ $employeeData->email }}"
                                class="form-control @error('email') is-invalid @enderror shadow-sm"
                                placeholder="Email...">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Position:</label>
                            <input type="text" name="position" value="{{ $employeeData->position }}"
                                class="form-control @error('position') is-invalid @enderror shadow-sm"
                                placeholder="Position...">
                            @error('position')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <small class="font-weight-bold">Note: Leave Dates Blank if employee is regular</small>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label>Start Date:</label>
                            <input type="date" name="start_date"
                                value="{{ isset($employeeData->start_date) ? $employeeData->start_date : '' }}"
                                class="form-control shadow-sm">
                        </div>
                        <div class="form-group col-lg-3">
                            <label>End Date</label>
                            <input type="date" name="end_date"
                                value="{{ isset($employeeData->end_date) ? $employeeData->end_date : '' }}"
                                class="form-control shadow-sm">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror shadow-sm"
                                name="address" rows="3"
                                placeholder="Village/Street Name/Brgy./City/Province">{{ $employeeData->address }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="buttons float-right">
                    <button class="btn btn-success">Update Employee</button>
                    <a href="{{ route('all.employee') }}" class="btn btn-danger">Back</a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection