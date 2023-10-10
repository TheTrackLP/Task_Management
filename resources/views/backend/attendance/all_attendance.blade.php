@extends('admin.header')
@section('admin')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Attendance Of Employees</h4>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#</td>
                        <td>
                            <p>Emp Num</p>
                            <p>name</p>
                        </td>
                        <td>Time In</i>
                        </td>
                        <td>
                            Time Out
                        </td>
                        <td>Status</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection