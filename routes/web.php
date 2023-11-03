<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\MyTaskController;
use App\Http\Controllers\Backend\LeaveController;
use App\Http\Controllers\Backend\MyLeaveController;




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
    Route::get('admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

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
        Route::get('/task/edit/{id}', 'EditTask')->name('edit.tasks');
        Route::post('/tasks/update', 'UpdateTask')->name('update.tasks');
    });

    Route::controller(LeaveController::class)->group(function (){
        Route::get('/leave/list', 'AllLeave')->name('all.leave');
    });
});


Route::middleware(['auth', 'role:user'])->group(function (){
    Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    
    Route::controller(MyTaskController::class)->group(function (){
        Route::get('/task', 'MyTasks')->name('my.tasks');
        Route::get('/task/{id}', 'EditMyTask')->name('edit.mytasks');
        Route::post('/task/update', 'UpdateMyTask')->name('update.mytask');
    });

    Route::controller(MyLeaveController::class)->group(function (){
        Route::get('/leave/request', 'MyLeave')->name('my.leave');
        Route::post('/leave/store', 'StoreMyLeave')->name('store.myleave');
        Route::get('/leave/{id}', 'DeleteMyleave')->name('delete.myleave');

    });
});
require __DIR__.'/auth.php';