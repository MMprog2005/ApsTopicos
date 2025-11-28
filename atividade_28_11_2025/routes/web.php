<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;

Route::get('/', function(){
    return redirect()->route('recipes.index');
});

Route::resource('recipes', RecipeController::class);

// Rotas simples de autenticação com sessão
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// proteger rotas de criação/edição/exclusão (middleware custom)
Route::middleware('auth.simple')->group(function(){
    Route::get('recipes/create', [RecipeController::class,'create'])->name('recipes.create');
    Route::post('recipes', [RecipeController::class,'store'])->name('recipes.store');
    Route::get('recipes/{recipe}/edit', [RecipeController::class,'edit'])->name('recipes.edit');
    Route::put('recipes/{recipe}', [RecipeController::class,'update'])->name('recipes.update');
    Route::delete('recipes/{recipe}', [RecipeController::class,'destroy'])->name('recipes.destroy');
});

