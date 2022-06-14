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

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            CourseStudent::class,
            'course_id',
            'student_id'
        );
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(
            Lesson::class,
            KCL::class,
            'kc_id',
            'lesson_id'
        );
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(
            QuizQuestion::class,
            KCQ::class,
            'kc_id',
            'question_id'
        );
    }
}
