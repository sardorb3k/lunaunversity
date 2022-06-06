<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\GroupsController;

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


// Authentication routes
Route::group(['middleware' => ['web']], function () {
    // Login Routes...
    Route::get('login', ['as' => 'login', 'uses' => 'App\Http\Controllers\Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'App\Http\Controllers\Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'App\Http\Controllers\Auth\LoginController@logout']);

    // Registration Routes...
    Route::get('register', ['as' => 'register', 'uses' => 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'register.post', 'uses' => 'App\Http\Controllers\Auth\RegisterController@register']);

    // Password Reset Routes...
    // Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    // Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    // Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    // Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);
});

// Home page route for logged in users only (middleware auth)
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'App\Http\Controllers\HomeController@index']);

// Group routes
Route::resource('groups', GroupsController::class);
// Student routes
Route::resource('students', GroupsController::class);
// Group subscription student routes
Route::post('groups/subscription', [GroupsController::class, 'subscription'])->name('groups.subscription')->middleware(['auth']);
Route::post('groups/unsubscribe', [GroupsController::class, 'unsubscribe'])->name('groups.unsubscribe')->middleware(['auth']);

// Teacher routes
Route::resource('teachers', 'App\Http\Controllers\TeachersController');

// Student routes
Route::resource('students', 'App\Http\Controllers\StudentsController');
Route::get('students/{id}/exam', 'App\Http\Controllers\StudentsController@exam')->name('students.exam');
Route::get('students/{id}/group', 'App\Http\Controllers\StudentsController@group')->name('students.group');
Route::get('students/{id}/payments', 'App\Http\Controllers\StudentsController@payments')->name('students.payments');
Route::get('students/{id}/attendance', 'App\Http\Controllers\StudentsController@attendance')->name('students.attendance');
// Payments routes
Route::group(['prefix' => 'payments'], function () {
    Route::get('/', 'App\Http\Controllers\PaymentsController@index')->name('payments.index');
    Route::post('/', 'App\Http\Controllers\PaymentsController@store')->name('payments.store');
    Route::get('/{id}', 'App\Http\Controllers\PaymentsController@show_red')->name('payments.show_red');
    Route::get('/{id}/{date}', 'App\Http\Controllers\PaymentsController@show')->name('payments.show');
    Route::put('/{id}', 'App\Http\Controllers\PaymentsController@update')->name('payments.update');

});


// Attendance routes
// Route::resource('attendance', 'App\Http\Controllers\AttendanceController');
Route::group(['prefix' => 'attendance'], function () {
    Route::get('/', 'App\Http\Controllers\AttendanceController@index')->name('attendance.index');
    Route::post('/', 'App\Http\Controllers\AttendanceController@store')->name('attendance.store');
    Route::get('/{id}', 'App\Http\Controllers\AttendanceController@show_red')->name('attendance.show_red');
    Route::get('/{id}/{date}', 'App\Http\Controllers\AttendanceController@show')->name('attendance.show');
    Route::put('/{id}', 'App\Http\Controllers\AttendanceController@update')->name('attendance.update');

});
// Salary routes
Route::resource('salary', 'App\Http\Controllers\SalaryController');

// Exams routes
// Route::resource('exams', 'App\Http\Controllers\ExamsController');
// Exam group
Route::group(['prefix' => 'exams'], function () {
    // -- Exam Get index
    Route::get('/', ['as' => 'exams.index', 'uses' => 'App\Http\Controllers\ExamsController@index']);
    // -- Exam Get show
    Route::get('/{id}', ['as' => 'exams.show', 'uses' => 'App\Http\Controllers\ExamsController@show']);
    // -- Exam Get create | i update -> POST
    Route::post('/create', ['as' => 'exams.create', 'uses' => 'App\Http\Controllers\ExamsController@create']);
    // -- Exam Post store
    Route::post('/', ['as' => 'exams.store', 'uses' => 'App\Http\Controllers\ExamsController@store']);
    // -- Exam Get edit
    Route::get('/{id}/edit', ['as' => 'exams.edit', 'uses' => 'App\Http\Controllers\ExamsController@edit']);
    // -- Exam Put update
    Route::put('/{id}', ['as' => 'exams.update', 'uses' => 'App\Http\Controllers\ExamsController@update']);
    // -- Exam Delete destroy
    Route::delete('/{id}', ['as' => 'exams.destroy', 'uses' => 'App\Http\Controllers\ExamsController@destroy']);
});


// Language routes
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
