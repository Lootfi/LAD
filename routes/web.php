<?php

use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\StudentController as TeacherStudentController;
use App\Http\Controllers\Teacher\QuizController as TeacherQuizController;
use App\Http\Controllers\Teacher\QuizQuestionController as TeacherQuizQuestionController;
use App\Http\Controllers\Teacher\QuizAnswerController as TeacherQuizAnswerController;
use App\Http\Controllers\Teacher\SectionController as TeacherSectionController;
use App\Http\Controllers\Teacher\LessonController as TeacherLessonController;
use App\Http\Controllers\Teacher\KCController as TeacherKCController;

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\SectionController as StudentSectionController;
use App\Http\Controllers\Student\LessonController as StudentLessonController;
use App\Http\Controllers\Student\QuizController as StudentQuizController;
use App\Http\Controllers\Student\NotificationController as StudentNotificationController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/help', function () {
    return view('help');
})->name('help');


Auth::routes(['register' => false]);

Route::prefix('password')
->name('password.')
->middleware(['auth'])
->group(function () {
    Route::get('change', [
        PasswordController::class,
        'show'
    ])->name('change.show');

    Route::post('update', [
        PasswordController::class,
        'update'
    ])->name('update');
    
});

Route::get('/', function () {
    $user = User::find(auth()->id());
    if (!$user) {
        return redirect()->route('login');
    } elseif ($user->hasRole('teacher')) {
        return redirect()->route('teacher.course.show', ['course' => $user->teaches]);
    } elseif ($user->hasRole('student')) {
        return redirect()->route('student.course.index');
    }
});

Route::get('/home', function () {
    $user = User::find(auth()->id());
    if (!$user) {
        return redirect()->route('login');
    } elseif ($user->hasRole('teacher')) {
        return redirect()->route('teacher.course.show', ['course' => $user->teaches]);
    } elseif ($user->hasRole('student')) {
        return redirect()->route('student.course.index');
    }
})->name('home');

Route::post('/upload', [TeacherLessonController::class, 'upload'])->middleware('role:teacher');

//teacher dashboard routes, with auth middleware


Route::prefix('teacher')
    ->name('teacher.')
    ->middleware(['auth', 'role:teacher'])
    ->scopeBindings()
    ->group(function () {
        Route::get('dashboard', [
            TeacherDashboardController::class,
            'index',
        ])->name('dashboard');

        /*
        *
        * Course Resource Routes
        *
        */


        Route::resource('course', TeacherCourseController::class);

        /*
        *
        * Course Knowledge Components
        *
        */

        Route::get('course/{course}/kc/manage', [
            TeacherKCController::class,
            'manage',
        ])->name('kc.manage'); // substitute for create and edit pages
        Route::get('course/{course}/kc/{kc}/split', [
            TeacherKCController::class,
            'split',
        ])->name('kc.split');
        Route::resource('course.kc', TeacherKCController::class)->except(['create', 'edit']);


        /*
        *
        * Course Section Routes
        *
        */

        Route::resource('course.section', TeacherSectionController::class);

        /*
        *
        * Course Section Lessons Routes
        *
        */

        Route::get('course/{course}/section/{section}/lesson/{lesson}/notify', [
            TeacherLessonController::class,
            'notify',
        ])->name('course.section.lesson.notify');

        // Route::put('course/{course}/section/{section}/lesson/{lesson}/update-content', [
        //     TeacherLessonController::class,
        //     'updateContent',
        // ])->name('course.section.lesson.update-content');

        Route::resource('course.section.lesson', TeacherLessonController::class);



        /*
        *
        * Course Quiz Routes
        */

        Route::get('course/{course}/quiz/{quiz}/notify', [
            TeacherQuizController::class,
            'notify',
        ])->name('quiz.notify');

        // monitor quiz page
        Route::get('course/{course}/quiz/{quiz}/monitor', [
            TeacherQuizController::class,
            'monitor',
        ])->name('quiz.monitor');



        Route::get('course/{course}/quiz/{quiz}/sort', [
            TeacherQuizController::class,
            'sort',
        ])->name('quiz.sort');

        Route::resource('course/{course}/quiz', TeacherQuizController::class);




        /*
        *
        * Quiz Question Routes
        *
        */

        Route::resource('quiz/{quiz}/question', TeacherQuizQuestionController::class);


        /*
        *
        * Quiz Answers Routes
        */

        Route::resource('quiz/{quiz}/question/{question}/answer', TeacherQuizAnswerController::class);


        /*
        *
        * Teacher Students Routes
        */

        Route::get('course/{course}/student/import', [TeacherStudentController::class, 'import'])
        ->name('student.import');
        
        Route::get('course/{course}/student', [TeacherStudentController::class, 'manage'])
        ->name('student.manage');


    });



// send a custom message to the monitored student
Route::get('teacher/course/{course}/quiz/{quiz}/monitor/{student}/message', [
    TeacherQuizController::class,
    'message',
])->name('teacher.quiz.monitor.student.message');


// monitor quiz page for one student
Route::get('teacher/course/{course}/quiz/{quiz}/monitor/{student}', [
    TeacherQuizController::class,
    'monitorStudent',
])->name('teacher.quiz.monitor.student');


// student dashboard routes
Route::prefix('student')
    ->name('student.')
    ->middleware([ 'auth', 'role:student', 'student_last_activity', 'log' ])
    ->scopeBindings()
    ->group(function () {

        // All students routes grouped ..
        Route::get('/', [
            StudentDashboardController::class,
            'index',
        ])->name('dashboard');

        /*
        *
        * Student Courses Routes
        */

        Route::resource('course', StudentCourseController::class)->except(['create', 'edit', 'destroy']);

        /*
        *
        * Student Course Sections Routes
        */
        // Route::resource('course.section', StudentSectionController::class)->except(['create', 'edit', 'destroy', 'index', 'show']);

        /*
        *
        * Student Course Section Lessons Routes
        */
        Route::resource('course.section.lesson', StudentLessonController::class)->except(['create', 'edit', 'destroy']);


        /*
        *
        * Student Quiz Routes
        */

        //quiz results
        Route::get('course/{course}/quiz/{quiz}/results', [
            StudentQuizController::class,
            'results',
        ])->name('quiz.results')->middleware('student_submitted_quiz');

        Route::resource('course/{course}/quiz', StudentQuizController::class)->except(['create', 'edit', 'destroy'])->middleware('student_submitted_quiz');




        /*
        *
        * Student Notifications Routes
        */

        Route::post('/notifications/markAsRead', [
            StudentNotificationController::class,
            'markAsRead',
        ])->name('notifications.markAsRead');
    });