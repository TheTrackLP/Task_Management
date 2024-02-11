@extends('admin.body.header')
@section('admin')

<div class="container-fluid">
    <div class="mb-4">
        <div class="card shadow mb-4 mt-4">
            <div class="card-header mb-4">
                <h3>Leaves</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-reponsive table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Employee Name</th>
                                <th class="text-center">Leave Type</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">#</td>
                                <td>Name</td>
                                <td class="text-center">Leave Type</td>
                                <td class="text-center">Status</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle text-white"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" class="dropdown-item"><i class="fas fa-eye"></i> View</a>
                                            </li>
                                            <li> <a class="dropdown-item" id="delete" href="#"><i
                                                        class="fas fa-trash"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection