<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(public TaskService $taskService) {}

    public function index()
    {
        $tasks = $this->taskService->getAll();

        return view('pages.tasks.index', ['appTitle' => 'Task organize your day', 'tasks' => $tasks]);
    }

    public function create(Request $req)
    {
        $title = $req->input('title');

        return redirect()->back()->with('task-created', "Task $title created successfully");
    }

    public function createView()
    {
        return view('pages.tasks.create', ['appTitle' => 'Task organize your day']);
    }
}
