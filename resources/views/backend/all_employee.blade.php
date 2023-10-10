@extends('admin.header')
@section('admin')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="mb-5 font-weight-bold text-primary">Employee List</h4>
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addEmployee">Add New
                Employee</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Email/Contact</th>
                            <th>Position</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($allEmployees))
                        @foreach($allEmployees as $key => $data)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $data->emp_id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>
                                <p><i class="fas fa-at"></i> {{ $data->email }}</p>
                                <p><i class="fas fa-phone"></i> {{ $data->contact }}</p>
                            </td>
                            <td class="text-center">
                                {{ $data->position }}
                            </td>
                            <td class="text-center">
                                @if(isset($data->start_date) && isset($data->end_date))
                                <p>Start: {{ date('M d, Y', strtotime($data->start_date)) }}</p>
                                <p>End: {{ date('M d, Y', strtotime($data->end_date)) }}</p>
                                @else
                                <p>Permanent Emplyoee</p>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('edit.employee', $data->id) }}" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a>
                                <a href="{{ route('delete.employee', $data->id) }}" id="delete"
                                    class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        No Data Found
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@include('backend.add_employee')
@endsection