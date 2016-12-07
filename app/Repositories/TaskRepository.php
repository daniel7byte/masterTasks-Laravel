<?php

namespace App\Repositories;

use App\User;
use App\Task;

class TaskRepository
{
    public function forTasks(User $user)
    {
        if($user->role === "ADMIN"){
            return Task::all();
        }else{
            return Task::where('user_id', $user->id)
                ->orderBy('created_at', 'des')
                ->get();
        }
    }

    public function forUser(User $user)
    {
        return User::where('id', $user->id)
            ->get();
    }
}
