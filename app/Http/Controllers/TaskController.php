<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use Facade\Ignition\Tabs\Tab;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Auth::user()->Task()->orderByDesc('created_at')->get();
        $currentTime = Carbon::now()->addHours(2);
        return view('tasks.index', compact('tasks', 'currentTime'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'date_due' => ['required', 'date']
        ]);

        if ($validator->fails()) {
            return redirect()->route('task.index')->withErrors($validator);
        }

        $task = Auth::user()->Task()->create($request->all());

        return redirect()->route('task.show', $task->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if ($task->user_id == Auth::user()->id) {
            $currentTime = Carbon::now()->addHours(2);
            return view('tasks.show', compact('task', 'currentTime'));
        }
        return redirect()->route('task.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id == Auth::user()->id) {
            $validator = Validator::make($request->all(), [
                'name' => ['nullable', 'title', 'string', 'min:3', 'max:255'],
                'description' => ['nullable', 'string', 'min:3', 'max:255'],
                'date_due' => ['nullable', 'date'],
                'finished' => ['nullable', 'numeric', 'min:0', 'max:1']
            ]);

            if ($validator->fails()) {
                return redirect()->route('task.show', $task->id)->withErrors($validator);
            }
            $task->update($request->all());
            return redirect()->route('task.show', $task->id);
        }
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if ($task->user_id == Auth::user()->id) {
            $task->delete();
            return redirect()->route('task.index');
        }
        return redirect()->route('task.index');
    }
}
