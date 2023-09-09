<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class __task extends Component
{
    public function render()
    {
        $user = auth()->user();
        $tasks = $user->tasks; // Assuming tasks are associated with the User model

        return view('components.__task', ['tasks' => $tasks]);
    }
}
