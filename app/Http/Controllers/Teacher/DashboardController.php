<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:teacher');
    }

    public function index()
    {
        $teacher = auth()->user();

        return view('teacher.dashboard', ['course' => $teacher->teaches]);
    }
}
