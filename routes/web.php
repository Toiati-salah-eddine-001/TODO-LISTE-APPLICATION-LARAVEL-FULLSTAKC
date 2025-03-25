<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[UserController::class,'login_f']);
Route::get('/logine',[UserController::class,'login'])->name('login');

Route::get('/signUp',[UserController::class,'register_f'])->name('signUp');
Route::post('/signUp',[UserController::class,'register'])->name('register');


Route::get('/dashbord', [TaskController::class, 'dashbord'])->name('dashboard')->middleware('auth');
Route::get('/userpage', [TaskController::class, 'userpage'])->name('userpage');


Route::post('/userpage',  [TaskController::class, 'AddTask'])->name('AddTask');
Route::get('/update',  [TaskController::class, 'IsUpdate'])->name('IsUpdate');
Route::post('/update/{id}',  [TaskController::class, 'update'])->name('update');
Route::delete('/Delet/{id}',  [TaskController::class, 'Delet'])->name('Delet');
Route::put('/Progresse/{id}',  [TaskController::class, 'Progresse'])->name('Progresse');


Route::get('/AdmineAllTask/{typeData?}', [TaskController::class, 'AdmineAllTask'])->name('AdmineAllTask');
