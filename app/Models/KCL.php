<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class KCL extends Pivot
{
    protected $table = 'kc_lessons';

    protected $fillable = [
        'kc_id',
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
}
