<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentsController;

Route::get('/universities/{university}/departments', [DepartmentsController::class, 'getByUniversity']);
