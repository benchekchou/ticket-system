<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class ReplyController extends Controller
{
    // app/Http/Controllers/ReplyController.php
public function store(Request $request, Ticket $ticket) {
    $this->authorize('reply', $ticket);

    $data = $request->validate(['message' => 'required|string']);

    $reply = $ticket->replies()->create([
        'user_id' => $request->user()->id,
        'message' => $data['message']
    ]);

    return response()->json($reply, 201);
}
    //
}
