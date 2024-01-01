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
use App\Http\Controllers\FileViewController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DtHistDocController;





Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/isos', [ISOController::class, 'index'])->name('isos.index');
Route::get('/isos/create', [ISOController::class, 'create'])->name('isos.create');
Route::post('/isos/store', [ISOController::class, 'store'])->name('isos.store');
Route::get('/types', [TypeController::class, 'index'])->name('types.index');
Route::get('/types/create', [TypeController::class, 'create'])->name('types.create');
Route::post('/types', [TypeController::class, 'store'])->name('types.store');
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
Route::get('dthistdoc', [DtHistDocController::class, 'index'])->name('dthistdoc.index');
Route::get('dthistdoc/create', [DtHistDocController::class, 'create'])->name('dthistdoc.create');
Route::post('dthistdoc/store', [DtHistDocController::class, 'store'])->name('dthistdoc.store');

//view
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/file-list', [FileListController::class, 'index'])->name('file.list');
Route::get('/view-files/{folder}', [FileViewController::class, 'viewFiles'])->name('file.view');
Route::get('view-files/{iso}/{folder}', [FileViewController::class, 'showFolderContents']);



Route::get('/', function () {
    return view('welcome');
});
