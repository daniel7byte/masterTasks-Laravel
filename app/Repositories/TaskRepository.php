<?php

namespace App\Repositories;

use App\User;
use App\Task;

class TaskRepository
{
    public function forUser(User $user)
    {
        if($user->role === "ADMIN"){
            return Task::all();
        }else{
            return Task::where('user_id', $user->id)
                ->orderBy('created_at', 'des')
                ->get();
        }
    }
}