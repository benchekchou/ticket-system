<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
   // app/Http/Controllers/TicketController.php
public function index(Request $request) {
    $query = $request->user()->is_admin 
        ? Ticket::query()
        : $request->user()->tickets();

    if ($status = $request->query('status')) {
        $query->where('status', $status);
    }

    return $query->with('replies.user')->get();
}

public function store(Request $request) {
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'message' => 'required|string'
    ]);

    $ticket = $request->user()->tickets()->create([
        'title' => $data['title'],
        'status' => 'open'
    ]);

    $ticket->replies()->create([
        'user_id' => $request->user()->id,
        'message' => $data['message']
    ]);

    return response()->json($ticket, 201);
}

public function updateStatus(Request $request, Ticket $ticket) {
    $this->authorize('updateStatus', $ticket);

    $data = $request->validate(['status' => 'required|in:open,closed']);
    $ticket->update($data);

    return response()->json($ticket);
}
}
