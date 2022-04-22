<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kc extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'course_id',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lesson(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class);
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(QuizQuestion::class);
    }
}
