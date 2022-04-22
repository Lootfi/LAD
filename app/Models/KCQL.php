<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

// pivot table for many-to-many relationship between kcs and lessons and questions (kc_question_lesson)
class KCQL extends Pivot
{
    use HasFactory;

    protected $table = 'kc_question_lesson';
    protected $fillable = [
        'kc_id',
        'quiz_id',
        'lesson_id',
    ];

    public function kc(): BelongsTo
    {
        return $this->belongsTo(Kc::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
