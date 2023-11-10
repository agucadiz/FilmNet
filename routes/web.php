<?php

use App\Http\Controllers\AudiovisualController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CriticaController;
use App\Models\Audiovisual;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//rutas

//Peliculas: separa las rutas por secciones.

Route::get('/', [AudiovisualController::class, 'index'])->name('home.index');
Route::get('/audiovisual/{audiovisual}', [AudiovisualController::class, 'show'])->name('audiovisual.show');
Route::get('peliculas', [AudiovisualController::class, 'peliculasIndex'])->name('peliculas.index');
Route::get('series', [AudiovisualController::class, 'seriesIndex'])->name('series.index');
Route::get('documentales', [AudiovisualController::class, 'documentalesIndex'])->name('documentales.index');

//Rutas logueado.

Route::get('mis_votaciones', [UserController::class, 'misVotaciones'])->name('votaciones.index');
Route::get('mis_criticas', [UserController::class, 'misCriticas'])->name('criticas.index');
Route::get('pendientes', [UserController::class, 'pendientes'])->name('pendientes.index');
Route::get('amigos', [UserController::class, 'misAmigos'])->name('amigos.index');






require __DIR__.'/auth.php';
