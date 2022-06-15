<?php

namespace Tests\Feature\Student;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ViewCourseTest extends TestCase
{

    use RefreshDatabase;

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

        $this->course = Course::factory()->create([
            'teacher_id' => $teacher->id
        ]);

        $this->sections = Section::factory(3)->create([
            'course_id' => $this->course->id
        ]);

        CourseStudent::create([
            'course_id' => $this->course->id,
            'student_id' => $this->user->id
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_student_can_see_his_course()
    {
        $response = $this->actingAs($this->user)->get(route('student.course.show', ['course' => $this->course]));

        $response->assertStatus(200)
            ->assertSee($this->course->title);

        foreach ($this->sections as $section) {
            $response->assertSee($section->name);
        }
    }
}
