<?php


use App\Core\Routing\Route;
use App\Controllers\HomeController;
use App\Controllers\ContactController;

Route::post('/contact/add', [ContactController::class, 'add']);
Route::get('/', [HomeController::class, 'index']);









