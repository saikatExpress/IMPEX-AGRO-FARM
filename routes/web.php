<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CowController;
use App\Http\Controllers\BeefController;
use App\Http\Controllers\MilkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CategoryController;
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

Route::get('/link', function () {
    Artisan::call('storage:link');
});

Route::get('/', [AuthController::class, 'create'])->name('login.us');
Route::post('login/store', [AuthController::class, 'store'])->name('login.store');

Route::middleware(['auth'])->group(function(){
    Route::get('/branch', [AdminController::class, 'branch'])->name('branch');
    Route::get('/select/branch/{branch_id}', [BranchController::class, 'selectBranch'])->name('select.branch');
});

Route::middleware(['auth', 'auth.branch'])->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    //User Route
    Route::get('/user/list', [UserController::class, 'index'])->name('user.list');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');

    // For Category Route
    Route::get('/catgeory/list', [CategoryController::class, 'index'])->name('category.list');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.edit');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy']);

    // For Branch Route
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch/store', [BranchController::class, 'store'])->name('branch.store');

    // For Staff Route
    Route::get('/staff/list', [StaffController::class, 'index'])->name('staff.list');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.us');
    Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
    Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');

    //For Beef Route
    Route::get('/beef/create', [BeefController::class, 'create'])->name('beef.create');
    Route::post('/beef/store', [BeefController::class, 'store'])->name('beef.store');
    Route::post('/beef/sell/count', [BeefController::class, 'beefSellCount'])->name('beef.sell_count');
    Route::get('/beef/sell', [BeefController::class, 'beefSell'])->name('beef.sell');
    Route::get('/beef/sell/list', [BeefController::class, 'sellListIndex'])->name('beef.sell_list');
    Route::get('/beef/sell/collect', [BeefController::class, 'show'])->name('sell.collect');
    Route::post('/sell/update', [BeefController::class, 'sellUpdate'])->name('sell.edit');
    Route::post('/beef/sell/store', [BeefController::class, 'beefSellStore'])->name('beef_sell.store');
    Route::post('/beef/sell/update', [BeefController::class, 'beefSellUpdate'])->name('beef.sell_edit');
    Route::get('/beef/sell/delete/{id}', [BeefController::class, 'destroy']);

    // For Role Route
    Route::get('/role/list', [RoleController::class, 'index'])->name('role.list');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/role/update', [RoleController::class, 'update'])->name('role.update');
    Route::get('/role/delete/{id}', [RoleController::class, 'destroy']);
    Route::get('/get-permissions/{id}', [RoleController::class, 'getPermissions'])->name('get.permissions');

    // For Milk Route
    Route::get('/milk/create', [MilkController::class, 'create'])->name('milk.create');

    // For Expense Route
    Route::get('/expense/list', [ExpenseController::class, 'index'])->name('expense.list');
    Route::get('/expense/type', [ExpenseController::class, 'expenseType'])->name('expense.type');
    Route::post('/expense/store', [ExpenseController::class, 'store'])->name('expense.store');
    Route::post('/expense/edit', [ExpenseController::class, 'update'])->name('expense.edit');
    Route::get('/expense/delete/{id}', [ExpenseController::class, 'destroy']);

    // For Cost Route
    Route::get('/cost/list', [CostController::class, 'index'])->name('cost.list');
    Route::get('/cost/create', [CostController::class, 'create'])->name('cost.create');
    Route::post('/cost/store', [CostController::class, 'store'])->name('cost.store');
    Route::post('/cost/edit', [CostController::class, 'update'])->name('cost.edit');

    // For Cow Route
    Route::get('/cow/list', [CowController::class, 'index'])->name('cow.list');
    Route::get('/cow/create', [CowController::class, 'create'])->name('cow.create');
    Route::get('/cow/sell', [CowController::class, 'sellCreate'])->name('cow.sell');
    Route::post('/cow/sell/store', [CowController::class, 'sellStore'])->name('sell.store');
    Route::post('/cow/store', [CowController::class, 'store'])->name('cow.store');
    Route::post('/cow/update', [CowController::class, 'update'])->name('cow.edit');
    Route::get('/sell/cow/list', [CowController::class, 'sellIndex'])->name('cow_sell.list');
    Route::post('/sell/edit', [CowController::class, 'sellEdit'])->name('cow_sell.edit');
    Route::post('/payment/store', [CowController::class, 'paymentStore'])->name('payment.store');
    Route::get('/cow/sell/collect', [CowController::class, 'sellCollect'])->name('cow_sell.collect');
    Route::get('/cow/sell/invoice/{id}', [CowController::class, 'sellInvoice'])->name('sell.invoice');
    Route::get('/get/cow/info/{id}', [CowController::class, 'cowInfo']);
    Route::get('/cow/delete/{id}', [CowController::class, 'destroy']);
    Route::get('/sell/cow/delete/{id}', [CowController::class, 'sellDestroy']);

    // For Invoice Controller
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');

    // For Buyer Route
    Route::get('/buyer/list', [BuyerController::class, 'index'])->name('buyer.list');
    Route::get('/buyer/create', [BuyerController::class, 'create'])->name('buyer.us');
    Route::post('/buyer/edit', [BuyerController::class, 'update'])->name('buyer.edit');
    Route::post('/buyer/store', [BuyerController::class, 'store'])->name('buyer.store');
    Route::get('/buyer/delete/{id}', [BuyerController::class, 'destroy']);

    // For Languge Route
    Route::get('lang/{lang}', [LanguageController::class, 'languageChange'])->name('lang.switch');

    // Logout Route
    Route::get('/logout', [AuthController::class, 'logout']);
});