<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Kc;
use App\Models\KCL;
use App\Models\Lesson;
use App\Models\LessonFile;
use App\Models\Section;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Session;
use Storage;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        $course->load('sections.lessons');

        return view('teacher.lesson.index', compact('course'));
    }

    public function show(Course $course, Section $section, Lesson $lesson)
    {
        return view('teacher.lesson.show', compact('lesson', 'section', 'course'));
    }

    public function create(Course $course, Section $section)
    {
        $course->load('kcs');
        return view('teacher.lesson.create', compact('course', 'section'));
    }

    // store method
    public function store(Request $request, Course $course, Section $section)
    {

        $lesson = $section->lessons()->create($request->all());

        if ($request->kcs) {
            foreach ($request->kcs as $kc) {
                KCL::query()
                    ->create([
                        'lesson_id' => $lesson->id,
                        'kc_id' => $kc,
                    ]);
            }
        }

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

        $kc_id_array_dirty = $lesson->kcls()->get(['kc_id'])->toArray();
        $kc_ids = [];

        foreach ($kc_id_array_dirty as $kcl) {
            $kc_ids[] = $kcl['kc_id'];
        }
        $kc_rest = Kc::whereNotIn('id', $kc_ids)->get();

        $lesson->load('kcls.kc');

        return view('teacher.lesson.edit', compact('course', 'section', 'lesson', 'kc_rest'));
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


        //kcs
        $kcls = $lesson->kcls;

        //if l_kcs array is empty, delete all kcqs
        if (empty($request->l_kcs)) {
            $kcls->each(function ($kcl) {
                KCL::query()
                    ->where('kc_id', $kcl->kc_id)
                    ->where('lesson_id', $kcl->lesson_id)
                    ->delete();
            });
        } else {
            // find if user deleted kcqs
            $kcls->each(function ($kcl) use ($request) {
                if (!in_array($kcl->kc_id, $request->get("l_kcs"))) {
                    KCL::query()
                        ->where('kc_id', $kcl->kc_id)
                        ->where('lesson_id', $kcl->lesson_id)
                        ->delete();
                }
            });

            // find if user added kcqs
            foreach ($request->get('l_kcs') as $kc_id) {
                if (!$lesson->kcls->contains('kc_id', $kc_id)) {
                    KCL::query()
                        ->create([
                            'lesson_id' => $lesson->id,
                            'kc_id' => $kc_id,
                        ]);
                }
            }
        }



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

        return redirect()->route('teacher.course.section.lesson.edit', ['course' => $course, 'section' => $section, 'lesson' => $lesson])->with('success', 'Lesson updated successfully');
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
