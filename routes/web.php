<?php

use App\Http\Controllers\Admin\EntrepriseController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ImportationController as AdminImportationController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StockController as AdminStockController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\EventController as FrontEventController;
use App\Http\Controllers\Front\ImportationController;
use App\Http\Controllers\Front\StockController;
use App\Http\Controllers\Front\WelcomeController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\CheckPrivilege;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', [ImportationController::class, 'index'])->name('importation');
Route::get('/form/stock', [StockController::class, 'index'])->name('stock');

Route::post('/importation', [ImportationController::class, 'create'])->name('importation');
Route::post('/stock', [StockController::class, 'create'])->name('stock');

Route::get('/contact', [WelcomeController::class, 'contact'])->name('contact');
Route::post('/contact', [WelcomeController::class, 'sendMessage'])->name('sendMessage');

Route::get('/events', [FrontEventController::class, 'index'])->name('events');
Route::get('/event/{event}', [FrontEventController::class, 'item'])->name('event');

Route::post('/attendee/{event}', [FrontEventController::class, 'storeAttendee'])->name('event.attendee');
Route::post('/compagnie/{event}', [FrontEventController::class, 'storeCompagnie'])->name('event.compagnie');

Route::get('/print/{registration}', [FrontEventController::class, 'print'])->name('event.print.ticket');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function ($id, $hash, Request $request) {
    $user = User::findOrFail($id);
    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }
    return redirect('/login');
})->middleware(['signed'])->name('verification.verify');

Auth::routes();

