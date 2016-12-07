<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Task;
use App\Repositories\TaskRepository;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    protected $tasks;

    public function __construct(TaskRepository $task)
    {
        $this->middleware('auth');
        $this->tasks = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forTasks($request->user())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $request->user()->tasks()->create($request->all());
        return redirect('/tasks')->with('success', 'Task Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Task $task)
    {
        if($request->user()->role == "ADMIN"){
            return view('tasks.edit', [
                'task' => $task
            ]);
        }else{
            $this->authorize('owner', $task);
            return view('tasks.edit', [
                'task' => $task,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        if($request->user()->role == "ADMIN"){
            $task->update($request->all());
            return redirect('/tasks')->with('success', 'Task Edited');
        }else{
            $this->authorize('owner', $task);
            $task->update($request->all());
            return redirect('/tasks')->with('success', 'Task Edited');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Task $task)
    {
        if($request->user()->role == "ADMIN"){
            $task->delete();
            return redirect('/tasks')->with('success', 'Task Deleted');
        }else{
            $this->authorize('owner', $task);
            $task->delete();
            return redirect('/tasks')->with('success', 'Task Deleted');
        }
    }
}
