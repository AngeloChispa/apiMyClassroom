<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class)->withPivot('id','status', 'user_id', 'grades', 'graded','limit');
    }
}
