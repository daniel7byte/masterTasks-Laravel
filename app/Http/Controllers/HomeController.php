<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $tasks;

    public function __construct(TaskRepository $task)
    {
        // $this->middleware('auth');
        $this->tasks = $task;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/tasks', 301);
    }

    public function news()
    {
        return view('news', [
            'tasks' => $this->tasks->forTasksNews()
        ]);
    }
}
