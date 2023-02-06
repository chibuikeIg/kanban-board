<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{
    public function store(Request $request) {

        $data= $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'description'=> ['required', 'string'],
            'board_id' => ['integer', 'exists:App\Models\Board,id']
        ]);

        Card::create($data);

        return response()->json(['message'=>'Created']);
    }

    public function update(Request $request, Card $card) {

        $data = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'description'=> ['required', 'string'],
        ]);

        $card->update($data);
        $card->refresh();

        return response()->json(['message'=>'Updated']);
    }
}
