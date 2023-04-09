<?php

use App\Http\Controllers\Admin\AdminDashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ArticleDataController as ArticleData;
use App\Http\Controllers\Admin\WasteDataController as WasteData;
use App\Http\Controllers\Admin\GroceriesTransactionController as GroceriesTransaction;
use App\Http\Controllers\Admin\GroceriesDataController as GroceriesData;
use App\Http\Controllers\Auth\LoginController as Login;
use App\Http\Controllers\Auth\LogoutController as Logout;
use App\Http\Controllers\Auth\RegisterController as Register;
use App\Http\Controllers\Exchange\WasteController as Waste;
use App\Http\Controllers\Exchange\GroceriesController as Groceries;
use App\Http\Controllers\User\UserProfileController as UserProfile;
use App\Http\Controllers\User\UserDashboardController as UserDashboard;
use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\ArticleController as Article;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Home::class, 'index']);
Route::get('/penukaran-sampah', [Waste::class, 'index'])->name('penukaran-sampah');
Route::post('/penukaran-sampah', [Waste::class, 'store'])->name('penukaran-sampah');

Route::get('penukaran-sembako', [Groceries::class, 'index'])->name('penukaran-sembako');
Route::get('penukaran-sembako/search', [Groceries::class, 'search'])->name('penukaran-sembako.search');
Route::get('penukaran-sembako/{slug}', [Groceries::class, 'detail'])->name('penukaran-sembako.detail');
Route::post('penukaran-sembako/{slug}', [Groceries::class, 'store']);

Route::get('artikel', [Article::class, 'index'])->name('artikel');
Route::get('artikel/search', [Article::class, 'search'])->name('artikel.search');
Route::get('artikel/{slug}', [Article::class, 'read'])->name('artikel.read');

// must guest
Route::middleware('guest')->group(function () {
    // authentication
    Route::get('register', [Register::class, 'create'])->name('register');
    Route::post('register', [Register::class, 'store'])->name('register');
    Route::get('login', [Login::class, 'create'])->name('login');
    Route::post('login', [Login::class, 'store'])->name('login');
});

// must signed in
Route::middleware('auth')->group(function () {
    // admin
    Route::prefix('admin')->middleware('ensureRole:admin')->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('admin.dashboard');
        Route::get('data-pengguna', [AdminDashboard::class, 'users'])->name('admin.data-pengguna');

        Route::get('sembako', [GroceriesData::class, 'index'])->name('admin.sembako');
        Route::get('sembako/create', [GroceriesData::class, 'create'])->name('admin.sembako.create');
        Route::post('sembako/create', [GroceriesData::class, 'store']);
        Route::get('sembako/detail/{id}', [GroceriesData::class, 'detail'])->name('admin.sembako.detail');
        Route::post('sembako/detail/{id}', [GroceriesData::class, 'update']);
        Route::post('sembako/delete/{id}', [GroceriesData::class, 'delete']);

        Route::get('artikel', [ArticleData::class, 'index'])->name('admin.artikel');
        Route::get('artikel/create', [ArticleData::class, 'create'])->name('admin.artikel.create');
        Route::post('artikel/create', [ArticleData::class, 'store']);
        Route::get('artikel/detail/{id}', [ArticleData::class, 'detail'])->name('admin.artikel.detail');
        Route::post('artikel/detail/{id}', [ArticleData::class, 'update']);

        Route::get('transaksi-sampah', [WasteData::class, 'index'])->name('admin.transaksi-sampah');
        Route::get('transaksi-sampah/detail/{id}', [WasteData::class, 'detail'])->name('admin.transaksi-sampah.detail');
        Route::post('transaksi-sampah/detail/{id}', [WasteData::class, 'update']);
        Route::post('transaksi-sampah/delete/{id}', [WasteData::class, 'delete']);

        Route::get('transaksi-sembako', [GroceriesTransaction::class, 'index'])->name('admin.transaksi-sembako');
        Route::get('transaksi-sembako/detail/{id}', [GroceriesTransaction::class, 'detail'])->name('admin.transaksi-sembako.detail');
        Route::post('transaksi-sembako/detail/{id}', [GroceriesTransaction::class, 'update']);
        Route::post('transaksi-sembako/delete/{id}', [GroceriesTransaction::class, 'delete']);
    });

    // user
    Route::prefix('user')->middleware('ensureRole:user')->group(function () {
        Route::get('/', [UserDashboard::class, 'index'])->name('user.dashboard');

        Route::get('transaksi-sampah/detail/{nanoid}', [UserDashboard::class, 'sampah'])->name('user.transaksi-sampah.detail');
        Route::get('transaksi-sembako/detail/{nanoid}', [UserDashboard::class, 'sembako'])->name('user.transaksi-sembako.detail');
        Route::post('transaksi-sembako/detail/{nanoid}', [UserDashboard::class, 'update']);
        Route::post('transaksi-sampah/detail/{nanoid}/rating', [UserDashboard::class, 'waste_rating'])->name('user.transaksi-sampah.rating');
        Route::post('transaksi-sembako/detail/{nanoid}/rating', [UserDashboard::class, 'groceries_rating'])->name('user.transaksi-sembako.rating');
        Route::get('riwayat-point', [UserDashboard::class, 'history'])->name('user.riwayat-point');

        Route::get('edit-profile', [UserProfile::class, 'index'])->name('user.edit-profile');
        Route::post('edit-profile', [UserProfile::class, 'update'])->name('user.edit-profile');
    });

    Route::post('logout', Logout::class)->name('logout');
});

Route::any(
    '{query}',
    function () {
        return view('not-found');
    }
)
    ->where('query', '.*');
