<?php

use Src\Route;
Route::add(['GET', 'POST'], '/', [Controller\Site::class, 'index'])->middleware('auth');
Route::add(['GET', 'POST'], '/employee', [Controller\Site::class, 'employee'])->middleware('employee');
Route::add(['GET', 'POST'], '/post', [Controller\Site::class, 'post'])->middleware('employee');
Route::add(['GET', 'POST'], '/composition', [Controller\Site::class, 'composition'])->middleware('employee');
Route::add(['GET', 'POST'], '/unit', [Controller\Site::class, 'unit'])->middleware('employee');
Route::add(['GET', 'POST'], '/view', [Controller\Site::class, 'view'])->middleware('employee');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup'])->middleware('admin');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);