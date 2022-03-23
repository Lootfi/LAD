<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CourseStudent
 *
 * @property int $course_id
 * @property int $student_id
 * @method static \Database\Factories\CourseStudentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseStudent whereStudentId($value)
 * @mixin \Eloquent
 */
class CourseStudent extends Model
{
    use HasFactory;
}
