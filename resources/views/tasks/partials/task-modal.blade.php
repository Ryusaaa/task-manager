<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel">
    <div class="modal-dialog">
        <form id="task-form" method="POST" action="{{ route('tasks.store') }}" class="modal-content">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="task_name" class="form-label">Task name</label>
                    <input type="text" name="task_name" id="task_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="task_project_id" class="form-label">Project</label>
                    <select name="project_id" id="task_project_id" class="form-select">
                        <option value="">None</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>