<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ {
    UserAdminController,
    RoleAdminController,
    PermissionAdminController,
    PostAdminController
};
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
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('users', UserAdminController::class)->except(['show']);
    Route::resource('roles', RoleAdminController::class)
        ->except(['update', 'edit']);
    Route::post('roles/{id}/permissions', [RoleAdminController::class, 'syncPermissions'])
        ->name('roles.permissions');
    Route::resource('permissions', PermissionAdminController::class)
        ->except(['update', 'edit', 'show']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => ['permission:list post']], function() {
        Route::resource('posts', PostAdminController::class);
    });
});

require __DIR__.'/auth.php';
