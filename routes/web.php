<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/event/{id}', [App\Http\Controllers\EventController::class, 'show'])->name('event.show');

Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'loginPost']);

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
Route::get('/dashboard/event', [App\Http\Controllers\DashboardController::class, 'event']);
Route::get('/dashboard/student', [App\Http\Controllers\DashboardController::class, 'student']);
Route::get('/dashboard/user', [App\Http\Controllers\DashboardController::class, 'user']);

//student
Route::post('/dashboard/student/add', [App\Http\Controllers\StudentController::class, 'addStudent']);
Route::get('/dashboard/student/{id}', [App\Http\Controllers\StudentController::class, 'getOne']);
Route::put('/dashboard/student/{id}', [App\Http\Controllers\StudentController::class, 'editStudent']);
Route::delete('/dashboard/student/{id}', [App\Http\Controllers\StudentController::class, 'deleteStudent']);

//user
Route::post('/dashboard/user/add', [App\Http\Controllers\UserController::class, 'addUser']);
Route::get('/dashboard/user/{id}', [App\Http\Controllers\UserController::class, 'getOne']);
Route::put('/dashboard/user/{id}', [App\Http\Controllers\UserController::class, 'editUser']);
Route::delete('/dashboard/user/{id}', [App\Http\Controllers\UserController::class, 'deleteUser']);

//event
Route::get('/dashboard/event/{id}', [App\Http\Controllers\EventController::class, 'getOneEvent']);
Route::post('/dashboard/event/{id}', [App\Http\Controllers\EventController::class, 'editEvent']);
Route::delete('/dashboard/event/{id}', [App\Http\Controllers\EventController::class, 'deleteEvent']);

//addevent 
Route::get('/dashboard/addEventView', [App\Http\Controllers\EventController::class, 'addEventView']);
Route::post('/dashboard/addEventView', [App\Http\Controllers\EventController::class, 'addEvent']);
Route::post('/dashboard/addEventView/post', [App\Http\Controllers\EventController::class, 'upload'])->name('ckeditor.upload');


//checkin
Route::get('dashboard/events/{id}/students', [App\Http\Controllers\CheckinController::class, 'showStudents'])->name('dashboard.checkin');
Route::get('dashboard/events/{id}/students/export', [App\Http\Controllers\CheckinController::class, 'exportStudents'])->name('dashboard.checkin.export');

//ckeditor
Route::get('/ckeditor', [App\Http\Controllers\CkeditorController::class, 'index']);
