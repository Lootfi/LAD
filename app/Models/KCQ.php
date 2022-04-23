<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

// pivot table for many-to-many relationship between kcs and questions (kc_question)
class KCQ extends Pivot
{
    use HasFactory;

    protected $table = 'kc_questions';

    protected $fillable = [
        'kc_id',
        'question_id'
    ];

    public function kc(): BelongsTo
    {
        return $this->belongsTo(Kc::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
