<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DepartmentController;
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
    return view('welcome-pw');
})->name('inicio');

//main dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
});


//register
Route::get('/auth/register', function(){
    return view('register');
});






//controllor for documents with all the resorces created
Route::resource('/documents', DocumentController::class);


//controller for deparments with all the resurces created ^^
Route::resource('/deparments', DepartmentController::class);





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});




require __DIR__.'/auth.php';
