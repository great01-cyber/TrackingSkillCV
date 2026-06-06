<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OccupationSkill extends Model
{
    protected $table = 'occupation_skill';

    protected $fillable = ['occupation_id', 'core_skill_slug', 'importance'];

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }
}
