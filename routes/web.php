<?php

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

Route::get('/', function () { return Inertia('Login'); });
Route::get('/register', function () { return Inertia('Register'); });
Route::get('/expenses', function () { return Inertia('Dashboard'); });
Route::get('/expenses/create', function () { return Inertia('Create'); });
Route::get('/expenses/edit/{id}', function () { return Inertia('Edit'); });