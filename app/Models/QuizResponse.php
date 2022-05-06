<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\QuizResponse
 *
 * @property int $question_id
 * @property int $student_id
 * @property int $answer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\QuizAnswer $answer
 * @property-read \App\Models\QuizQuestion $question
 * @property-read \App\Models\User $student
 * @method static \Illuminate\Database\Eloquent\Builder|QuizResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizResponse whereAnswerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizResponse whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizResponse whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizResponse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QuizResponse extends Pivot
{
    use LogsActivity, HasFactory;

    public $incrementing = true;

    protected static $recordEvents = ['created'];

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['student_id', 'question_id', 'answer_id'])
            ->useLogName('student.question.response')
            ->setDescriptionForEvent(fn (string $eventName) => "Student responded to question");
    }
}
