<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\QuizStudents
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\QuizStudentsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizStudents newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizStudents newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizStudents query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuizStudents whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizStudents whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizStudents whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $quiz_id
 * @property int $student_id
 * @method static \Illuminate\Database\Eloquent\Builder|QuizStudents whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizStudents whereStudentId($value)
 * @property int $submitted
 * @property string $submitted_at
 * @property-read \App\Models\Quiz $quiz
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuizResponse[] $responses
 * @property-read int|null $responses_count
 * @property-read \App\Models\User $student
 * @method static \Illuminate\Database\Eloquent\Builder|QuizStudent whereSubmitted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuizStudent whereSubmittedAt($value)
 */
class QuizStudent extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'quiz_students';

    protected static $recordEvents = ['created'];

    protected $fillable = [
        'quiz_id',
        'student_id',
        'submitted',
        'submitted_at',
        'score',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->hasMany(QuizResponse::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['quiz_id', 'student_id', 'submitted'])
            ->useLogName('student.quiz.start')
            ->setDescriptionForEvent(fn () => 'Student started quiz');
    }
}
