<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\QuizAnswer
 *
 * @property int $id
 * @property string $answer
 * @property int $right_answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $question_id
 * @property-read \App\Models\QuizQuestion $question
 * @method static \Database\Factories\QuizAnswerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizAnswer whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizAnswer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizAnswer whereRightAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizAnswer whereUpdatedAt($value)
 */
class QuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['answer', 'right_answer'];

    public function question(): BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class, 'question_id');
    }
}
