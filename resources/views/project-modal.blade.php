<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('projects.store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label for="project_name" class="form-label">Project name</label>
                <input type="text" name="name" id="project_name" class="form-control" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>