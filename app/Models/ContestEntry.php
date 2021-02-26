<?php

namespace App\Models;

use App\Events\NewEntryRecievedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestEntry extends Model
{
    use HasFactory;

    protected $guarded = [];

    // this method runs when the model is booted, we are overwriting it
    protected static function booted() {

        // when the model is created, Laravel fires created event by default,
        // we can access it and fire out our own event
        static::created(function ($contestEntry) {
            NewEntryRecievedEvent::dispatch($contestEntry);
        });
    }
}
