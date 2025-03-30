<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resource extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function files():HasMany{
        return $this->hasMany(File::class);
    }

    public function assignment(): BelongsTo{
        return $this->belongsTo(Assignment::class);
    }
}
