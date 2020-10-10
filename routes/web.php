<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserSkillController;
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
    return view('dashboard.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['client'])->group(function () {
        Route::get('/dashboard/mentor-list', [ClientController::class, 'mentorList'])->name('dashboard.mentor-list');
        Route::get('/dashboard/mentor-detail/{user:name}', [ClientController::class, 'mentorDetail'])->name('dashboard.mentor-detail');
    });

    Route::middleware(['mentor'])->group(function () {
        Route::get('/dashboard/schedule', [ScheduleController::class, 'index'])->name('dashboard.schedule');
        Route::post('dashboard/schedule', [ScheduleController::class, 'store'])->name('dashboard.add-schedule');
        Route::put('dashboard/schedule/{schedule:id}', [ScheduleController::class, 'update'])->name('dashboard.edit-schedule');
        Route::delete('dashboard/schedule/{schedule:id}', [ScheduleController::class, 'destroy'])->name('dashboard.delete-schedule');

        Route::get('/dashboard/skill', [UserSkillController::class, 'index'])->name('dashboard.skill');
        Route::post('/dashboard/skill/', [UserSkillController::class, 'store'])->name('dashboard.add-skill');
        Route::delete('/dashboard/skill/{id}', [UserSkillController::class, 'destroy'])->name('dashboard.delete-skill');
    });

    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::get('/dashboard/profile/edit', [DashboardController::class, 'editProfile'])->name('dashboard.edit.profile');
    Route::get('/dashboard/password/edit', [DashboardController::class, 'editPassword'])->name('dashboard.edit.password');
});
