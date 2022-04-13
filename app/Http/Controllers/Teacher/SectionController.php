<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index(Course $course)
    {
        $course->load('sections');

        return view('teacher.section.index', compact('course'));
    }

    public function show(Course $course, Section $section)
    {
        return view('teacher.section.show', compact('section', 'course'));
    }


    public function create(Course $course)
    {
        return view('teacher.section.create', compact('course'));
    }

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

    public function edit(Course $course, Section $section)
    {
        return view('teacher.section.edit', compact('course', 'section'));
    }

    public function update(Request $request, Course $course, Section $section)
    {
        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:255',
            'status' => 'required|boolean',
        ]);

        $section->update($request->all());

        return redirect()->route('teacher.course.show', $course)->with('success', 'Section updated successfully');
    }

    public function destroy(Course $course, Section $section)
    {
        $section->delete();

        return redirect()->route('teacher.course.show', $course)->with('success', 'Section deleted successfully');
    }
}
