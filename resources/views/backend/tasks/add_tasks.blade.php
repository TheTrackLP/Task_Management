<div class="container-fluid">
    <div class="modal fade" tabindex="-1" id="addTask" role="document" data-bs-keyboard="false"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-xl" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>New Tasks</h3>
                </div>
                <form action="{{ route('add.tasks') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="hidden" name="prj_id" value="{{ null }}">
                                    <label for="" class="mb-2">Task:</label>
                                    <input type="text" name="task_name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-2">Assign Task to:</label>
                                    <select name="emp_id" class="select2">
                                        <option value=""></option>
                                        @foreach($emps as $emp)
                                        <option value="{{ $emp->emp_id }}">{{ $emp->name}} | {{$emp->position}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-2">Start Date</label>
                                    <input type="datetime-local" name="start_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-2">Due Date</label>
                                    <input type="datetime-local" name="due_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="" class="mb-2">Description</label>
                                    <textarea name="task_desc" id="summernote"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add Task</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$('.select2').select2({
    placeholder: "Please Select Here",
    width: "100%",
    dropdownParent: $('#addTask')
});
</script>