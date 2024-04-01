<?php

use Src\Route;

Route::add(['GET', 'POST'], '/', [Controller\Site::class, 'index']);
Route::add(['GET', 'POST'], '/employee', [Controller\Site::class, 'employee']);
Route::add(['GET', 'POST'], '/post', [Controller\Site::class, 'post']);
Route::add(['GET', 'POST'], '/composition', [Controller\Site::class, 'composition']);
Route::add(['GET', 'POST'], '/unit', [Controller\Site::class, 'unit']);
Route::add(['GET', 'POST'], '/search', [Controller\Site::class, 'search']);
Route::add(['GET', 'POST'], '/view', [Controller\Site::class, 'view']);
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);