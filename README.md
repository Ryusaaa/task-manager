# Task Manager

Simple task management app built with Laravel 12, PHP 8.3+, and MySQL.

## Features
- Create, edit, delete tasks
- Drag & drop reordering with automatic priority updates
- Optional grouping of tasks by project
- Filter tasks by project

## Requirements
- PHP 8.3+
- Composer
- MySQL
- Node.js (optional, only if you want to compile assets locally)

## Setup

\`\`\`bash
git clone <repo-url>
cd task-manager
composer install
cp .env.example .env
php artisan key:generate
\`\`\`

Update your `.env` with your MySQL credentials, then:

\`\`\`bash
php artisan migrate --seed
php artisan serve
\`\`\`

Visit `http://127.0.0.1:8000`.

## Tech Stack
- Laravel 12
- Bootstrap 5
- SortableJS

## Database Schema
- `projects`: id, name, timestamps
- `tasks`: id, project_id (nullable FK), task_name, priority, timestamps