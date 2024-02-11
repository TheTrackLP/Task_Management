<div class="container-fluid">
    <div class="modal fade" tabindex="-1" id="editTask" role="document" data-bs-keyboard="false"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-xl" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Edit Tasks | Project for:<span id="prj_name"></span></h3>
                </div>
                <form action="{{ route('update.tasks') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="" class="mb-2">Task:</label>
                                    <input type="text" name="task_name" id="task_name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-2">Assign Task to:</label>
                                    <select name="emp_id" id="emp_id" class="form-select">
                                        <option value=""></option>
                                        @foreach($emps as $emp)
                                        <option value="{{ $emp->emp_id }}">{{ $emp->name}} | {{$emp->position}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-2">Start Date</label>
                                    <input type="datetime-local" name="start_date" id="start_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-2">Due Date</label>
                                    <input type="datetime-local" name="due_date" id="due_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-3">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value=""></option>
                                        <option value="0">Pending</option>
                                        <option value="1">On Progress</option>
                                        <option value="2">Complete</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="" class="mb-2">Description</label>
                                    <textarea name="task_desc" id="sm2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>