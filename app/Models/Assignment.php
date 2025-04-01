<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    protected $fillable = [
        'date',
        'grades',
        'status',
    ];

    public function resource(): BelongsTo{
        return $this->belongsTo(Resource::class);
    }
}
