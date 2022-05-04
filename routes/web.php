<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;

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

Route::group(['middleware' => ['auth']], function(){
    Route::prefix('tarefas')->name('tarefas.')->group(function(){
        Route::get('/index', [TarefaController::class, 'index'])->name('index');
        Route::post('/salvar', [TarefaController::class, 'salvar'])->name('salvar');
        Route::get('/edit/{id}', [TarefaController::class, 'edit'])->name('edit');
        Route::post('/update', [TarefaController::class, 'update'])->name('update');
        Route::get('/create', [TarefaController::class, 'create'])->name('create');
        Route::get('/show/{id}', [TarefaController::class, 'show'])->name('show');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
