<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;

class APIController extends Controller
{
    public function tasks(){
        header('Content-Type: application/json');
        return Task::all()->toJson();
    }

    public function users(){
        header('Content-Type: application/json');
        return User::all()->toJson();
    }
}
