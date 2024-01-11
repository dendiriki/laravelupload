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
use App\Http\Controllers\DocDeptController;
use App\Http\Controllers\DocTypeController;
use App\Http\Controllers\DepController;





Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/isos', [ISOController::class, 'index'])->name('isos.index')->middleware('auth');
Route::get('/isos/create', [ISOController::class, 'create'])->name('isos.create')->middleware('auth');
Route::post('/isos/store', [ISOController::class, 'store'])->name('isos.store')->middleware('auth');
Route::get('/isos/edit/{id}', [ISOController::class, 'edit'])->name('isos.edit')->middleware('auth');
Route::put('/isos/update/{id}', [ISOController::class, 'update'])->name('isos.update')->middleware('auth');
Route::delete('/isos/destroy/{id}', [ISOController::class, 'destroy'])->name('isos.destroy')->middleware('auth');


Route::get('/types', [TypeController::class, 'index'])->name('types.index')->middleware('auth');
Route::get('/types/create', [TypeController::class, 'create'])->name('types.create')->middleware('auth');
Route::post('/types', [TypeController::class, 'store'])->name('types.store')->middleware('auth');
Route::get('/types/edit/{id}', [TypeController::class, 'edit'])->name('types.edit')->middleware('auth');
Route::put('/types/update/{id}', [TypeController::class, 'update'])->name('types.update')->middleware('auth');
Route::delete('/types/destroy/{id}', [TypeController::class, 'destroy'])->name('types.destroy')->middleware('auth');



Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index')->middleware('auth');
Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create')->middleware('auth');
Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store')->middleware('auth');
Route::get('/documents/edit/{id}', [DocumentController::class, 'edit'])->name('documents.edit')->middleware('auth');
Route::put('/documents/update/{id}', [DocumentController::class, 'update'])->name('documents.update')->middleware('auth');
Route::delete('/documents/destroy/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy')->middleware('auth');


Route::get('dthistdoc', [DtHistDocController::class, 'index'])->name('dthistdoc.index')->middleware('auth');
Route::get('dthistdoc/create', [DtHistDocController::class, 'create'])->name('dthistdoc.create')->middleware('auth');
Route::post('dthistdoc/store', [DtHistDocController::class, 'store'])->name('dthistdoc.store')->middleware('auth');
Route::get ('dthistdoc/detail{id}', [DtHistDocController::class, 'detail'])->name('dthistdoc.detail')->middleware('auth');
Route::get('dthistdoc/edit/{id}', [DtHistDocController::class, 'edit'])->name('dthistdoc.edit')->middleware('auth');
Route::post('dthistdoc/update/{id}', [DtHistDocController::class, 'update'])->name('dthistdoc.update')->middleware('auth');
Route::delete('dthistdoc/destroy/{id}', [DtHistDocController::class, 'destroy'])->name('dthistdoc.destroy')->middleware('auth');

Route::delete('/detaildelete/{id}/{type}', [DtHistDocController::class, 'detaildelete'])->name('dthistdoc.detaildelete');

Route::get('docdept',[DocDeptController::class, 'index'])->name('docdept.index')->middleware('auth');
Route::get('docdept/create',[DocDeptController::class, 'create'])->name('docdept.create')->middleware('auth');
Route::post('docdept/store',[DocDeptController::class, 'store'])->name('docdept.store')->middleware('auth');
Route::delete('/docdept/destroy/{id}', [DocDeptController::class, 'destroy'])->name('docdept.destroy')->middleware('auth');


Route::get('dep', [DepController::class, 'index'])->name('dep.index')->middleware('auth');
Route::get('dep/create', [DepController::class, 'create'])->name('dep.create')->middleware('auth');
Route::post('dep/store', [DepController::class, 'store'])->name('dep.store')->middleware('auth');
Route::get('dep/edit/{id}', [DepController::class, 'edit'])->name('dep.edit')->middleware('auth');
Route::put('dep/update/{id}', [DepController::class, 'update'])->name('dep.update')->middleware('auth');
Route::delete('dep/destroy/{id}', [DepController::class, 'destroy'])->name('dep.destroy')->middleware('auth');


//view
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/file-list', [FileListController::class, 'index'])->name('file.list')->middleware('auth');
Route::get('/view-files/{isoId}', [FileViewController::class, 'viewFiles'])->name('view.files')->middleware('auth');
Route::get('/view-folder-contents/{folder}', [FileViewController::class, 'viewDocument'])->name('view.folder.contents')->middleware('auth');
Route::get('/view-folder-all/{folder}', [FileViewController::class, 'viewDocumentall'])->name('view.folder.all')->middleware('auth');

Route::get('/view-pdf/{id}', [FileViewController::class, 'viewPdf'])->name('view.pdf')->middleware('auth');
Route::get('/view-pdfdoc/{id}', [FileViewController::class, 'viewPdfdoc'])->name('view.pdfdoc')->middleware('auth');
Route::get('/view-pdflampiran/{id}', [FileViewController::class, 'viewPdflampiran'])->name('view.pdflampiran')->middleware('auth');
Route::get('/view-pdfcatmut/{id}', [FileViewController::class, 'viewPdfcatmut'])->name('view.pdfcatmut')->middleware('auth');









// Route::get('/', function () {
//     return view('welcome');
// });
