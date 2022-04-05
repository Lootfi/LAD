<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    // show create section form
    public function create(Course $course)
    {
        return view('teacher.section.create', compact('course'));
    }
}
