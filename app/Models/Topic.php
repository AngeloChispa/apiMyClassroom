<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topic extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function subject(): BelongsTo{
        return $this->belongsTo(Subject::class);
    }
}
