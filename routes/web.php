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
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TiketController;




Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/isos', [ISOController::class, 'index'])->name('isos.index')->middleware('admin');
Route::get('/isos/create', [ISOController::class, 'create'])->name('isos.create')->middleware('admin');
Route::post('/isos/store', [ISOController::class, 'store'])->name('isos.store')->middleware('admin');
Route::get('/isos/edit/{id}', [ISOController::class, 'edit'])->name('isos.edit')->middleware('admin');
Route::put('/isos/update/{id}', [ISOController::class, 'update'])->name('isos.update')->middleware('admin');
Route::delete('/isos/destroy/{id}', [ISOController::class, 'destroy'])->name('isos.destroy')->middleware('admin');


Route::get('/types', [TypeController::class, 'index'])->name('types.index')->middleware('admin');
Route::get('/types/create', [TypeController::class, 'create'])->name('types.create')->middleware('admin');
Route::post('/types', [TypeController::class, 'store'])->name('types.store')->middleware('admin');
Route::get('/types/edit/{id}', [TypeController::class, 'edit'])->name('types.edit')->middleware('admin');
Route::put('/types/update/{id}', [TypeController::class, 'update'])->name('types.update')->middleware('admin');
Route::delete('/types/destroy/{id}', [TypeController::class, 'destroy'])->name('types.destroy')->middleware('admin');



Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index')->middleware('admin');
Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create')->middleware('admin');
Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store')->middleware('admin');
Route::get('/documents/edit/{id}', [DocumentController::class, 'edit'])->name('documents.edit')->middleware('admin');
Route::put('/documents/update/{id}', [DocumentController::class, 'update'])->name('documents.update')->middleware('admin');
Route::delete('/documents/destroy/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy')->middleware('admin');
Route::get('/api/fetch-data', [DocumentController::class, 'fetchDataForApi']);



Route::get('dthistdoc', [DtHistDocController::class, 'index'])->name('dthistdoc.index')->middleware('admin');
Route::get('dthistdoc/create', [DtHistDocController::class, 'create'])->name('dthistdoc.create')->middleware('admin');
Route::post('dthistdoc/store', [DtHistDocController::class, 'store'])->name('dthistdoc.store')->middleware('admin');
Route::get ('dthistdoc/detail{id}', [DtHistDocController::class, 'detail'])->name('dthistdoc.detail')->middleware('admin');
Route::get('dthistdoc/edit/{id}', [DtHistDocController::class, 'edit'])->name('dthistdoc.edit')->middleware('admin');
Route::post('dthistdoc/update/{id}', [DtHistDocController::class, 'update'])->name('dthistdoc.update')->middleware('admin');
Route::delete('dthistdoc/destroy/{id}', [DtHistDocController::class, 'destroy'])->name('dthistdoc.destroy')->middleware('admin');

Route::delete('/detaildelete/{id}/{type}', [DtHistDocController::class, 'detaildelete'])->name('dthistdoc.detaildelete');

Route::get('docdept',[DocDeptController::class, 'index'])->name('docdept.index')->middleware('admin');
Route::get('docdept/create',[DocDeptController::class, 'create'])->name('docdept.create')->middleware('admin');
Route::post('docdept/store',[DocDeptController::class, 'store'])->name('docdept.store')->middleware('admin');
Route::delete('/docdept/destroy/{id}', [DocDeptController::class, 'destroy'])->name('docdept.destroy')->middleware('admin');


Route::get('dep', [DepController::class, 'index'])->name('dep.index')->middleware('admin');
Route::get('dep/create', [DepController::class, 'create'])->name('dep.create')->middleware('admin');
Route::post('dep/store', [DepController::class, 'store'])->name('dep.store')->middleware('admin');
Route::get('dep/edit/{id}', [DepController::class, 'edit'])->name('dep.edit')->middleware('admin');
Route::put('dep/update/{id}', [DepController::class, 'update'])->name('dep.update')->middleware('admin');
Route::delete('dep/destroy/{id}', [DepController::class, 'destroy'])->name('dep.destroy')->middleware('admin');

Route::get('/companies', [CompanyController::class, 'index'])->name('company.index')->middleware('admin');
Route::get('/companies/create', [CompanyController::class, 'create'])->name('company.create')->middleware('admin');
Route::post('/companies/store', [CompanyController::class, 'store'])->name('company.store')->middleware('admin');
Route::get('/companies/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit')->middleware('admin');
Route::put('/companies/update/{id}', [CompanyController::class, 'update'])->name('company.update')->middleware('admin');
Route::delete('/companies/destroy/{id}', [CompanyController::class, 'destroy'])->name('company.destroy')->middleware('admin');


//view
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/not-approved-url', [DashboardController::class, 'handleNotApprovedUrl'])->name('not.approved.url');
Route::get('/approved-url', [DashboardController::class, 'handleApprovedUrl'])->name('approved.url');


Route::get('/file-list', [FileListController::class, 'index'])->name('file.list')->middleware('auth');
Route::get('/view-files/{isoId}', [FileViewController::class, 'viewFiles'])->name('view.files')->middleware('auth');
Route::get('/view-folder-contents/{folder}', [FileViewController::class, 'viewDocument'])->name('view.folder.contents')->middleware('auth');
Route::get('/view-folder-all/{folder}', [FileViewController::class, 'viewDocumentall'])->name('view.folder.all')->middleware('auth');

Route::get('/view-pdf/{id}', [FileViewController::class, 'viewPdf'])->name('view.pdf')->middleware('auth');
Route::get('/view-pdfdoc/{id}', [FileViewController::class, 'viewPdfdoc'])->name('view.pdfdoc')->middleware('auth');
Route::get('/view-pdflampiran/{id}', [FileViewController::class, 'viewPdflampiran'])->name('view.pdflampiran')->middleware('auth');
Route::get('/view-pdfcatmut/{id}', [FileViewController::class, 'viewPdfcatmut'])->name('view.pdfcatmut')->middleware('auth');




Route::get('/register-document', [TiketController::class, 'registerDocument'])->name('register.document');
Route::get('/register-revision', [TiketController::class, 'registerRevision'])->name('register.revision');
Route::post('/documents/store', [TiketController::class, 'store'])->name('documents.store');










// Route::get('/', function () {
//     return view('welcome');
// });
