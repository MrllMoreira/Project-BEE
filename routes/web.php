<?php

use App\Livewire\Documentos\DocumentosIndex;
use App\Livewire\Index;
use App\Livewire\Inventario\InventarioIndex;
use App\Livewire\Unidade\UnidadeIndex;
use App\Livewire\Usuario\UsuarioShow;
use App\Livewire\Usuario\UsuarioIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


Route::get('/dashboard', Index::class)->name('dashboard');

Route::get('/documentos', DocumentosIndex::class)->name('documentos');  

Route::get('/inventario', InventarioIndex::class)->name('inventario');  

Route::get('/unidade', UnidadeIndex::class)->name('unidade');  

Route::get('/usuario', UsuarioIndex::class)->name('usuario');  
Route::get('/usuario/{id}', UsuarioShow::class)->name('usuario.show');  