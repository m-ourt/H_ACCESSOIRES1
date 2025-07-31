<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Link;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EspaceClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

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

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'products' => Product::all(),
    ]);
});
Route::get('/', [HomeController::class, 'index']);
Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name('login');

Route::get('/register', function () {
    return Inertia::render('Auth/Register');
})->name('register');

Route::post('/register',[RegisterController::class, 'store'])->name('register.store');
Route::post('/login',[LoginController::class, 'store'])->name('login.store');
Route::post('/logout',[LoginController::class, 'destroy'])->name('logout');


Route::middleware(['auth:sanctum', 
config('jetstream.auth_session'), 
'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/panier', [CartController::class, 'index'])->name('panier');
    Route::get('/espace-client', [EspaceClientController::class, 'index'])->name('espace.client');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 

/*Route::get('/home', function () {
    return Inertia::render('Home');
})->name('home');*/
Route::get('/home', function () {
    return Inertia::render('Home', [
        'products' => \App\Models\Product::all()
    ]);
});

Route::get('/NavBarre', function () {
    return Inertia::render('Components/NavBarre');
})->name('NavBarre');
Route::get('/', [ProductController::class, 'home']);


//Route::post('/cart/add', [CartController::class, 'add']);
