<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    /**
     * Get all the roles assigned to the ability.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
