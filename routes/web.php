<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DpsController;
use App\Http\Controllers\DpsTypeController;
use App\Http\Controllers\FdrController;
use App\Http\Controllers\FdrTypeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanTypeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Models\Member;
use Illuminate\Support\Facades\App;
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
Route::get('/', function(){
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'is_active'])->prefix('dashboard')->group(function(){

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // set language
    Route::get("locale/{lang}", function($lang){
        App::setLocale($lang);
        session()->put('language', $lang);
        return redirect()->route("dashboard");
    })->name("set.locale");

    Route::get('/member-details', function() {
        $member = Member::findOrFail(request()->member);
        return view('includes.member', compact("member"));
    })->name('member.details');

    // member module
    Route::resource("member", MemberController::class);
    // saving module
    Route::resource("savings", SavingController::class);
    // dps type module
    Route::resource("dpsType", DpsTypeController::class);
    // dps module
    Route::resource("dps", DpsController::class);
    // fdr type module
    Route::resource('fdrtype', FdrTypeController::class);
    // fdr module
    Route::resource('fdr', FdrController::class);
    // loan type
    Route::resource("loanType", LoanTypeController::class);
    // loan
    Route::resource('loan', LoanController::class);

    /**
     * loan collection
     */
    Route::prefix('collection')->name('collection.')->group(function () {
        Route::get('loan', [CollectionController::class, 'loanCollection'])->name('loan');
        Route::post('loan/{loan}', [CollectionController::class, 'storeLoanCollection'])->name('loan.store');
        Route::get('dps', [CollectionController::class, 'dps'])->name('dps');
        Route::post('dps/{dps}', [CollectionController::class, 'storeDpsCollection'])->name('dps.store');
    });


    // group modlue
    Route::resource("group", GroupController::class);
    // area module
    Route::resource("area", AreaController::class);
    // branch module
    Route::resource("branch", BranchController::class);

    // activity module
    Route::resource("activity", ActivityController::class);

    // language module
    Route::get('/translate/{language}', [LanguageController::class, 'translate'])->name("translate");
    Route::post('/translate/{language}', [LanguageController::class, 'translateStore'])->name("translate.store");
    Route::resource('language', LanguageController::class);

    // User Module
    Route::controller(UserController::class)->group(function(){
        Route::get('/users', 'index')->name('users');
        Route::get('/users/create', 'create')->name('users.create');
        Route::post('/users/create', 'store')->name('users.create');
        Route::get('/users/{user}', 'show')->name('users.show');
        Route::get('/users/{user}/edit', 'edit')->name('users.edit');
        Route::get('/users/assign-permission/{user}', 'assign_permission')->name('users.permission');
        Route::post('/users/assign-permission/{user}', 'assign_permission_store')->name('users.permission');
        Route::put('/users/{user}', 'update')->name('users.update');
        Route::delete('/delete/{user}', 'destroy')->name('users.destroy');
    });

    // Role Module
    Route::resource('roles', RoleController::class);
    Route::get('permission/{role}', [RoleController::class, 'permission'])->name('permission');
    Route::post('permission/{role}', [RoleController::class, 'permission_store'])->name('permission');


    // settings
    Route::prefix('settings')->group(function(){
        Route::get('general', [SettingsController::class, 'index'])->name('settings.general');
        Route::post('general', [SettingsController::class, 'store'])->name('settings.general');
    });

});

require __DIR__.'/auth.php';
