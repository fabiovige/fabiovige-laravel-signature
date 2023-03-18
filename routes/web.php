<?php

use App\Enums\SignatureStatus;
use App\Http\Controllers\EmployeeAddressController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignatureController;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Plan;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/test', [SignatureController::class, 'index']);

Route::match(['POST', 'PUT', 'GET'],'/routes', fn() => 'teste');

Route::resource('funcionario', EmployeeController::class)
    ->parameters([
        'funcionario' => 'employee'
    ]);

Route::get('userland', fn() => 'access granted')
    ->middleware('checkToken:simple-token');

Route::resource('funcionario.endereco', EmployeeAddressController::class)
    ->parameters([
        'funcionario' => 'employee',
        'endereco' => 'address'
    ])->except(['index', 'destroy']);

Route::resource('plan', PlanController::class)
    ->withoutMiddleware([
        TrustProxies::class,
        VerifyCsrfToken::class
    ])
    ->parameters([
        'plan' => 'plan:cod'
    ]);
