<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;


    /**
     * The events that belong to the attendee.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
