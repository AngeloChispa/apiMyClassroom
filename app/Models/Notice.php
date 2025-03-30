<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notice extends Model
{
    protected $fillable = [
        'message',
        'date',
    ];

    public function subject(): BelongsTo{
        return $this->belongsTo(Subject::class);
    }

    public function files():HasMany{
        return $this->hasMany(File::class);
    }
}
