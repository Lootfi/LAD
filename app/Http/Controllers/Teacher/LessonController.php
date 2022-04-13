<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    // index method
    public function index(Course $course)
    {
        $course->load('sections.lessons');

        return view('teacher.lesson.index', compact('course'));
    }

    // show method
    public function show(Course $course, Section $section, Lesson $lesson)
    {
        return view('teacher.lesson.show', compact('lesson', 'section', 'course'));
    }

    // create method
    public function create(Course $course)
    {
        return view('teacher.lesson.create', compact('course'));
    }

    // store method
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:255',
            'status' => 'required|boolean',
        ]);

        $course->sections()->create($request->all());

        return redirect()->route('teacher.course.show', $course)->with('success', 'Section created successfully');
    }

    // edit method
    public function edit(Course $course, Section $section, Lesson $lesson)
    {
        return view('teacher.lesson.edit', compact('course', 'section', 'lesson'));
    }

    // update method
    public function update(Request $request, Course $course, Section $section, Lesson $lesson)
    {
        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:255',
            'status' => 'required|boolean',
        ]);

        $lesson->update($request->all());

        return redirect()->route('teacher.course.show', $course)->with('success', 'Section updated successfully');
    }

    // destroy method
    public function destroy(Course $course, Section $section, Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('teacher.course.show', $course)->with('success', 'Section deleted successfully');
    }

    public function notify(Course $course, Section $section, Lesson $lesson)
    {
        $students = $course->students;

        foreach ($students as $student) {
            $student->notify(new \App\Notifications\NewLesson($lesson->load('section.course')));
        }

        return redirect()->route('teacher.course.section.show', compact('course', 'section'))->with('success', 'Students have been notified about new lesson!');
    }
}
