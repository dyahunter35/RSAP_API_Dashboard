<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {

        $permissions = Permission::all();

        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        $this->authorize('manage permissions');

        return view('permissions.create');
    }

    public function store(StoreTaskRequest $request)
    {
        $this->authorize('manage tasks');

        Task::create($request->validated());

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $this->authorize('manage tasks');

        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('manage tasks');

        $task->update($request->validated());

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $this->authorize('manage tasks');

        $task->delete();

        return redirect()->route('tasks.index');
    }
}
