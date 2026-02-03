<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Muestra la lista de tareas para el usuario autenticado
    public function index(Request $request)
    {
        $user = $request->user();
        $tasks = Task::with('user')->latest()->get();
        return view('tasks.index', compact('tasks', 'user'));
    }

    // Crea una nueva tarea para el usuario autenticado
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:120',
            'body' => 'nullable|string|max:500',
        ]);
        Task::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'body' => $request->body,
            'done' => false,
        ]);
        return redirect()->route('tasks.index');
    }

    // Marca una tarea como hecha si el usuario tiene permiso
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        if (!$task->done) {
            $task->done = true;
            $task->save();
        }
        return redirect()->route('tasks.index');
    }

    // Elimina una tarea si el usuario tiene permiso
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
