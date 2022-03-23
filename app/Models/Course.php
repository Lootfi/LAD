<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Post
 *
 * @mixin Builder
 */
class Course extends Model
{
    use HasFactory;

    function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            CourseStudent::class,
            'course_id',
            'student_id'
        );
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }
}
