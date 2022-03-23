<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory;

    function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    function questions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class);
    }

//    function students(): HasMany
//    {
//        return $this->hasManyThrough(User::class, Course::class, '');
//    }
}
