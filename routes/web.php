<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\StoreController;
use App\Http\Controllers\Frontend\FrontEndController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Backend\Admin\ProductController;

use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Backend\Admin\CustomerController;

use App\Http\Controllers\Backend\Admin\AdminLoginController;
use App\Http\Controllers\Backend\Admin\SupportTicketController;
use App\Http\Controllers\Backend\Admin\AdminDashboardController;

use App\Http\Controllers\Frontend\MessagesController;
use App\Http\Controllers\SocialController;

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

Route::get('/', [FrontEndController::class, 'welcome'])->name('welcome');

// ==================================================================================================================
// =========================================== Super Admin Routes ===================================================
// ==================================================================================================================
Route::prefix('super_admin')->name('super_admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/loginSubmit', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::group(['middleware' => 'auth:super_admin'], function () {
        // Dashboard Route :
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

        // Support Tickets :
        // ==============================================================================
        Route::group(['prefix' => 'support_tickets'], function () {
            Route::get('/index', [SupportTicketController::class, 'index'])->name('support_tickets-index');
            Route::get('destroy/{id}', [SupportTicketController::class, 'destroy'])->name('support_tickets-destroy');
        });

        // Categories :
        // ==============================================================================
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/create', [CategoryController::class, 'create'])->name('categories-create'); // Created By Layth Al-Dwairi
            Route::post('/store', [CategoryController::class, 'store'])->name('categories-store'); // Created By Layth Al-Dwairi
            Route::get('/index', [CategoryController::class, 'index'])->name('categories-index'); // Created By Layth Al-Dwairi
            Route::get('show/{id}', [CategoryController::class, 'show'])->name('categories-show'); // Created By Layth Al-Dwairi
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categories-edit'); // Created By Layth Al-Dwairi
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('categories-update');
            Route::get('softDelete/{id}', [CategoryController::class, 'softDelete'])->name('categories-softDelete'); // Created By Layth Al-Dwairi
            Route::get('/showSoftDelete', [CategoryController::class, 'showSoftDelete'])->name('categories-showSoftDelete'); // Created By Layth Al-Dwairi
            Route::get('softDeleteRestore/{id}', [CategoryController::class, 'softDeleteRestore'])->name('categories-softDeleteRestore'); // Created By Layth Al-Dwairi
            Route::get('/activeInactiveSingle/{id}', [CategoryController::class, 'activeInactiveSingle'])->name('categories-activeInactiveSingle'); // Created By Layth Al-Dwairi
        });

        // Poducts :
        // ==============================================================================
        Route::group(['prefix' => 'products'], function () {
            Route::get('/create', [ProductController::class, 'create'])->name('products-create'); // Created By Layth Al-Dwairi
            Route::post('/store', [ProductController::class, 'store'])->name('products-store'); // Created By Layth Al-Dwairi
            Route::get('/index', [ProductController::class, 'index'])->name('products-index'); // Created By Layth Al-Dwairi
            Route::get('show/{id}', [ProductController::class, 'show'])->name('products-show'); // Created By Layth Al-Dwairi
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products-edit'); // Created By Layth Al-Dwairi
            Route::post('update/{id}', [ProductController::class, 'update'])->name('products-update');
            Route::get('softDelete/{id}', [ProductController::class, 'softDelete'])->name('products-softDelete'); // Created By Layth Al-Dwairi
            Route::get('/showSoftDelete', [ProductController::class, 'showSoftDelete'])->name('products-showSoftDelete'); // Created By Layth Al-Dwairi
            Route::get('softDeleteRestore/{id}', [ProductController::class, 'softDeleteRestore'])->name('products-softDeleteRestore'); // Created By Layth Al-Dwairi
            Route::get('/activeInactiveSingle/{id}', [ProductController::class, 'activeInactiveSingle'])->name('products-activeInactiveSingle'); // Created By Layth Al-Dwairi
            Route::get('/deleteOneQuantity/{id}', [ProductController::class, 'deleteOneQuantity'])->name('products-deleteOneQuantity'); // Created By Layth Al-Dwairi
        });

        // Customers :
        // ==============================================================================
        Route::group(['prefix' => 'customers'], function () {
            Route::get('/create', [CustomerController::class, 'create'])->name('customers-create'); // Created By Layth Al-Dwairi
            Route::post('/store', [CustomerController::class, 'store'])->name('customers-store'); // Created By Layth Al-Dwairi
            Route::get('/index', [CustomerController::class, 'index'])->name('customers-index'); // Created By Layth Al-Dwairi
            Route::get('show/{id}', [CustomerController::class, 'show'])->name('customers-show'); // Created By Layth Al-Dwairi
            Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('customers-edit'); // Created By Layth Al-Dwairi
            Route::post('update/{id}', [CustomerController::class, 'update'])->name('customers-update');
            Route::get('softDelete/{id}', [CustomerController::class, 'softDelete'])->name('customers-softDelete'); // Created By Layth Al-Dwairi
            Route::get('/showSoftDelete', [CustomerController::class, 'showSoftDelete'])->name('customers-showSoftDelete'); // Created By Layth Al-Dwairi
            Route::get('softDeleteRestore/{id}', [CustomerController::class, 'softDeleteRestore'])->name('customers-softDeleteRestore'); // Created By Layth Al-Dwairi
            Route::get('/activeInactiveSingle/{id}', [CustomerController::class, 'activeInactiveSingle'])->name('customers-activeInactiveSingle'); // Created By Layth Al-Dwairi
        });
    });
});

// ==================================================================================================================
// =============================================== Auth Routes ======================================================
// ==================================================================================================================
// Login Route :
Route::post('/customertLoginRequest', [FrontEndController::class, 'customertLoginRequest'])->name('customertLoginRequest'); // Created By Layth Al-Dwairi
// Signup Route :
Route::post('/customerSignupRequest', [FrontEndController::class, 'customerSignupRequest'])->name('customerSignupRequest');
