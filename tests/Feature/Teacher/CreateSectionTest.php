<?php

namespace Tests\Feature\Teacher;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class CreateSectionTest extends TestCase
{


    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::whereEmail('teacher01@example.com')->first();

        $this->course = $this->user->teaches;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_teacher_can_create_course_section()
    {
        $response = $this->actingAs($this->user)->post(route(
            'teacher.course.section.store',
            [
                'course' => $this->course,
            ]
        ), [
            'name' => 'Section 0101',
            'status' => 1
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('sections', [
            'name' => 'Section 0101',
            'status' => true
        ]);
    }
}
