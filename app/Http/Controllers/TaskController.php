<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // READ: Show all tasks
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    // CREATE: Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255', // Form Validation
        ]);

        Task::create([
            'title' => $request->title,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    // Show the edit form
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // UPDATE: Save edited task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $task->update([
            'title' => $request->title,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // UPDATE: Mark as completed/incomplete
    public function complete(Task $task)
    {
        $task->update([
            'is_completed' => !$task->is_completed,
        ]);

        return redirect()->route('tasks.index');
    }

    // DELETE: Remove a task
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }
}
