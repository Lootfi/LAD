<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 */
class QuizStudent extends Model
{
    use HasFactory;

    protected $table = 'quiz_students';
    public $timestamps = false;

    protected $fillable = [
        'quiz_id',
        'student_id',
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
}
