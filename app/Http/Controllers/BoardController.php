<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class BoardController extends Controller
{
    public function index() {

        return response()->json(Board::get()->toArray());

    }

    public function store(Request $request) {

        $data = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255']
        ]);

        $board = Board::create($data);

        return response()->json($board);
    }
}