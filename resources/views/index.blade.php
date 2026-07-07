@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <form method="GET" action="{{ route('home') }}" class="d-flex align-items-center gap-2">
        <label for="project_id" class="form-label mb-0 text-muted small">Project</label>
        <select name="project_id" id="project_id" class="form-select form-select-sm" onchange="this.form.submit()" style="width: 200px;">
            <option value="">All projects</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" @selected(request('project_id') == $project->id)>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
    </form>

    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#projectModal">
            <i class="bi bi-folder-plus"></i> New Project
        </button>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#taskModal">
            <i class="bi bi-plus-lg"></i> New Task
        </button>
    </div>
</div>

<div class="card shadow-sm">
    <ul id="task-list" class="list-group list-group-flush">
        @forelse ($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $task->id }}">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-grip-vertical text-muted drag-handle" style="cursor: grab;"></i>
                    <div>
                        <div>{{ $task->task_name }}</div>
                        @if ($task->project)
                            <span class="badge text-bg-light border">{{ $task->project->name }}</span>
                        @endif
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button
                        class="btn btn-sm btn-outline-secondary"
                        data-bs-toggle="modal"
                        data-bs-target="#taskModal"
                        data-id="{{ $task->id }}"
                        data-name="{{ $task->task_name }}"
                        data-project="{{ $task->project_id }}"
                    >
                        <i class="bi bi-pencil"></i>
                    </button>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </li>
        @empty
            <li class="list-group-item text-center text-muted py-4">No tasks yet.</li>
        @endforelse
    </ul>
</div>

@include('tasks.partials.task-modal')
@include('projects.partials.project-modal')
@endsection

@section('scripts')
<script>
    const taskModal = document.getElementById('taskModal');
    taskModal.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const form = document.getElementById('task-form');
        const nameInput = document.getElementById('task_name');
        const projectSelect = document.getElementById('task_project_id');

        if (id) {
            form.action = `/tasks/${id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';
            nameInput.value = button.getAttribute('data-name');
            projectSelect.value = button.getAttribute('data-project') ?? '';
            document.getElementById('taskModalLabel').textContent = 'Edit Task';
        } else {
            form.action = '{{ route('tasks.store') }}';
            form.querySelector('input[name="_method"]').value = 'POST';
            form.reset();
            document.getElementById('taskModalLabel').textContent = 'New Task';
        }
    });
</script>
<script src="{{ asset('js/sortable.js') }}"></script>
@endsection