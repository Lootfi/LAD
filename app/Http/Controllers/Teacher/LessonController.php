<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonFile;
use App\Models\Section;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Session;
use Storage;

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
    public function create(Course $course, Section $section)
    {
        return view('teacher.lesson.create', compact('course', 'section'));
    }

    // store method
    public function store(Request $request, Course $course, Section $section)
    {

        $lesson = $section->lessons()->create($request->all());

        LessonFile::where([
            'session_id' => Session::getId(),
            'lesson_id' => null,
        ])->get()->each(function ($file) use ($lesson) {
            $file->update([
                'lesson_id' => $lesson->id,
            ]);
        });

        return redirect()->route('teacher.course.show', $course)->with('success', 'Lesson created successfully');
    }

    // edit method
    public function edit(Course $course, Section $section, Lesson $lesson)
    {
        return view('teacher.lesson.edit', compact('course', 'section', 'lesson'));
    }

    // update method
    public function update(Request $request, Course $course, Section $section, Lesson $lesson)
    {

        $lesson->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'content' => $request->content,
        ]);

        LessonFile::where([
            'session_id' => Session::getId(),
            'lesson_id' => null,
        ])->get()->each(function ($file) use ($lesson) {
            $new_path = asset('storage/lessons/' . $lesson->id . '/' . $file->file_name);
            Storage::move($file->path, $new_path);
            $file->update([
                'lesson_id' => $lesson->id,
                'path' => $new_path,
            ]);
        });

        return redirect()->route('teacher.course.section.lesson.show', ['course' => $course, 'section' => $section, 'lesson' => $lesson])->with('success', 'Lesson updated successfully');
    }

    // destroy method
    public function destroy(Course $course, Section $section, Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('teacher.course.show', $course)->with('success', 'Lesson deleted successfully');
    }

    public function notify(Course $course, Section $section, Lesson $lesson)
    {
        $students = $course->students;

        foreach ($students as $student) {
            $student->notify(new \App\Notifications\NewLesson($lesson->load('section.course')));
        }

        return redirect()->route('teacher.course.section.show', compact('course', 'section'))->with('success', 'Students have been notified about new lesson!');
    }

    public function upload(Request $request)
    {
        $section = Section::whereId($request->section_id)->first();

        if ($request->hasFile('file')) {
            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File temporarly until lesson is created or updated
            $request->file('file')->storeAs('public/temp/' . Session::getId(), $filenametostore);
            //path to file
            $path = asset('storage/temp/' . Session::getId() . '/' . $filenametostore);
            //create lesson file
            LessonFile::create([
                'path' => $path,
                'file_name' => $filenametostore,
                'session_id' => Session::getId(),
                'lesson_id' => $request->lesson_id == "create" ? null : $request->lesson_id,
            ]);

            return response()->json(['url' => $path, 'href' => $path . "?content-disposition=attachment"]);
        }
    }
}
