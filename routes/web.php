<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileListController;
use App\Http\Controllers\ISOController;




// ...

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/isos', [ISOController::class, 'index'])->name('isos.index');
Route::get('/isos/create', [ISOController::class, 'create'])->name('isos.create');
Route::post('/isos/store', [ISOController::class, 'store'])->name('isos.store');


//view
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/file-list', [FileListController::class, 'index'])->name('file.list');
Route::get('/view-files/{folder}', [FileListController::class, 'viewFiles'])->name('file.view');



Route::get('/', function () {
    return view('welcome');
});
