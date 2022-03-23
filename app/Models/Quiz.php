<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Quiz
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $course_id
 * @property-read \App\Models\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuizQuestion[] $questions
 * @property-read int|null $questions_count
 * @method static \Database\Factories\QuizFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
