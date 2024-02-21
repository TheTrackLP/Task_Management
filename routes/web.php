<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\LeaveController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\RoleController;


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

Route::middleware(['auth', 'roles:admin'])->group(function(){

    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/dashboard', 'AdminDashboard')->name('admin.dashboard');
        Route::get('/admin/users/admins', 'AllAdmin')->name('all.admins');
        Route::get('/admin/logout', 'AdminLogout')->name('admin.logout');
    });

    Route::controller(EmployeeController::class)->group(function(){
        Route::get('/admin/employees', 'AllEmployees')->name('all.employees');
        Route::post('/admin/employees/add', 'AddEmployee')->name('add.employee');
        Route::get('/admin/employees/edit/{id}', 'EditEmployee')->name('edit.employee');
        Route::post('/admin/employees/update', 'UpdateEmployee')->name('update.employee');
        Route::get('/admin/employee/delete/{id}', 'DeleteEmployee')->name('delete.employee');
    });

    Route::controller(TaskController::class)->group(function(){
        Route::get('/admin/tasks', 'AllTasks')->name('all.tasks');
        Route::post('/admin/add/tasks', 'AddTasks')->name('add.tasks');
        Route::get('/admin/edit/tasks/{id}', 'EditTasks')->name('edit.tasks');
        Route::post('/admin/update/tasks', 'UpdateTasks')->name('update.tasks');
        Route::get('/admin/delete/task/{id}', 'DeleteTask')->name('delete.tasks');
    });

    Route::controller(ProjectController::class)->group(function(){
        Route::get('/admin/projects', 'AllProjects')->name('all.projects');
        Route::get('/admin/add/projects', 'AddProjects')->name('add.projects');
        Route::post('/admin/store/projets', 'StoreProjects')->name('store.projects');
        Route::get('/admin/view/projects/{id}', 'ViewProjects')->name('view.projects');
        Route::get('/admin/edit/projects/{id}', 'EditProjects')->name('edit.projects');
        Route::post('/admin/update/projects', 'UpdateProjects')->name('update.projects');
        Route::get('/admin/delete/projects/{id}', 'DeleteProjects')->name('delete.projects');

        Route::get('/admin/view/projects/delete/member/{id}', 'DeleteMember')->name('delete.member');
    });

    Route::controller(LeaveController::class)->group(function(){
        Route::get('/admin/leaves', 'AllLeaves')->name('all.leaves');
    });

    Route::controller(SettingsController::class)->group(function(){
        Route::get('/admin/settings', 'Settings')->name('settings');
        Route::post('/admin/settings/position/add', 'StorePosition')->name('store.settings');
        Route::get('/admin/settings/position/delete/{id}', 'DeletePosition')->name('delete.position');

        Route::post('/admin/settings/leave/add', 'StoreLeave')->name('store.leave');
        Route::get('/admin/settings/leave/delete/{id}', 'DeleteLeave')->name('delete.leave');    
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/admins/users', 'AllUsers')->name('all.users');
        Route::get('/admins/users/{id}', 'GetUsers');
        Route::post('/admin/users/add', 'StoreUser')->name('store.user');
    });

    Route::controller(RoleController::class)->group(function(){
        Route::get('/admin/roles', 'AllRoles')->name('all.roles');
        Route::post('/admin/roles/add', 'AddRoles')->name('add.roles');
        Route::get('/admin/roles/edit/{id}', 'EditRoles')->name('edit.role');
        Route::get('/admin/roles/delete/{id}', 'DeleteRoles')->name('delete.roles');
        
        Route::get('/admin/permissions', 'AllPermissions')->name('all.permissions');
        Route::post('/admin/permissions/add', 'AddPermissions')->name('add.permissions');
        Route::get('/admin/permissions/delete/{id}', 'DeletePermission')->name('delete.permissions');

        Route::get('/admin/roles/permissions', 'AllRolesNPermissions')->name('all.roles.permissions');
        Route::post('/admin/role/permissions/add', 'AddRolesNPermissions')->name('add.roles.permissions');
        Route::get('/admin/role/permission/edit/{id}', 'EditRolePermission')->name('edit.role.permissions');
    });
});

Route::middleware(['auth', 'roles:user'])->group(function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('/user/dashboard', 'UserDashboard')->name('user.dashboard');
        Route::get('/user/logout', 'UserLogout')->name('user.logout');
    });
});
require __DIR__.'/auth.php';