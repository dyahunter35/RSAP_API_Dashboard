<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Auth\RequestGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $tasks = Task::orderBy('id', 'desc')->paginate(10);

        //dd($tasks);
        //return $tasks;
        return view('tasks.index2', compact('tasks'))
            ->with('i', (($request->input('page', 1) - 1) * $tasks->perPage())+1);

    }

    public function create()
    {

        $this->authorize('manage tasks');

        return view('tasks.create');
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
