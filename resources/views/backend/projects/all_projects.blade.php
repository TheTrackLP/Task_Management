@extends('admin.body.header')
@section('admin')

<style>
p {
    padding: 0;
    margin: 0;
}

.min {
    display: block;
    width: 150px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    height: 25px;
}
</style>
<div class="container-fluid">
    <div class="mb-4"></div>
    <div class="card shadow mb-4">
        <div class="card-header mb-4">
            <h3>Projects</h3>
            <a class="btn btn-info text-white btn-lg float-end mb-4 px-5" href="{{ route('add.projects') }}"><i
                    class="fa-solid fa-plus"></i> Add
                Project</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Project</th>
                            <th class="text-center">Start Date</th>
                            <th class="text-center">Due Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($prjs as $prj)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>
                                <b>
                                    {{ $prj->prj_name }}
                                </b>
                            </td>
                            <td class="text-center">
                                {{ date('M d, Y', strtotime($prj->start_date)) }}
                            </td>
                            <td class="text-center">
                                {{ date('M d, Y', strtotime($prj->end_date)) }}
                            </td>
                            <td class="text-center">
                                @if($prj->status === '0')
                                <span class="badge text-bg-secondary">Pending</span>
                                @elseif($prj->status === '1')
                                <span class="badge text-bg-primary">Active</span>
                                @elseif($prj->status === 2)
                                <span class="badge text-bg-success">Complete</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle text-white"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('view.projects', $prj->id) }}" class="dropdown-item"><i
                                                    class="fas fa-eye"></i> View</a>
                                        </li>
                                        <li><a href="{{ route('edit.projects', $prj->id) }}" class="dropdown-item"><i
                                                    class="fas fa-edit"></i>
                                                Edit</a></li>
                                        <li> <a class="dropdown-item" id="delete"
                                                href="{{ route('delete.projects', $prj->id) }}"><i
                                                    class="fas fa-trash"></i> Delete</a></li>
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
@endsection