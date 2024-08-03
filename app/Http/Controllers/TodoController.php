<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return response()->json(Todo::get());
    }


    public function createfun(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $todo = Todo::create([
            'name' => $request->input('name')
        ]);
        return response()->json($todo);
    }

    public function updatefun(Request $request,Todo $todo){
        $todo->update($request->all());
        return response()->json($todo);
    }

    public function destroyfun(Todo $todo)
    {
        $todo->delete();
        return response()->json(['message' => 'success']);
    }
}
