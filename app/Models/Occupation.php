<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Occupation extends Model
{
    protected $fillable = ['code', 'title'];

    public function skills(): HasMany
    {
        return $this->hasMany(OccupationSkill::class);
    }

    public function importanceBySlug(): array
    {
        return $this->skills()->pluck('importance', 'core_skill_slug')->all();
    }
}
