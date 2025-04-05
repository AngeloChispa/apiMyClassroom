<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function subject(): BelongsTo{
        return $this->belongsTo(Subject::class);
    }

    public function resources(): HasMany{
        return $this->hasMany(Resource::class);
    }
}
