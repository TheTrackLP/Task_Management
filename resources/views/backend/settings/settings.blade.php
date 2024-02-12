@extends('admin.body.header')
@section('admin')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 mt-4">
            <div class="card shadow">
                <div class="card-header">
                    <h3>Add Position</h3>
                </div>
                <form action="{{ route('store.settings') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <label for="" class="mb-3"><b>Position:</b></label>
                        <input type="text" name="position" id="" class="form-control">
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success float-end px-5 my-3">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8 mt-4">
            <div class="card shadow">
                <div class="card-header">
                    <h3>Positions</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Position</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($positions as $position)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>
                                    <b>{{ $position->position}}</b>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('delete.position', $position->id) }}" class="btn btn-danger"
                                        id="delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection