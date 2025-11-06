<?php

use App\Livewire\Documentos\DocumentosIndex;
use App\Livewire\Index;
use App\Livewire\Inventario\InventarioIndex;
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