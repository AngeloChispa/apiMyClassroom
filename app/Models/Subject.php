<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'description',
        'grade',
        'career_id'
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
        return $this->belongsToMany(User::class)->withPivot('user_id','subject_id');
    }

    public function resources(): HasManyThrough{
        return $this->hasManyThrough(Resource::class, Topic::class);
    }
}
