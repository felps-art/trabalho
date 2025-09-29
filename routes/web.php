<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResenhaController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\EditoraController;
use Illuminate\Support\Facades\Route;

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

// Página inicial
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Perfil de usuários
Route::get('/usuarios', [UserProfileController::class, 'index'])->name('users.index');
Route::get('/usuario/{id}', [UserProfileController::class, 'show'])->name('profile.show');
Route::get('/usuario/{id}/posts', [UserProfileController::class, 'posts'])->name('user.posts');

// Rotas de perfil do usuário logado
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil/editar', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/perfil/atualizar', [UserProfileController::class, 'update'])->name('profile.update');
});

// Resenhas (Posts)
Route::resource('resenhas', ResenhaController::class)->middleware(['auth']);

// Outros recursos
Route::resource('livros', LivroController::class);
Route::resource('autores', AutorController::class);
Route::resource('editoras', EditoraController::class);

// Rota de fallback para SPA (se estiver usando Vue/React)
Route::get('/{any}', function () {
    return view('dashboard');
})->where('any', '.*');