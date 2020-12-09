<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lecturer;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth.lecturer')
    ->prefix('lecturer')
    ->name('lecturer.')
    ->group(function (){
        Route::get('/', [Lecturer\MainController::class, 'index'])->name('index');

        //ROOM
        Route::prefix('room')
            ->name('room.')
            ->group(function (){
                Route::get('/', [Lecturer\RoomController::class, ]);
            });
    });

//Auth routes
Route::name('')->group(function (){
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    //Registration routes
    Route::prefix('register')
        ->name('register.')
        ->group(function (){
            Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('index');
            Route::get('student', [RegisterController::class, 'showStudentRegistrationForm'])->name('student');
            Route::get('lecturer', [RegisterController::class, 'showLecturerRegistrationForm'])->name('lecturer');

            Route::post('student', [RegisterController::class, 'createStudent'])->name('student.submit');
            Route::post('lecturer', [RegisterController::class, 'createLecturer'])->name('lecturer.submit');
        });
});
