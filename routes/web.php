<?php

use App\Http\Controllers\Documents\DocumentController;
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

Route::prefix('documents')->name('documents.')->group(function(){
    Route::get('/', [DocumentController::class, 'index'])->name('index');
    Route::post('/import-document', [DocumentController::class, 'importDocument'])->name('import-document');
    Route::post('/process-document', [DocumentController::class, 'processDocument'])->name('process-document');
});
