<?php

namespace App\Models;

use Carbon\Carbon;
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

    //mutated attribute end_date is not present in the database table but we need it for the model to work properly
    protected $fillable = ['name', 'course_id', 'start_date', 'duration', 'description'];




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

    //quiz custom attribute: end_date, equals start_date + duration
    public function getEndDateAttribute()
    {
        //get carbon date from start_date
        $startDate = Carbon::parse($this->start_date);
        //add duration to start_date
        $endDate = $startDate->addMinutes($this->duration);
        //return end_date
        return $endDate;
    }

    //quiz custom attribute: is_active, equals end_date > now
    public function getIsActiveAttribute()
    {
        return $this->end_date > now();
    }

    //quiz custom attribute: status
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
