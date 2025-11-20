<?php

use App\Livewire\Documentos\DocumentosIndex;

use App\Livewire\Equipamento\Show as EquipamentosShow;
use App\Livewire\Equipamento\EquipamentoIndex;
use App\Livewire\Index;
use App\Livewire\Inventario\InventarioIndex;
use App\Livewire\Unidade\Show as UnidadeShow; 
use App\Livewire\Unidade\UnidadeIndex;
use App\Livewire\Usuario\Show as UsuarioShow;


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


Route::middleware(['auth', 'secretaria.acesso'])->group(function () {
    Route::get('/{idUnidade}/inventario', InventarioIndex::class)->name('inventario');  
    Route::get('/{idUnidade}/inventario/{idInventario}/equipamentos', EquipamentoIndex::class)->name('equipamento');
    Route::get('{idUnidade}/inventario/{idInventario}/equipamentos/{id}', EquipamentosShow::class)->name('equipamento.show');

    Route::get('/unidade', UnidadeIndex::class)->name('unidade');  
    Route::get('/unidade/{id}', UnidadeShow::class)->name('unidade.show');  
});

Route::middleware(['auth', 'admin.acesso'])->group(function () { 
    Route::get('/usuario', UsuarioIndex::class)->name('usuario');  
    Route::get('/usuario/{id}', UsuarioShow::class)->name('usuario.show');  
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Index::class)->name('dashboard');
    Route::get('/documentos', DocumentosIndex::class)->name('documentos');  
});

