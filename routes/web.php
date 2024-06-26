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
use App\Http\Controllers\ApprovalController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'check.default.password']], function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    Route::get('/isos', [ISOController::class, 'index'])->name('isos.index')->middleware('admin');
    Route::get('/isos/create', [ISOController::class, 'create'])->name('isos.create')->middleware('admin');
    Route::post('/isos/store', [ISOController::class, 'store'])->name('isos.store')->middleware('admin');
    Route::get('/isos/edit/{id}', [ISOController::class, 'edit'])->name('isos.edit')->middleware('admin');
    Route::put('/isos/update/{id}', [ISOController::class, 'update'])->name('isos.update')->middleware('admin');
    Route::delete('/isos/destroy/{id}', [ISOController::class, 'destroy'])->name('isos.destroy')->middleware('admin');
    Route::get('/isos/all-documents', [ISOController::class, 'viewAllDocuments'])->name('isos.allDocuments')->middleware('admin');
    Route::get('/isos/view/{id}', [ISOController::class, 'view'])->name('isos.view');
    Route::get('/isos/user/', [ISOController::class, 'user'])->name('iso.view');



    Route::get('/types', [TypeController::class, 'index'])->name('types.index')->middleware('admin');
    Route::get('/types/create', [TypeController::class, 'create'])->name('types.create')->middleware('admin');
    Route::post('/types', [TypeController::class, 'store'])->name('types.store')->middleware('admin');
    Route::get('/types/edit/{id}', [TypeController::class, 'edit'])->name('types.edit')->middleware('admin');
    Route::put('/types/update/{id}', [TypeController::class, 'update'])->name('types.update')->middleware('admin');
    Route::delete('/types/destroy/{id}', [TypeController::class, 'destroy'])->name('types.destroy')->middleware('admin');

    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index')->middleware('admin');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create')->middleware('admin');
    Route::post('/documents', [DocumentController::class, 'store'])->name('document.store')->middleware('admin');
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

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/not-approved-url', [DashboardController::class, 'handleNotApprovedUrl'])->name('not.approved.url');
    Route::get('/approved-url', [DashboardController::class, 'handleApprovedUrl'])->name('approved.url');
    Route::get('tickets/released', [DashboardController::class, 'viewReleasedTickets'])->name('released.url');
    Route::get('/tickets/{ticketNumber}/edit-description', [DashboardController::class, 'editDescription'])->name('tickets.editDescription');
    Route::post('/tickets/{ticketNumber}/update-description', [DashboardController::class, 'updateDescription'])->name('tickets.updateDescription');
    Route::get('/new-document', [DashboardController::class,'showNewDocumentForm'])->name('new.document');

    Route::get('/file-list', [FileListController::class, 'index'])->name('file.list');
    Route::get('/view-files/{isoId}', [FileViewController::class, 'viewFiles'])->name('view.files');
    Route::get('/view-folder-contents/{folder}', [FileViewController::class, 'viewDocument'])->name('view.folder.contents');
    Route::get('/view-folder-all/{folder}', [FileViewController::class, 'viewDocumentall'])->name('view.folder.all');

    Route::get('/view-pdf/{id}', [FileViewController::class, 'viewPdf'])->name('view.pdf');
    Route::get('/view-pdfdoc/{id}', [FileViewController::class, 'viewPdfdoc'])->name('view.pdfdoc');
    Route::get('/view-pdflampiran/{id}', [FileViewController::class, 'viewPdflampiran'])->name('view.pdflampiran');
    Route::get('/view-pdfcatmut/{id}', [FileViewController::class, 'viewPdfcatmut'])->name('view.pdfcatmut');
    Route::get('/isos/all-document', [FileViewController::class, 'viewAllDocument'])->name('isos.allDocument');


    Route::get('/register-document', [TiketController::class, 'registerDocument'])->name('register.document');
    Route::get('/register-revision', [TiketController::class, 'registerRevision'])->name('register.revision');
    Route::post('/documents/store', [TiketController::class, 'store'])->name('documents.store');

    Route::put('tickets/{number_ticket}/release', [TiketController::class, 'releaseDocument'])->name('release.document');
    Route::get('/tickets/{ticketNumber}/files', 'App\Http\Controllers\DashboardController@viewTicketFiles')->name('view.ticket.files');
    Route::get('approval', [ApprovalController::class, 'index'])->name('approval.index');
    Route::put('tickets/{number_ticket}/approve', [ApprovalController::class, 'approveDocument'])->name('approve.document');
    Route::get('tickets/{number_ticket}', [DashboardController::class, 'showTicketDetail'])->name('ticket.detail');

    Route::get('/tickets/{ticketNumber}/reject', [ApprovalController::class, 'showRejectForm'])->name('tickets.rejectForm');
    Route::put('/tickets/{ticketNumber}/reject', [ApprovalController::class, 'rejectTicket'])->name('tickets.reject');

    Route::get('/chart-department', [DashboardController::class,'departmentChart'])->name('chart.page');
    Route::get('/dashboard-tickets', [DashboardController::class, 'dashboardticket'])->name('tickets.dashboard');

    Route::get('/departments/overview', [DashboardController::class, 'showDepartmentsWithTickets'])->name('departments.overview');

    Route::post('/approve/{code_emp}', [AuthController::class, 'approveUser'])->name('approveUser');
    Route::delete('/reject/{code_emp}', [AuthController::class, 'rejectUser'])->name('rejectUser');
    Route::get('/user/{code_emp}', [AuthController::class, 'userDetail'])->name('userDetail');
    Route::get('/viewapproved', [AuthController::class, 'viewapproved'])->name('viewapproved');
});

// Route untuk reset password
Route::get('admin/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('admin.reset-password.form');
Route::post('admin/reset-password', [AuthController::class, 'resetPassword'])->name('admin.reset-password');
Route::get('reset-password', [AuthController::class, 'showSetNewPasswordForm'])->name('user.reset-password.form');
Route::post('reset-password', [AuthController::class, 'setNewPassword'])->name('user.reset-password');
