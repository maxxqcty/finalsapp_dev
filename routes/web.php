<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to projects index
Route::get('/', function () {
    return redirect()->route('projects.index');
});

// Resourceful routes for Project CRUD
Route::resource('projects', ProjectController::class);