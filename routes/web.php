<?php

use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\StudentController as TeacherStudentController;
use App\Http\Controllers\Teacher\QuizController as TeacherQuizController;
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
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
	Route::get('map', function () {
		return view('pages.maps');
	})->name('map');
	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');
	Route::get('table-list', function () {
		return view('pages.tables');
	})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


//teacher dashboard routes, with auth middleware

Route::prefix('teacher')->middleware(['middleware' => 'role:teacher'])->group(function () {


	Route::get('dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');



	Route::get('course', [TeacherCourseController::class, 'show'])->name('teacher.course');
	//create course
	Route::get('course/create', [TeacherCourseController::class, 'create'])->name('teacher.course.create');
	Route::post('course/create', [TeacherCourseController::class, 'store'])->name('teacher.course.store');
	//edit course
	Route::get('course/{course}/edit', [TeacherCourseController::class, 'edit'])->name('teacher.course.edit');
	Route::put('course/{course}/edit', [TeacherCourseController::class, 'update'])->name('teacher.course.update');
	//delete course
	Route::delete('course/{course}/delete', [TeacherCourseController::class, 'destroy'])->name('teacher.course.destroy');


	//view course quizzes
	Route::get('course/{course}/quiz', [TeacherQuizController::class, 'index'])->name('teacher.quiz.index');
	//viez course 1 quiz
	Route::get('course/{course}/quiz/{quiz}', [TeacherQuizController::class, 'show'])->name('teacher.quiz.show');
	// Create a quiz for a course
	Route::get('course/{course}/quiz/create', [TeacherQuizController::class, 'create'])->name('teacher.quiz.create');
	Route::post('course/{course}/quiz/create', [TeacherQuizController::class, 'store'])->name('teacher.quiz.store');
	// Edit a quiz for a course
	Route::get('course/{course}/quiz/{quiz}/edit', [TeacherQuizController::class, 'edit'])->name('teacher.quiz.edit');
	Route::put('course/{course}/quiz/{quiz}', [TeacherQuizController::class, 'update'])->name('teacher.quiz.update');
	// Delete a quiz for a course
	Route::delete('course/{course}/quiz/{quiz}', [TeacherQuizController::class, 'destroy'])->name('teacher.quiz.destroy');




	//add quesion to quiz
	Route::get('quiz/{quiz}/question/create', [TeacherQuizQuestionController::class, 'create'])->name('teacher.quiz.question.create');
	Route::post('quiz/{quiz}/question/create', [TeacherQuizQuestionController::class, 'store'])->name('teacher.quiz.question.store');
	//edit question
	Route::get('quiz/{quiz}/question/{question}/edit', [TeacherQuizQuestionController::class, 'edit'])->name('teacher.quiz.question.edit');
	Route::put('quiz/{quiz}/question/{question}/edit', [TeacherQuizQuestionController::class, 'update'])->name('teacher.quiz.question.update');
	//delete question
	Route::delete('quiz/{quiz}/question/{question}/delete', [TeacherQuizQuestionController::class, 'destroy'])->name('teacher.quiz.question.destroy');



	//add answer to question
	Route::get('quiz/{quiz}/question/{question}/answer/create', [TeacherQuizAnswerController::class, 'create'])->name('teacher.quiz.answer.create');
	Route::post('quiz/{quiz}/question/{question}/answer/create', [TeacherQuizAnswerController::class, 'store'])->name('teacher.quiz.answer.store');
	//edit answer
	Route::get('quiz/{quiz}/question/{question}/answer/{answer}/edit', [TeacherQuizAnswerController::class, 'edit'])->name('teacher.quiz.answer.edit');
	Route::put('quiz/{quiz}/question/{question}/answer/{answer}/edit', [TeacherQuizAnswerController::class, 'update'])->name('teacher.quiz.answer.update');
	//delete answer
	Route::delete('quiz/{quiz}/question/{question}/answer/{answer}', [TeacherQuizAnswerController::class, 'destroy'])->name('teacher.quiz.answer.destroy');


	Route::get('students', [TeacherStudentController::class, 'index'])->name('teacher.students');



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
