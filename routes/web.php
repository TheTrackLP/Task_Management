<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\EmployeeController;



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
});

require __DIR__.'/auth.php';