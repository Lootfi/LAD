<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class QuizResponse extends Pivot
{
    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function answer()
    {
        return $this->belongsTo(QuizAnswer::class, 'answer_id');
    }

    public function question()
    {
        return $this->belongsTo(QuizQuestion::class, 'question_id');
    }
}
