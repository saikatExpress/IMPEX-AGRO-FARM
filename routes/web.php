<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CowController;
use App\Http\Controllers\MilkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyerController;
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

    //User Route
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');

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

    Route::get('/milk/create', [MilkController::class, 'create'])->name('milk.create');

    // For Cow Route
    Route::get('/cow/list', [CowController::class, 'index'])->name('cow.list');
    Route::get('/cow/create', [CowController::class, 'create'])->name('cow.create');
    Route::get('/cow/sell', [CowController::class, 'sellCreate'])->name('cow.sell');
    Route::post('/cow/sell/store', [CowController::class, 'sellStore'])->name('sell.store');
    Route::post('/cow/store', [CowController::class, 'store'])->name('cow.store');
    Route::post('/cow/update', [CowController::class, 'update'])->name('cow.edit');
    Route::get('/get/cow/info/{id}', [CowController::class, 'cowInfo']);
    Route::get('/cow/delete/{id}', [CowController::class, 'destroy']);

    // For Buyer Route
    Route::get('/buyer/list', [BuyerController::class, 'index'])->name('buyer.list');
    Route::get('/buyer/create', [BuyerController::class, 'create'])->name('buyer.us');
    Route::post('/buyer/edit', [BuyerController::class, 'update'])->name('buyer.edit');
    Route::post('/buyer/store', [BuyerController::class, 'store'])->name('buyer.store');
    Route::get('/buyer/delete/{id}', [BuyerController::class, 'destroy']);


    // Logout Route
    Route::get('/logout', [AuthController::class, 'logout']);
});