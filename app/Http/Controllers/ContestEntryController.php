<?php

namespace App\Http\Controllers;

use App\Events\NewEntryRecievedEvent;
use App\Models\ContestEntry;
use Illuminate\Http\Request;

class ContestEntryController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'email' => 'required|email'
        ]);

        ContestEntry::create($data);

        // event(NewEntryRecievedEvent::class);
        // NewEntryRecievedEvent::dispatch();
        // another method, which we are actually using,
        // is in the ContestEntry model

        return response()->json([ "message" => "stored" ]);
    }
}
