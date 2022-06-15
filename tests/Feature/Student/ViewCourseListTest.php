<?php

namespace Tests\Feature\Student;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ViewCourseListTest extends TestCase
{

    public $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->where('email', 'student01@example.com')->first();

        $this->teacher = User::query()->where('email', 'teacher01@example.com')->first();

        $this->courses = $this->user->courses;
    }

    /**
     * @return void
     */
    public function test_student_can_see_list_of_his_courses()
    {
        $response = $this->actingAs($this->user)->get(route('student.course.index'));

        $response->assertstatus(200);

        $response->assertSee('My Courses');

        foreach ($this->courses as $course) {
            $response->assertSee($course->title);
        }
    }
}