Route::get('log-out', function () {
    Auth::logout();
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    /*
    | Admlinistrateur
    */
    Route::prefix('admin')->namespace('Admin')->middleware([Admin::class])->group(function () {
        Route::get('/dashboard', [EntrepriseController::class, 'index'])->name('dashboard');
        Route::get('/', [EntrepriseController::class, 'index']);

        //user_type
        Route::get('user-types', [UserController::class, 'userType'])->name('admin.list.user-type');

        //role
        Route::get('roles', [RoleController::class, 'index'])->name('admin.list.role');
        Route::post('role/delete/{_id}', [RoleController::class, 'update'])->name('admin.delete.role');
        Route::post('role', [RoleController::class, 'save'])->name('admin.store.role');
        Route::post('role/edit/{_id}', [RoleController::class, 'update'])->name('admin.update.role');
        Route::post('edit-role', [RoleController::class, 'edit'])->name('admin.edit.role');
        Route::get('delete-role/{role}', [RoleController::class, 'delete'])->name('admin.delete.role');

        Route::post('role-user', [RoleController::class, 'roleUser'])->name('admin.assign.role');
        Route::post('role-privilege', [RoleController::class, 'rolePrivilege'])->name('admin.assign.privilige');

        //privilege
        Route::get('privileges', [RoleController::class, 'privileges'])->name('admin.list.privilege');
        Route::post('privilege/delete/{_id}', [RoleController::class, 'updatePrivilege'])->name('admin.delete.privilege');
        Route::post('privilege', [RoleController::class, 'savePrivilege'])->name('admin.store.privilege');
        Route::post('privilege/edit/{_id}', [RoleController::class, 'updatePrivilege'])->name('admin.update.privilege');
        Route::post('edit-privilege', [RoleController::class, 'editPrivilege'])->name('admin.edit.privilege');

        //user
        Route::get('list-users', [UserController::class, 'users'])->name('admin.list.user');
        Route::post('user-create', [UserController::class, 'store'])->name('admin.user.create');
        Route::post('user-edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('user-assign', [UserController::class, 'assign'])->name('admin.user.assign');
        Route::post('user-update/{user}', [UserController::class, 'update'])->name('admin.user.update');
        Route::post('user-assign-role', [UserController::class, 'assignRole'])->name('admin.user.assign.role');

        Route::get('profil', [UserController::class, 'profil'])->name('admin.profil.user');
        Route::post('profil/update', [UserController::class, 'updateProfil'])->name('admin.profil.update');
        Route::post('profil/password/{user}', [UserController::class, 'updatePassword'])->name('admin.profil.password');


        //entreprise
        Route::get('/entreprise', [EntrepriseController::class, 'entreprise'])->name('admin.entreprise');
        Route::post('/get/entreprise', [EntrepriseController::class, 'ajaxItem'])->name('get-entreprise');
        Route::get('/ajax/entreprises', [EntrepriseController::class, 'ajaxList'])->name('list-entreprise');
        Route::post('/update/entreprise/{entreprise}', [EntrepriseController::class, 'update'])->name('update.entreprise');

        //importations
        Route::get('/importation', [AdminImportationController::class, 'index'])->name('admin.importation');
        Route::get('/importation/{importation}', [AdminImportationController::class, 'item'])->name('admin.importation.item');
        Route::get('/export/importation/{importation}', [AdminImportationController::class, 'export'])->name('export.importation');
        Route::post('/update/importation/{importation}', [AdminImportationController::class, 'update'])->name('update.importation');
        Route::post('/update-state/importation/{importation}', [AdminImportationController::class, 'updateState'])->name('update.state.importation');
        Route::post('/get/importation', [AdminImportationController::class, 'ajaxItem'])->name('get-importation');
        Route::get('/ajax/importations', [AdminImportationController::class, 'ajaxList'])->name('list-importation');

        //stocks
        Route::get('/stock', [AdminStockController::class, 'index'])->name('admin.stock');
        Route::get('/stock/{stock}', [AdminStockController::class, 'item'])->name('admin.stock.item');
        Route::get('/export/stock/{stock}', [AdminStockController::class, 'export'])->name('export.stock');
        Route::post('/update/stock/{stock}', [AdminStockController::class, 'update'])->name('update.stock');
        Route::post('/update-state/stock/{stock}', [AdminStockController::class, 'updateState'])->name('update.state.stock');
        Route::post('/note/stock/{stock}', [AdminStockController::class, 'note'])->name('note.stock');
        Route::post('/get/stock', [AdminStockController::class, 'ajaxItem'])->name('get-stock');
        Route::get('/ajax/stocks', [AdminStockController::class, 'ajaxList'])->name('list-stock');

        //activites
        Route::get('/activite', [SettingController::class, 'activite'])->name('admin.activite');
        Route::post('/activite', [SettingController::class, 'createActivite'])->name('create.activite');
        Route::post('/activite/update/{activite}', [SettingController::class, 'updateActivite'])->name('update.activite');

        //type de declaration
        Route::get('/declaration', [SettingController::class, 'declaration'])->name('admin.declaration');
        Route::post('/declaration', [SettingController::class, 'createDeclaration'])->name('create.declaration');
        Route::post('/declaration/update/{declaration}', [SettingController::class, 'updateDeclaration'])->name('update.declaration');

        //type de produit
        Route::get('/product', [SettingController::class, 'product'])->name('admin.product');
        Route::post('/product', [SettingController::class, 'createProduct'])->name('create.product');
        Route::post('/product/update/{product}', [SettingController::class, 'updateProduct'])->name('update.product');

        //moyen logistique
        Route::get('/logistic', [SettingController::class, 'logistic'])->name('admin.logistic');
        Route::post('/logistic', [SettingController::class, 'createLogistic'])->name('create.logistic');
        Route::post('/logistic/update/{logistic}', [SettingController::class, 'updateLogistic'])->name('update.logistic');

        //event
        Route::get('/event', [EventController::class, 'index'])->name('admin.event');
        Route::post('/get/event', [EventController::class, 'ajaxItem'])->name('get-event');
        Route::get('/ajax/events', [EventController::class, 'ajaxList'])->name('list-event');
        Route::post('/event', [EventController::class, 'create'])->name('create.event');
        Route::post('/update/event/{event}', [EventController::class, 'update'])->name('update.event');


        //ticket
        Route::get('/ticket', [TicketController::class, 'index'])->name('admin.ticket');
        Route::post('/get/ticket', [TicketController::class, 'ajaxItem'])->name('get-ticket');
        Route::get('/ajax/tickets', [TicketController::class, 'ajaxList'])->name('list-ticket');
        Route::post('/ticket', [TicketController::class, 'create'])->name('create.ticket');
        Route::post('/update/ticket/{ticket}', [TicketController::class, 'update'])->name('update.ticket');

        //registration
        Route::get('/registration/{event}', [RegistrationController::class, 'index'])->name('admin.registration');
        Route::post('/get/registration', [RegistrationController::class, 'ajaxItem'])->name('get-registration');
        Route::post('/update/registration/{registration}', [RegistrationController::class, 'update'])->name('update.registration');
        Route::get('/ajax/compagnie/registrations/{event}', [RegistrationController::class, 'ajaxListCompagnie'])->name('list-compagnie-registration');
        Route::get('/ajax/attendee/registrations/{event}', [RegistrationController::class, 'ajaxListAttendee'])->name('list-attendee-registration');
    });
});
