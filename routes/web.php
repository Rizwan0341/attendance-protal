<?php

use App\Http\Controllers\Schedule\ScheduleController;
use App\Models\UserSchedule;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::get('/about', function () {
    view('about');
});
Route::get('/scheduled', function () {
    $shiftss = UserSchedule::get();
    return view('scheduled' , compact('shiftss'));
})->name('scheduled');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/schedule-add',[ScheduleController::class,'Schedule_add'])->name('schedule.add');
Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
Route::put('/schedule/{id}', [ScheduleController::class, 'update'])->name('schedule.update');

