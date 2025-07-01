<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HouseSearchController;

Route::get('/api/houses', [HouseSearchController::class, 'index']);
