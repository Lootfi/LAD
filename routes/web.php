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



Route::get('/', function () {
    return view('welcome');
});

//teacher dashboard routes, with auth middleware

Route::prefix('teacher')
    ->middleware(['middleware' => 'role:teacher'])
    ->group(function () {

        Route::get('dashboard', [
            TeacherDashboardController::class,
            'index',
        ])->name('teacher.dashboard');

        // create a student account
        Route::get('student/create', [
            TeacherStudentController::class,
            'create',
        ])->name('teacher.student.create');

        Route::post('student/create', [
            TeacherStudentController::class,
            'store',
        ])->name('teacher.student.store');

        Route::get('course', [TeacherCourseController::class, 'show'])->name(
            'teacher.course'
        );
        //create course
        Route::get('course/create', [
            TeacherCourseController::class,
            'create',
        ])->name('teacher.course.create');

        Route::post('course/create', [
            TeacherCourseController::class,
            'store',
        ])->name('teacher.course.store');

        //edit course
        Route::get('course/{course}/edit', [
            TeacherCourseController::class,
            'edit',
        ])->name('teacher.course.edit');

        Route::put('course/{course}/edit', [
            TeacherCourseController::class,
            'update',
        ])->name('teacher.course.update');
        //delete course
        Route::delete('course/{course}/delete', [
            TeacherCourseController::class,
            'destroy',
        ])->name('teacher.course.destroy');

        //view course quizzes
        Route::get('course/{course}/quiz', [
            TeacherQuizController::class,
            'index',
        ])->name('teacher.quiz.index');


        // Create a quiz for a course
        Route::get('course/{course}/quiz/create', [
            TeacherQuizController::class,
            'create',
        ])->name('teacher.quiz.create');

        //viez course 1 quiz
        Route::get('course/{course}/quiz/{quiz}', [
            TeacherQuizController::class,
            'show',
        ])->name('teacher.quiz.show');
        // notify students about quiz
        Route::get('course/{course}/quiz/{quiz}/notify', [
            TeacherQuizController::class,
            'notify',
        ])->name('teacher.quiz.notify');




        Route::post('course/{course}/quiz/create', [
            TeacherQuizController::class,
            'store',
        ])->name('teacher.quiz.store');
        // Edit a quiz for a course
        Route::get('course/{course}/quiz/{quiz}/edit', [
            TeacherQuizController::class,
            'edit',
        ])->name('teacher.quiz.edit');
        Route::put('course/{course}/quiz/{quiz}', [
            TeacherQuizController::class,
            'update',
        ])->name('teacher.quiz.update');
        // Delete a quiz for a course
        Route::delete('course/{course}/quiz/{quiz}', [
            TeacherQuizController::class,
            'destroy',
        ])->name('teacher.quiz.destroy');

        //add quesion to quiz
        Route::get('quiz/{quiz}/question/create', [
            TeacherQuizQuestionController::class,
            'create',
        ])->name('teacher.quiz.question.create');
        Route::post('quiz/{quiz}/question/create', [
            TeacherQuizQuestionController::class,
            'store',
        ])->name('teacher.quiz.question.store');
        //edit question
        Route::get('quiz/{quiz}/question/{question}/edit', [
            TeacherQuizQuestionController::class,
            'edit',
        ])->name('teacher.quiz.question.edit');
        Route::put('quiz/{quiz}/question/{question}/edit', [
            TeacherQuizQuestionController::class,
            'update',
        ])->name('teacher.quiz.question.update');

        //delete question
        Route::delete('quiz/{quiz}/question/{question}/delete', [
            TeacherQuizQuestionController::class,
            'destroy',
        ])->name('teacher.quiz.question.destroy');


        Route::post('quiz/{quiz}/question/{question}/answer/create', [
            TeacherQuizAnswerController::class,
            'store',
        ])->name('teacher.quiz.answer.store');
        //edit answer
        Route::get('quiz/{quiz}/question/{question}/answer/{answer}/edit', [
            TeacherQuizAnswerController::class,
            'edit',
        ])->name('teacher.quiz.answer.edit');
        Route::put('quiz/{quiz}/question/{question}/answer/{answer}/edit', [
            TeacherQuizAnswerController::class,
            'update',
        ])->name('teacher.quiz.answer.update');
        //delete answer
        Route::delete('quiz/{quiz}/question/{question}/answer/{answer}', [
            TeacherQuizAnswerController::class,
            'destroy',
        ])->name('teacher.quiz.answer.destroy');

        Route::get('students', [
            TeacherStudentController::class,
            'index',
        ])->name('teacher.students');

        // Route::get('teacher/assignments/create', function () {
        // 	return view('pages.teacher.assignments.create');
        // })->name('teacher.assignments.create');
        // Route::get('teacher/assignments/edit', function () {
        // 	return view('pages.teacher.assignments.edit');
        // })->name('teacher.assignments.edit');
        // Route::get('teacher/assignments/show', function () {
        // 	return view('pages.teacher.assignments.show');
        // })->name('teacher.assignments.show');
        // Route::get('teacher/assignments/delete', function () {
        // 	return view('pages.teacher.assignments.delete');
        // })->name('teacher.assignments.delete');
    });


// student dashboard routes

Route::prefix('student')
    ->middleware(['middleware' => 'role:student'])
    ->group(function () {
        Route::get('/', [
            StudentDashboardController::class,
            'index',
        ])->name('student.dashboard');

        Route::get('/course', [
            StudentCourseController::class,
            'index',
        ])->name('student.course');

        Route::get('/course/{course}', [
            StudentCourseController::class,
            'show',
        ])->name('student.course.show');

        // student.quiz.index
        Route::get('/course/{course}/quiz', [
            StudentQuizController::class,
            'index',
        ])->name('student.quiz.index');

        Route::get('/course/{course}/quiz/{quiz}', [
            StudentQuizController::class,
            'show',
        ])->name('student.quiz.show');

        Route::post('/course/{course}/quiz/{quiz}', [
            StudentQuizController::class,
            'store',
        ])->name('student.quiz.store');

        Route::get('/course/{course}/quiz/{quiz}/result', [
            StudentQuizController::class,
            'result',
        ])->name('student.quiz.result');

        Route::get('/course/{course}/quiz/{quiz}/result/{result}', [
            StudentQuizController::class,
            'showResult',
        ])->name('student.quiz.showResult');

        Route::get('/course/{course}/quiz/{quiz}/result/{result}/edit', [
            StudentQuizController::class,
            'editResult',
        ])->name('student.quiz.editResult');

        Route::put('/course/{course}/quiz/{quiz}/result/{result}/edit', [
            StudentQuizController::class,
            'updateResult',
        ])->name('student.quiz.updateResult');

        Route::get('/course/{course}/quiz/{quiz}/result/{result}/delete', [
            StudentQuizController::class,
            'destroyResult',
        ])->name('student.quiz.destroyResult');

        Route::get('/course/{course}/quiz/{quiz}/result/{result}/comment', [
            StudentQuizController::class,
            'comment',
        ])->name('student.quiz.comment');



        // student.notifications.markAsRead
        Route::post('/notifications/markAsRead', [
            StudentNotificationController::class,
            'markAsRead',
        ])->name('student.notifications.markAsRead');
    });





Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');
