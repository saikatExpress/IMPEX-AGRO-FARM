<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BranchController;
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

Route::get('/', [AuthController::class, 'create'])->name('login.us');
Route::post('login/store', [AuthController::class, 'store'])->name('login.store');

Route::middleware(['auth'])->group(function(){
    Route::get('/branch', [AdminController::class, 'branch'])->name('branch');
    Route::get('/select/branch/{branch_id}', [BranchController::class, 'selectBranch'])->name('select.branch');
});

Route::middleware(['auth', 'auth.branch'])->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // For Branch Route
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch/store', [BranchController::class, 'store'])->name('branch.store');

    // For Staff Route
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.us');
    Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');

    // For Role Route
    Route::get('/role/list', [RoleController::class, 'index'])->name('role.list');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/role/update', [RoleController::class, 'update'])->name('role.update');
    Route::get('/role/delete/{id}', [RoleController::class, 'destroy']);
    Route::get('/get-permissions/{id}', [RoleController::class, 'getPermissions'])->name('get.permissions');


    // Logout Route
    Route::get('/logout', [AuthController::class, 'logout']);
});