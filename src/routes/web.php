<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoricController;
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

//controllor for documents with all the resources created
Route::resource('/documents', DocumentController::class);




//controller for metadata with all the resources created ^^
Route::resource('/Mdata', MetadataController::class);




Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/users', \App\Http\Controllers\UserController::class);

    Route::resource('/userTypes', \App\Http\Controllers\UserTypeController::class);

    Route::resource('/historics', \App\Http\Controllers\HistoricController::class);

    Route::resource('/documents', \App\Http\Controllers\DocumentController::class);

    Route::resource('/departments', DepartmentController::class);

    Route::resource('/documentsPermitions', DocumentPermitionController::class);
});


//upload files
Route::resource('/uploadfile', \App\Http\Controllers\UploadFileController::class);


//send email
/*

Route::get('/sendbasicemail',\App\Http\Controllers\MailController::class, 'basic_email');
Route::get('/sendhtmlemail',\App\Http\Controllers\MailController::class,'html_email');
Route::get('/sendattachmentemail',\App\Http\Controllers\MailController::class,'attachment_email');
*/






require __DIR__.'/auth.php';
