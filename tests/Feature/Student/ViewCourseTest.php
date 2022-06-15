<?php

namespace Tests\Feature\Student;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ViewCourseTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::query()->where('email', 'student01@example.com')->first();

        $this->course = Course::all()->first();

        $this->sections = $this->course->sections;
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
