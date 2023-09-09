<?php

namespace App\Http\Controllers\Task;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Lists;
use App\Models\Task;

class TaskController extends Controller
{
    public function task_form()
    {

        $user_id = auth()->user()->id;

        $lists = Lists::where('user_id', $user_id)->get();

        $currentDate = Carbon::now()->toDateString();
        $all = Task::where('user_id', $user_id)->count();
        $countDate = Task::where('user_id', $user_id)
            ->where('date', $currentDate)
            ->count();

        $countTimeOrDate = Task::where('user_id', $user_id)
            ->where(function ($query) {
                $query->whereNotNull('date')
                    ->orWhereNotNull('time');
            })
            ->count();

        $countStarred = Task::where('user_id', $user_id)
            ->where('starred', 1)
            ->count();
        $lists = Lists::where('user_id', $user_id)->get();
        return view(
            'tasks.add_task',
            [
                'lists' => $lists,
                'list_id' => null,
                'planned' => $countTimeOrDate,
                'important'  => $countStarred,
                'today' => $countDate,
                'all' => $all
            ]
        );
    }

    public function store_task(Request $request)
    {
        if (!$request->has('list_id')) {
            $request->merge(['list_id' => null]);
        }
        if (!$request->has('starred')) {
            $request->merge(['starred' => 0]);
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'date' => 'nullable|date',
            'time' => 'nullable',
            'description' => 'nullable|string',
            'starred' => 'required',
            'user_id' => 'nullable',
            'list_id' => 'nullable'
        ]);

        Task::create([
            'title' => $validatedData['title'],
            'date' => $validatedData['date'],
            'description' => $validatedData['description'],
            'time' => $validatedData['time'],
            'starred' => $validatedData['starred'], // Use the value from validated data
            'user_id' => $validatedData['user_id'],
            'list_id' => $validatedData['list_id']
        ]);

        session()->flash('success', 'Task added successfully.');
        return redirect()->route('task_form');
    }

    public function get_task(Request $request)
    {
        $task_id = $request->input("task_id");
        $task = Task::where('task_id', $task_id)->get();

        return response()->json($task);
    }

    public function show_task()
    {
        $task_id = request("task_id");
        $tasks = Task::leftJoin('lists', 'lists.list_id', '=', 'tasks.list_id')
            ->where('tasks.task_id', $task_id)
            ->select('tasks.*', 'lists.name')
            ->get();
        $user_id = auth()->user()->id;

        $lists = Lists::where('user_id', $user_id)->get();

        $all = Task::where('user_id', $user_id)->count();
        $currentDate = Carbon::now()->toDateString();

        $countDate = Task::where('user_id', $user_id)
            ->where('date', $currentDate)
            ->count();

        $countTimeOrDate = Task::where('user_id', $user_id)
            ->where(function ($query) {
                $query->whereNotNull('date')
                    ->orWhereNotNull('time');
            })
            ->count();

        $countStarred = Task::where('user_id', $user_id)
            ->where('starred', 1)
            ->count();


        if ($tasks) {
            return view(
                'tasks.show_task',
                [
                    'lists' => $lists,
                    'tasks' => $tasks,
                    'today' => $countDate,
                    'planned' => $countTimeOrDate,
                    'important'  => $countStarred,
                    'all' => $all
                ]
            );
        } else {
            return redirect()->route('tasks.index')->with('error', 'Task not found.');
        }
    }

    public function update_star(Request $request)
    {
        // dd($request);
        $task_id = $request->input('task_id');
        $is_starred = $request->input('is_starred');

        Task::where('task_id', $task_id)->update(['starred' => $is_starred]);
    }

    public function update_done(Request $request)
    {
        $done = $request->input('done');
        $task_id = $request->input('task_id');
        Task::where('task_id', $task_id)->update(['done' => $done]);
    }

    public function destroy_task(Request $request)
    {
        $task_id = $request->input('task_id');
        $task = Task::find($task_id);
        if ($task) {
            // Delete the task
            $task->delete();
            return response()->json(['message' => 'Task deleted successfully']);
        }
        return response()->json(['message' => 'Task not found'], 404);
    }

    public function update_task(Request $request)
    {
        $task = $request->input('task_id');

        if (!$request->has('list_id')) {
            $request->merge(['list_id' => null]);
        }
        if (!$request->has('starred')) {
            $request->merge(['starred' => 0]);
        }

        $task = Task::find($request->task_id);
        if ($task) {
            $task->title = $request->input('title');
            $task->date = $request->input('date');
            $task->time = $request->input('time');
            $task->starred = $request->input('starred');
            $task->description = $request->input('description');
            $task->list_id = $request->input('list_id');
            $task->save();
            session()->flash('success', 'Task updated successfully.');
            return back();
        }
    }
}
