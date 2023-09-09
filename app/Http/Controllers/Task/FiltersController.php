<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\Lists;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FiltersController extends Controller
{
    protected function filtered_tasks($tasks, $search_count, $type)
    {
        if ($tasks->isEmpty()) {
            $viewContent = View::make('components.__empty_task', ['tasks' => $tasks])->render();
        } else {
            $viewContent = View::make('components.__task', ['tasks' => $tasks])->render();
        }

        return response()->json(['html' => $viewContent, 'search_count' => $search_count, 'type' => $type]);
    }

    public function finished_task()
    {
        $user_id = auth()->user()->id;
        $currentDate = Carbon::now()->toDateString();
        $tasks = Task::where('user_id', $user_id)
            ->where('done', 1)
            ->when(session('type') == 'important', function ($query){
                return $query->where('starred', 1);
            })
            ->when(session('type') == 'today', function($query) use ($currentDate) {
                return $query->where('date',  $currentDate);
            })
            ->when(session('type') == 'planned', function ($query){
                return $query->where(function ($query) {
                    $query->whereNotNull('date')
                        ->orWhereNotNull('time');
                });
            })
            ->get();

            $type = session('type');
            return $this->filtered_tasks($tasks, null, $type);
    }

    public function unfinished_task()
    {
        $user_id = auth()->user()->id;
        $currentDate = Carbon::now()->toDateString();
        $tasks = Task::where('user_id', $user_id)
            ->where('done', 0)
            ->when(session('type') == 'important', function ($query){
                return $query->where('starred', 1);
            })
            ->when(session('type') == 'today', function($query) use ($currentDate) {
                return $query->where('date',  $currentDate);
            })
            ->when(session('type') == 'planned', function ($query){
                return $query->where(function ($query) {
                    $query->whereNotNull('date')
                        ->orWhereNotNull('time');
                });
            })
            ->get();
        $type = session('type');
        return $this->filtered_tasks($tasks, null, $type);
    }

    public function search_task(Request $request)
    {
        $key = $request->input("search_key");
        $user_id = auth()->user()->id;

        $tasks = Task::where('title', 'like', '%' . $key . '%')
            ->where('user_id', $user_id)
            ->get();
        $count = Task::where('title', 'like', '%' . $key . '%')
            ->where('user_id', $user_id)
            ->count();
            
            $type = session('type');
            return $this->filtered_tasks($tasks, null, $type);
    }

    public function main_filter(Request $request)
    {
        $user_id = auth()->user()->id;
        $currentDate = Carbon::now()->toDateString();
        $filter = $request->input("filter");

        if ($filter == "today") {
            $tasks = Task::where('user_id', $user_id)
                ->where('date', $currentDate)
                ->get();
            session(['type' => $filter]);
            $type = session('type');
            return $this->filtered_tasks($tasks, null, $type);
        }
        if ($filter == "planned") {
            $tasks = Task::where('user_id', $user_id)
                ->where(function ($query) {
                    $query->whereNotNull('date')
                        ->orWhereNotNull('time');
                })
                ->get();
            session(['type' => $filter]);
            $type = session('type');
            return $this->filtered_tasks($tasks, null, $type);
        }
        if ($filter == "important") {
            $tasks = Task::where('user_id', $user_id)
                ->where('starred', 1)
                ->get();
            session(['type' => $filter]);
            $type = session('type');
            return $this->filtered_tasks($tasks, null, $type);
        }

        if($filter == "all"){
            $tasks = Task::where('user_id', $user_id)->get();
            session(['type' => $filter]);
            $type = session('type');
            return $this->filtered_tasks($tasks, null, $type);
        }
    }

    public function all_task(){
        $user_id = auth()->user()->id;
        $tasks = Task::where('user_id', $user_id)->get();

        $type = session('type');
        return $this->filtered_tasks($tasks, null, $type);
    }
}
