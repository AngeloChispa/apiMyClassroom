<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    protected $fillable = [
        'path',
    ];

    public function notice(): BelongsTo{
        return $this->belongsTo(Notice::class);
    }

    public function resource(): BelongsTo{
        return $this->belongsTo(Resource::class);
    }

}
