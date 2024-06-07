<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [MemberController::class, 'leaderboard']);

Route::resource('members', MemberController::class);
Route::resource('games', GameController::class);
