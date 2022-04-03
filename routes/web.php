<?php

use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\StudentController as TeacherStudentController;
use App\Http\Controllers\Teacher\QuizController as TeacherQuizController;
use App\Http\Controllers\Teacher\QuizQuestionController as TeacherQuizQuestionController;
use App\Http\Controllers\Teacher\QuizAnswerController as TeacherQuizAnswerController;

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\QuizController as StudentQuizController;
use App\Http\Controllers\Student\QuizQuestionController as StudentQuizQuestionController;
use App\Http\Controllers\Student\QuizAnswerController as StudentQuizAnswerController;
use App\Http\Controllers\Student\NotificationController as StudentNotificationController;

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

Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('welcome');
});

//teacher dashboard routes, with auth middleware

Route::prefix('teacher')
    ->name('teacher.')
    ->middleware(['middleware' => 'role:teacher'])
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
        * Course Quiz Routes
        */

        Route::get('course/{course}/quiz/{quiz}/notify', [
            TeacherQuizController::class,
            'notify',
        ])->name('quiz.notify');

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

        Route::resource('student', TeacherStudentController::class);
    });





// student dashboard routes
Route::prefix('student')
    ->name('student.')
    ->middleware(['middleware' => 'role:student'])
    ->group(function () {

        Route::get('/', [
            StudentDashboardController::class,
            'index',
        ])->name('dashboard');

        /*
        *
        * Student Courses Routes
        */

        Route::resource('course', StudentCourseController::class)->except(['create', 'edit']);

        /*
        *
        * Student Quiz Routes
        */

        Route::resource('course/{course}/quiz', StudentQuizController::class);

        //quiz results
        Route::get('course/{course}/quiz/{quiz}/results', [
            StudentQuizController::class,
            'results',
        ])->name('quiz.results');


        /*
        *
        * Student Notifications Routes
        */

        Route::post('/notifications/markAsRead', [
            StudentNotificationController::class,
            'markAsRead',
        ])->name('notifications.markAsRead');
    });




Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');
