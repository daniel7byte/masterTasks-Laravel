<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function owner(User $user, Task $task)
    {
        if($user->role === "ADMIN"){
            return true;
        }else{
            return $user->id === $task->user_id;
        }
    }
}
