<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ROLE_OWNER = 'owner';
    const ROLE_MANAGER = 'manager';

    /**
     * Get all the abilities of the role.
     */
    public function abilities()
    {
        return $this->belongsToMany(Ability::class);
    }

    /**
     * Allow an ability to the role.
     */
    public function allowTo($ability)
    {
        $this->abilities()->sync($ability, false);
    }
}
