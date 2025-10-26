<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('sections.index');
});

Route::resource('sections', SectionController::class);
Route::resource('students', StudentController::class);
Route::get('sections/{section}/students', [SectionController::class, 'students'])->name('sections.students');
