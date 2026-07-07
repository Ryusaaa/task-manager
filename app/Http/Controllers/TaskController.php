<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::orderBy('name')->get();

        $tasks = Task::with('project')
            ->when($request->filled('project_id'), fn ($query) => $query->where('project_id', $request->project_id))
            ->orderBy('priority')
            ->get();

        return view('tasks.index', compact('projects', 'tasks'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $nextPriority = Task::max('priority') + 1;

        Task::create([
            ...$request->validated(),
            'priority' => $nextPriority,
        ]);

        return redirect()
            ->route('home')
            ->with('status', 'Task created.');
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return redirect()
            ->route('home')
            ->with('status', 'Task updated.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()
            ->route('home')
            ->with('status', 'Task deleted.');
    }

    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['integer', 'exists:tasks,id'],
        ]);

        DB::transaction(function () use ($validated) {
            foreach ($validated['order'] as $index => $taskId) {
                Task::whereKey($taskId)->update(['priority' => $index + 1]);
            }
        });

        return response()->json(['message' => 'Order updated.']);
    }
}