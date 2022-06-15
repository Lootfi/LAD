<?php

namespace Tests\Feature\Student;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ViewCourseListTest extends TestCase
{

    use RefreshDatabase;

    public $user;

    public function setUp(): void
    {
        parent::setUp();

        $student = Role::create(['name' => 'student']);

        $this->user = User::factory()->create([
            'name' => 'Pamela',
            'email' => 'student01@example.com',
        ]);

        $this->user->assignRole($student);

        $teacherRole = Role::create(['name' => 'teacher']);
        $teacher = User::factory()->create([
            'name' => 'Mohammed Mahrez',
            'email' => 'teacher01@example.com',
        ]);
        $teacher->assignRole($teacherRole);

        $this->courses = Course::factory(2)->create([
            'teacher_id' => $teacher->id
        ])->each(function (Course $course) {
            CourseStudent::create([
                'course_id' => $course->id,
                'student_id' => $this->user->id
            ]);
        });
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
