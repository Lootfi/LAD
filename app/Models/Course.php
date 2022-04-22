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
 * @property int $id
 * @property string $title
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $teacher_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Quiz[] $quizzes
 * @property-read int|null $quizzes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $students
 * @property-read int|null $students_count
 * @property-read \App\Models\User $teacher
 * @method static \Database\Factories\CourseFactory factory(...$parameters)
 * @method static Builder|Course newModelQuery()
 * @method static Builder|Course newQuery()
 * @method static Builder|Course query()
 * @method static Builder|Course whereActive($value)
 * @method static Builder|Course whereCreatedAt($value)
 * @method static Builder|Course whereId($value)
 * @method static Builder|Course whereTeacherId($value)
 * @method static Builder|Course whereTitle($value)
 * @method static Builder|Course whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Section[] $sections
 * @property-read int|null $sections_count
 */
class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'active', 'teacher_id'];

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

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function kcs(): HasMany
    {
        return $this->hasMany(KnowledgeComponent::class);
    }
}
