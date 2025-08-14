<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\PermissionController as AdminPermissionController;

// Customers CRUD
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CommessaController;
use App\Http\Controllers\PreventivoController;
use App\Http\Controllers\PreventivoRigaController;
use App\Http\Controllers\FatturaController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\MovimentoMagazzinoController;
use App\Http\Controllers\ArticoloController;
use App\Http\Controllers\CategoriaArticoloController;
use App\Http\Controllers\FornitoreController;
use App\Http\Controllers\CompanyIdentityController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Web auth (pubbliche)
Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [WebAuthController::class, 'login'])->name('login.perform');
Route::get('/register', [WebAuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [WebAuthController::class, 'register'])->name('register.perform');


// Route protette da autenticazione
Route::middleware('auth')->group(function () {
    Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout.perform');
    // Dashboard
    Route::get('/dashboard', function () {
        $companyIdentity = App\Models\CompanyIdentity::getActiveIdentity();
        return view('dashboard', [ 
            'companyName' => $companyIdentity ? $companyIdentity->company_name : 'Azienda Demo',
            'companyIdentity' => $companyIdentity
        ]);
    })->name('dashboard');
    
    // Activity
    Route::view('/activity/overview', 'dashboard')->name('activity.overview');
    Route::view('/activity/analytics', 'dashboard')->name('activity.analytics');
    Route::get('/activity/projects', [ProjectController::class, 'index'])->name('activity.projects');

    // Sales
    Route::view('/sales/quotes', 'dashboard')->name('sales.quotes');
    Route::view('/sales/invoices', 'dashboard')->name('sales.invoices');

    // Other links placeholders
    Route::view('/tasks', 'dashboard')->name('tasks');
    Route::view('/reporting', 'dashboard')->name('reporting');
    Route::view('/help', 'dashboard')->name('help');
    Route::view('/settings', 'dashboard')->name('settings');

    // Customers CRUD
    Route::resource('customers', CustomerController::class);

    // Projects CRUD
    Route::resource('projects', ProjectController::class);

    // Commesse CRUD
    Route::resource('commesse', CommessaController::class);
    Route::get('/customers/{customer}/commesse', [CommessaController::class, 'byCustomer'])->name('customers.commesse');
    Route::get('/commesse/{id}/pdf', [CommessaController::class, 'generatePdf'])->name('commesse.pdf');
    
    // Preventivi CRUD
    Route::resource('preventivi', PreventivoController::class);
    Route::get('/customers/{customer}/preventivi', [PreventivoController::class, 'byCustomer'])->name('customers.preventivi');
    Route::get('/commesse/{commessa}/preventivi', [PreventivoController::class, 'byCommessa'])->name('commesse.preventivi');
    
    // Righe Preventivo
    Route::get('/preventivo-righe/{riga}', [PreventivoRigaController::class, 'show'])->name('preventivo-righe.show');
    Route::post('/preventivo-righe', [PreventivoRigaController::class, 'store'])->name('preventivo-righe.store');
    Route::put('/preventivo-righe/{riga}', [PreventivoRigaController::class, 'update'])->name('preventivo-righe.update');
    Route::delete('/preventivo-righe/{riga}', [PreventivoRigaController::class, 'destroy'])->name('preventivo-righe.destroy');
    Route::post('/preventivo-righe/{riga}/duplicate', [PreventivoRigaController::class, 'duplicate'])->name('preventivo-righe.duplicate');
    Route::post('/preventivo-righe/order', [PreventivoRigaController::class, 'updateOrder'])->name('preventivo-righe.order');
    Route::get('/preventivo-righe/search-articoli', [PreventivoRigaController::class, 'searchArticoli'])->name('preventivo-righe.search-articoli');

    // Fatture CRUD
    Route::resource('fatture', FatturaController::class);
    Route::get('/customers/{customer}/fatture', [FatturaController::class, 'byCustomer'])->name('customers.fatture');
    Route::get('/commesse/{commessa}/fatture', [FatturaController::class, 'byCommessa'])->name('commesse.fatture');
    Route::get('/preventivi/{preventivo}/fatture', [FatturaController::class, 'byPreventivo'])->name('preventivi.fatture');
    Route::get('/fatture/{id}/pdf', [FatturaController::class, 'generatePdf'])->name('fatture.pdf');
Route::get('/preventivi/{id}/pdf', [PreventivoController::class, 'generatePdf'])->name('preventivi.pdf');

    // Pagamenti CRUD
    Route::resource('pagamenti', PagamentoController::class);
    Route::get('/fatture/{fattura}/pagamenti', [PagamentoController::class, 'byFattura'])->name('fatture.pagamenti');
    
    // Articoli
    Route::resource('articoli', ArticoloController::class);
    
    // Categorie Articoli
    Route::resource('categoria-articoli', CategoriaArticoloController::class);
    
    // Fornitori
    Route::resource('fornitori', FornitoreController::class);
    
    // Identità Aziendale
    Route::resource('company-identity', CompanyIdentityController::class);
    Route::patch('/company-identity/{companyIdentity}/toggle-status', [CompanyIdentityController::class, 'toggleStatus'])->name('company-identity.toggle-status');
    
    // Movimenti Magazzino
    Route::resource('movimenti-magazzino', MovimentoMagazzinoController::class);
    Route::get('/movimenti-magazzino/report', [MovimentoMagazzinoController::class, 'report'])->name('movimenti-magazzino.report');
    Route::get('/articoli/{articolo}/movimenti', [MovimentoMagazzinoController::class, 'byArticolo'])->name('articoli.movimenti');

    // Admin Users (solo admin)
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['role:admin'])
        ->group(function () {
            Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
            Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        });
});