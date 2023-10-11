@extends('admin.header')
@section('admin')

<style>
.min {
    display: block;
    width: 100px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
</style>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="mb-5 font-weight-bold text-primary">Projects List</h4>
            <a href="{{ route('add.projects') }}" class="btn btn-primary float-right">Add New Project</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Date Started</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allProjects as $key => $data)
                        <tr>
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>
                                <p>{{ $data->name }}</p>
                                <small class="min">{{ $data->description }}</small>
                            </td>
                            <td class="text-center">{{ date('M d, Y', strtotime($data->start_date)) }}</td>
                            <td class="text-center">{{ date('M d, Y', strtotime($data->end_date)) }}</td>
                            <td class="text-center">
                                @if($data->status == 0)
                                <span class="badge badge-secondary">Pending</span>
                                @elseif($data->status == 1)
                                <span class="badge badge-info">In Progress</span>
                                @elseif($data->status == 2)
                                <span class="badge badge-success">Complete</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('view.projects', $data->id) }}" class="btn btn-success"> <i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('edit.projects', $data->id) }}" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a>
                                <a href="{{ route('delete.projects', $data->id) }}" id="delete"
                                    class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@include('backend.add_employee')
@endsection