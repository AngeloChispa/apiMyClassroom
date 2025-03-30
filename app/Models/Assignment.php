<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Assignment extends Model
{
    protected $fillable = [
        'date',
        'grades',
        'status',
    ];

    public function resource(): HasOne{
        return $this->hasOne(Resource::class);
    }
}
