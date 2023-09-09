<?php

namespace App\Http\Controllers\List;

use App\Models\Lists;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ListController extends Controller
{
    public function store_list(Request $request)
    {
        $validatedData = $request->validate([
            'inputData' => 'required|string',
            'user_id' => 'required'
        ]);
        $newlist = Lists::create([
            'name' => $validatedData['inputData'],
            'user_id' => $validatedData['user_id']
        ]);
        $insertedId = $newlist->list_id;

        $list = Lists::where('list_id', $insertedId)->get();
        $viewContent = View::make('components.__list', ['lists' => $list])->render();

        return response()->json([
            'message' => 'List created successfully',
            'html' => $viewContent
        ]);
    }

    public function destroy_list(Request $request)
    {
        $list_id = $request->input("list_id");
        $list = Lists::find($list_id);
        if ($list) {
            $list->delete();
            return response()->json(['message' => 'List destroyed successfully']);
        }
        return response()->json(['message' => 'Task not found'], 404);
    }

    public function show_list()
    {
        $list_id = request("list_id");
        $name = request('name');

        $tasks = Task::where('list_id', $list_id)->get();
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


        return view('lists.list', 
                                [
                                    'tasks' => $tasks, 
                                    'name' => $name, 
                                    'lists' => $lists, 
                                    'list_id' => $list_id, 
                                    'today' => $countDate,
                                    'planned' => $countTimeOrDate,
                                    'important'  => $countStarred,
                                    'all' => $all
                                ]);
    }

    public function update_list_name(Request $request)
    {
        $list_name = $request->name;
        $list_id = $request->list_id;
        $list = Lists::find($list_id);
        if ($list) {
            $list->name = $list_name;
            $list->save();
            session()->flash('success', 'List name updated successfully.');
            return back();
        } else {
            session()->flash('error', 'An error occured.');
            return back();
        }
    }

    public function lists(){
        $user_id = auth()->user()->id;
        $lists = Lists::where('user_id', $user_id)->get();
        return view('lists.mobile_lists', ['lists' => $lists]);
    }
}
