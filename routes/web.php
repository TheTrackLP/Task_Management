<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\TaskController;


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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::controller(EmployeeController::class)->group(function (){
        Route::get('/employee/list', 'AllEmployees')->name('all.employee');
        Route::post('/employee/add', 'AddEmployee')->name('add.employee');
        Route::get('/employee/edit/{id}', 'EditEmployee')->name('edit.employee');
        Route::post('/employee/update', 'UpdateEmployee')->name('update.employee');
        Route::get('/employee/delete/{id}', 'DeleteEmployee')->name('delete.employee');
    });

    Route::controller(AttendanceController::class)->group(function (){
        Route::get('/attendance/list', 'ShowAttendance')->name('all.attendance');
    });

    Route::controller(ProjectController::class)->group(function (){
        Route::get('/projects/list', 'ShowProjects')->name('all.projects');
        Route::get('/projects/add', 'AddProjetcs')->name('add.projects');
        Route::post('/projects/store', 'StoreProjects')->name('store.projects');
        Route::get('/projects/edit/{id}', 'EditProjects')->name('edit.projects');
        Route::post('projects/update', 'UpdateProjects')->name('update.projects');
        Route::get('/projects/delete/{id}', 'DeleteProjects')->name('delete.projects');
        Route::get('/projects/view/{id}', 'ViewProjects')->name('view.projects');
        Route::post('/projects/addMember', 'AddPrjMember')->name('addmember.projects');
        Route::get('/project/member/{id}', 'DeleteMember')->name('delete.member');
    });

    Route::controller(TaskController::class)->group(function (){
        Route::get('/task/list', 'ShowTasks')->name('all.tasks');
        Route::post('/task/store', 'StoreTasks')->name('store.tasks');
        Route::get('/task/view/{id}', 'ViewTask')->name('view.tasks');
    });
});

require __DIR__.'/auth.php';