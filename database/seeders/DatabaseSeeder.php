<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $project = Project::create(['name' => 'General']);

        Task::create(['project_id' => $project->id, 'task_name' => 'Setup repository', 'priority' => 1]);
        Task::create(['project_id' => $project->id, 'task_name' => 'Design database schema', 'priority' => 2]);
    }
}