<div class="modal fade" id="addMember" tabindex="-1">
    <div class="modal-dialog md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Member</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('addmember.projects') }}" method="post">
                    @csrf
                    <select name="emp_id" class="form-control">
                        <option value="" disable>Select Member</option>
                        @foreach($employees as $member)
                        <option value="{{ $member->emp_id }}">{{ $member->name }} | {{ $member->position}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="prj_id" value="{{ $prjData->id }}">
                    <div class="modal-footer">
                        <button class="btn btn-info">Add Member</button>
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>