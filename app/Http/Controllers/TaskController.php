<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
    }

    public function update(Request $request)
    {
        $task = Task::findOrFail($request->taskId);
        $task->is_done = $request->status;
        $task->save();
        return ['success' => true];
    }

    public function create(Request $request)
    {
        $categories = Category::all();

        $data['categories'] = $categories;
        return view('tasks.create', $data);
    }

    public function create_action(Request $request)
    {
        $task = $request->only(['title', 'category_id', 'description', 'due_date']);
        $task['user_id'] = 1;
        $dbTask = Task::create($task);
        return redirect(route('home'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $task = Task::find($id);
        if (!$task) {
            return redirect(route('home'));
        }

        $categories = Category::all();

        $data['categories'] = $categories;

        $data['task'] = $task;

        return view('tasks.edit', $data);
    }

    public function edit_action(Request $request)
    {

        $request_data = $request->only(['title', 'due_date', 'category_id', 'description']);

        $request_data['is_done'] = $request->is_done ? true : false;

        // dd($request_data);

        $task = Task::find($request->id);

        if (!$task) {
            return 'Erro de Task não existente';
        }

        $task->update($request_data);
        $task->save();

        return redirect(route('home'));
    }

    public function delete(Request $request)
    {

        $id = $request->id;

        $task = Task::find($id);

        if ($task) {
            $task->delete();
        }

        // deleta e redireciona para a home
        return redirect(route('home'));
    }
}
