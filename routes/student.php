<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students\dashboard\ExamsController;
use App\Http\Controllers\Students\dashboard\ProfileController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [   
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ], function () {

    //==============================dashboard============================
    Route::get('/student/dashboard', function () {
        return view('pages.Students.dashboard.dashboard');
    });
    Route::controller(ExamsController::class)->group(function () {
        
          Route::resource('/StudentExams',ExamsController::class);
          Route::get('/StudentExams/{id}','show')->name('show');
          
});
Route::resource('/Profile',ProfileController::class);

});