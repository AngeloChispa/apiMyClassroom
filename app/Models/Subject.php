<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'description',
        'grade',
    ];

    public function career(): BelongsTo{
        return $this->belongsTo(Career::class);
    }

    public function topics(): HasMany{
        return $this->hasMany(Topic::class);
    }

    public function notices(): HasMany{
        return $this->hasMany(Notice::class);
    }

    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }
}
