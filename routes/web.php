<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::resource('members', MemberController::class);
Route::resource('games', GameController::class);

