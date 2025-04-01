<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Resource extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function files():HasMany{
        return $this->hasMany(File::class);
    }

    public function assignment(): HasOne{
        return $this->hasOne(Assignment::class);
    }

    public function notice(): BelongsTo{
        return $this->belongsTo(Notice::class);
    }

    public function subject():HasOneThrough {
        return $this->hasOneThrough(Subject::class, Topic::class);
    }
}
