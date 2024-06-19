<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\
{
    ScheduleController,
    MaintenanceController,
    CsvUploadController
};

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
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);

    return redirect()->route('login');
});

Route::get('/dashboard', [ScheduleController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('maintenance')->group(function () {
    Route::get('/', [ProfileController::class, 'edit']);
});

Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance');
Route::get('/maintenance/teacher-schedule/create', [MaintenanceController::class, 'teacherScheduleCreate'])->name('teacher-schedule.create.view');
Route::post('/maintenance/teacher-schedule/store', [MaintenanceController::class, 'teacherScheduleStore'])->name('teacher-schedule.store');
Route::get('/maintenance/teacher-schedule/{id}/edit', [MaintenanceController::class, 'teacherScheduleEdit'])->name('teacher-schedule.edit.view');
Route::post('/maintenance/teacher-schedule/update', [MaintenanceController::class, 'teacherScheduleUpdate'])->name('teacher-schedule.update');

Route::get('/maintenance/room-schedule/create', [MaintenanceController::class, 'roomScheduleCreate'])->name('room-schedule.create.view');
Route::post('/maintenance/room-schedule/store', [MaintenanceController::class, 'roomScheduleStore'])->name('room-schedule.store');
Route::get('/maintenance/room-schedule/{id}/edit', [MaintenanceController::class, 'roomScheduleEdit'])->name('room-schedule.edit.view');
Route::post('/maintenance/room-schedule/update', [MaintenanceController::class, 'roomScheduleUpdate'])->name('room-schedule.update');


Route::post('/upload-csv', [MaintenanceController::class, 'upload'])->name('csv.upload');


require __DIR__.'/auth.php';
