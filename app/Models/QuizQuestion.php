<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * App\Models\QuizQuestion
 *
 * @property int $id
 * @property string $question
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $quiz_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuizAnswer[] $answers
 * @property-read int|null $answers_count
 * @property-read \App\Models\Quiz $quiz
 * @method static \Database\Factories\QuizQuestionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizQuestion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QuizQuestion extends Model
{
    use HasFactory;

    function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    function answers(): HasMany
    {
        return $this->hasMany(QuizAnswer::class, 'question_id');
    }
}
