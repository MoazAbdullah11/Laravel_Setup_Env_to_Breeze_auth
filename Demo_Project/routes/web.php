<?php

// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });




use App\Http\Controllers\StudentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AuthController;


Route::get('/students', [StudentController::class, 'index']);
// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [FormController::class, 'showForm'])->name('form');
Route::post('/submit', [FormController::class, 'handleForm'])->name('submit.form');
Route::get('/edit/{id}', [FormController::class, 'editForm'])->name('edit.form');
Route::put('/update/{id}', [FormController::class, 'updateForm'])->name('update.form');
Route::delete('/delete/{id}', [FormController::class, 'deleteForm'])->name('delete.form');



// Registration
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Your form routes (after login)
Route::middleware('auth')->group(function () {
    Route::get('/form', [FormController::class, 'index'])->name('form');
    Route::post('/form-submit', [FormController::class, 'handleForm'])->name('submit.form');
    // other form related routes...
});
