<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleSession extends Model
{
    use HasFactory;

    /**
     * The event the session belongs to.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
