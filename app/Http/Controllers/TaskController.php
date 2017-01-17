<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\File;
use Illuminate\Http\Request;
use App\User;
use App\Task;
use App\Repositories\TaskRepository;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $task = new Task();

        $task->title = $request->title;
        $task->description = $request->description;
        $task->date = $request->date;

        $img = $request->file('image');

        if($img != null){
            $file_route = time() . '_' . $img->getClientOriginalName();
            Storage::disk('imagesTasks')->put($file_route, \File::get($img));
            $task->image = $file_route;
        }else{
            $task->image = null;
        }

        $task->user_id = $request->user()->id;

        $task->save();

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

            $task = Task::find($request->task->id);

            $task->title = $request->title;
            $task->description = $request->description;
            $task->date = $request->date;

            $img = $request->file('image');

            if($img != null){
                $exists = Storage::disk('imagesTasks')->exists($task->image);
                if($exists){
                    Storage::disk('imagesTasks')->delete($task->image);
                }
                $file_route = time() . '_' . $img->getClientOriginalName();
                Storage::disk('imagesTasks')->put($file_route, \File::get($img));
                $task->image = $file_route;
            }

            $task->user_id = $request->user()->id;

            $task->save();
            return redirect('/tasks')->with('success', 'Task Edited');
        }else{
            $this->authorize('owner', $task);

            $task = Task::find($request->task->id);

            $task->title = $request->title;
            $task->description = $request->description;
            $task->date = $request->date;

            $img = $request->file('image');

            if($img != null){
                $exists = Storage::disk('imagesTasks')->exists($task->image);
                if($exists){
                    Storage::disk('imagesTasks')->delete($task->image);
                }
                $file_route = time() . '_' . $img->getClientOriginalName();
                Storage::disk('imagesTasks')->put($file_route, \File::get($img));
                $task->image = $file_route;
            }

            $task->user_id = $request->user()->id;

            $task->save();
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
            if($task->image != null){
                $exists = Storage::disk('imagesTasks')->exists($task->image);
                if($exists){
                    Storage::disk('imagesTasks')->delete($task->image);
                }
            }
            $task->delete();
            return redirect('/tasks')->with('success', 'Task Deleted');
        }else{
            $this->authorize('owner', $task);
            if($task->image != null){
                $exists = Storage::disk('imagesTasks')->exists($task->image);
                if($exists){
                    Storage::disk('imagesTasks')->delete($task->image);
                }
            }
            $task->delete();
            return redirect('/tasks')->with('success', 'Task Deleted');
        }
    }
}
