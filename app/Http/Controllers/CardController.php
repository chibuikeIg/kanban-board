<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', 'boolean'],
            'board_id' => ['integer', 'exists:App\Models\Board,id'],
        ]);

        Card::create($data);

        return response()->json(['message' => 'Created']);
    }

    public function update(Request $request, Card $card)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        $card->update($data);
        $card->refresh();

        return response()->json(['message' => 'Updated']);
    }

    public function updateAll(Request $request)
    {
        foreach ($request->cards as $card) {
            Card::where('id', $card['id'])->update([
                'board_id' => $card['board_id'],
                'order' => $card['order'],
            ]);
        }

        return response()->json(['message' => 'Updated All']);
    }

    public function destroy(Card $card)
    {
        $card->update([
            'status' => false,
            'deleted_at' => now(),
        ]);

        $card->refresh();

        return response()->json(['message' => 'Deleted']);
    }
}
