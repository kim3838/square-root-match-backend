<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/get-match', [\App\Http\Controllers\MatchController::class, 'getMatch']);
