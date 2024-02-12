@extends('admin.body.header')
@section('admin')

<style>
p {
    padding: 0;
    margin: 0;
}
</style>

<div class="container-fluid">
    <div class="mb-4"></div>
    <div class="card shadow mb-4">
        <div class="card-header mb-4">
            <h3>Employee Lists</h3>
            <button class="btn btn-info text-white btn-lg float-end mb-4 px-5" data-bs-target="#addEmployee"
                data-bs-toggle="modal">Add Employee</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Emp ID#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Position</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($employees as $emp)
                        <tr>
                            <td class="text-center">
                                <b>{{ $i++ }}</b>
                            </td>
                            <td class="text-center">
                                <b>{{ $emp->emp_id }}</b>
                            </td>
                            <td>
                                <b>{{ $emp->name}}</b>
                            </td>
                            <td class="text-center">
                                <b>{{ $emp->position}}</b>
                            </td>
                            <td>
                                <p><b>Start Date: </b><span
                                        class="badge text-bg-info text-white">{{ date('M d, Y', strtotime($emp->start_date)) }}</span>
                                </p>
                                <p><b>End Date: </b><span
                                        class="badge text-bg-danger">{{ date('M d, Y', strtotime($emp->end_date)) }}</span>
                                </p>
                            </td>
                            <td class="text-center">
                                @if($emp->status == 'inactive')
                                <span class="badge text-bg-danger">Inactive</span>
                                @elseif($emp->status == 'active')
                                <span class="badge text-bg-success">Active</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle text-white"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li> <button class="dropdown-item" value="{{ $emp->id }}"
                                                id="BtnEdit">Edit</button></li>
                                        <li> <a class="dropdown-item" id="delete"
                                                href="{{ route('delete.employee', $emp->id) }}">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $(document).on('click', '#BtnEdit', function() {
        var emp_id = $(this).val();
        $('#editEmployee').modal('show');

        $.ajax({
            type: "GET",
            url: "/admin/employees/edit/" + emp_id,
            success: function(response) {
                console.log(response);
                $('#emp_id').val(response.employees.emp_id)
                $('#firstname').val(response.employees.firstname);
                $('#middlename').val(response.employees.middlename);
                $('#lastname').val(response.employees.lastname);
                $('#contact').val(response.employees.contact);
                $('#email').val(response.employees.email);
                $('#position').val(response.employees.position);
                $('#address').val(response.employees.address);
                $('#start_date').val(response.employees.start_date);
                $('#end_date').val(response.employees.end_date);
                $('#status').val(response.employees.status);
                $('#id').val(emp_id);
            }
        });
    });
});
</script>
@include('backend.employees.edit_employees')
@include('backend.employees.add_employees')
@endsection