<?php

use App\Http\Controllers\BarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\ModifiersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BordingTypeCOntroller;
use App\Http\Controllers\CheckinCheckoutController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DailyStockController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableArrangementsController;
use App\Http\Controllers\EmployeeDesignationsController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\RoomFacilityController;
use App\Http\Controllers\RoomSizeController;
use App\Http\Controllers\RoomTypesController;
use App\Http\Controllers\StockController;
use App\Models\Expense;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExpencestypeController;
use App\Http\Controllers\LecturerController;

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

// Route::get('/', function () {
// return view('welcome');
// });

// Route::get('/events', [EventController::class, 'index']);
// Route::get('/calender', [EventController::class, 'cal']);
Route::post('/event/store', [EventController::class, 'store'])->name('event.store');

Route::get('/calender', [EventController::class, 'cal'])->name('cal');
Route::get('/past-events', [EventController::class, 'pastevents'])->name('past.events');
Route::get('/deleted-events', [EventController::class, 'deletedevents'])->name('deleted.events');
Route::get('/calender/index', [EventController::class, 'index'])->name('cal.index');

Route::post('/events', [EventController::class, 'store']);
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
Route::post('/events/complete/{id}', [EventController::class, 'complete'])->name('events.complete');
Route::post('/events/{id}/restore', [EventController::class, 'restore']);
Route::post('/api/events/view', [EventController::class, 'viewEvent'])->name('events.view');
// Route::get('/calendar', function () {
//     return view('calender.calendar');
// });

Route::post('/api/events/complete/{id}', [EventController::class, 'complete'])->name('events.complete');

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
});
Auth::routes();

Route::middleware(['auth'])->group(function () {



    Route::get('/user', [ReportsController::class, 'user'])->name('users.ReportsIndex')->middleware('can:manage report');
    Route::get('/customer', [ReportsController::class, 'customer'])->name('customers.ReportsIndex')->middleware('can:manage report');

    Route::get('/order', [ReportsController::class, 'order'])->name('order.ReportsIndex')->middleware('can:manage report');
    Route::get('/search-by-type', [ReportsController::class, 'searchByType'])->name('search.by.type');




    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/change/mode', [UserController::class, 'changeMode'])->name('change.mode');
    Route::resource('settings', SettingsController::class)->middleware('can:manage settings');
    Route::resource('users', UserController::class)->middleware('can:manage users');
    Route::post('/change-status', [UserController::class, 'status'])->name('users.status');
    Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
    Route::resource('roles', RoleController::class)->middleware('can:manage roles');
    Route::post('/update-settings', [SettingsController::class, 'updateSettings'])->name('update-settings');
    Route::post('/update-mail', [SettingsController::class, 'updateMail'])->name('update-mail');

    Route::resource('customers', CustomerController::class)->middleware('can:manage customers');

    Route::resource('orders', OrderController::class)->middleware('can:manage orders');

    Route::get('order/print/{id}', [OrderController::class, 'print'])->middleware('can:manage orders')->name('order.print');
    Route::get('order/show/{id}', [OrderController::class, 'show'])->middleware('can:manage orders')->name('orders.show');


    //user profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/profile-image-update', [UserController::class, 'imageUpdate'])->name('image.update');
    Route::post('/profile-cover-update', [UserController::class, 'coverUpdate'])->name('cover.update');
    Route::post('/password-change', [UserController::class, 'passwordUpdate'])->name('password.change');


    // order
    Route::get('/order-create', [OrderController::class, 'create'])->name('orders.create');

    Route::get('/order', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/order-store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/order', [ReportsController::class, 'order'])->name('order.ReportsIndex')->middleware('can:manage report');

    Route::get('/expenses-report', [ReportsController::class, 'product'])->name('product.ReportsIndex')->middleware('can:manage report');



    Route::get('/expense-create', [ExpenseController::class, 'create'])->name('expense.create');
    Route::get('/expensetype-create', [ExpencestypeController::class, 'create'])->name('expensetype.create');

    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense.index');
    Route::get('/expense-type', [ExpencestypeController::class, 'index'])->name('expensetype.index');
    Route::post('/expense-store', [ExpenseController::class, 'store'])->name('expense.store');
    Route::post('/expensetype-store', [ExpencestypeController::class, 'store'])->name('expensetype.store');


    Route::post('/expense-store', [ExpenseController::class, 'store'])->name('expense.store');

    //events
    Route::post('/events/store', [EventController::class, 'store'])->name('event.store');
    Route::get('/api/events', [EventController::class, 'index'])->name('event.index');
    Route::get('/api/events/check/{date}', [EventController::class, 'checkEventOnDate']);
    Route::put('/events/{id}', [EventController::class, 'update']);



    // lecturer
    Route::get('/lecturer', [LecturerController::class, 'index'])->name('lecturer.index');
    Route::get('/lecturer-create', [LecturerController::class, 'create'])->name('lecturer.create');
    Route::post('/lecturer-update', [LecturerController::class, 'store'])->name('lecturer.update');
    Route::post('/lecturer-save', [LecturerController::class, 'store'])->name('lecturer.store');
    Route::get('/lecturer-show/{id}', [LecturerController::class, 'edit'])->name('lecturer.show');
    Route::delete('/lecturer-delete/{id}', [LecturerController::class, 'destroy'])->name('lecturer.destroy');
});
