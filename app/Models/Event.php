<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    const MODE_ONLINE = 'online';
    const MODE_ONSITE = 'onsite';
    const MODE_HYBRID = 'hybrid';

    const ACCESS_PUBLIC = 'public';
    const ACCESS_RESTRICTED = 'restricted';

    /**
     * The attendees that belong to the event.
     */
    public function attendees()
    {
        return $this->hasMany(EventAttendee::class);
    }

    /**
     * The schedule sessions that belongs to the event.
     */
    public function scheduleSessions()
    {
        return $this->hasMany(ScheduleSession::class);
    }
}
