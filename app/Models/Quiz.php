<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
 * @property string $start_date
 * @property int $duration
 * @property string|null $description
 * @property-read mixed $end_date
 * @property-read mixed $is_active
 * @property-read mixed $status
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quiz whereStartDate($value)
 */
class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'course_id', 'start_date', 'duration', 'description'];

    protected $appends = ['status', 'end_date', 'is_active'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(QuizStudent::class);
    }

    public function kcs(): HasManyThrough
    {
        return $this->hasManyThrough(KCQ::class, QuizQuestion::class, 'quiz_id', 'question_id');
    }

    public function getEndDateAttribute()
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = $startDate->addMinutes($this->duration);

        return $endDate;
    }

    public function getIsActiveAttribute()
    {
        if ($this->status == 'active') {
            return true;
        }

        return false;
    }

    public function getStatusAttribute()
    {
        if ($this->start_date > now()) {
            return 'upcoming';
        } elseif ($this->end_date < now()) {
            return 'closed';
        } else {
            return 'active';
        }
    }
}
