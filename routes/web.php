<?php

use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\ClassRoom\ClassController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Teachers\TeachersController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::group(['middleware' => ['guest']],function(){

    Route::get('/',function(){
        return view('auth.login');
    });
    
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth'],
    ],
    function () {
        // Route::get('/', function () {
        //     return view('dashboard');
        // });

        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
        Route::resource('/grades',GradeController::class);
        Route::resource('/classes', ClassController::class);
        Route::post('/delete_all',[ClassController::class,'delete_all'])->name('delete_all');
        Route::post('/filter_class',[ClassController::class,'filter_class'])->name('filter_class');
        Route::resource('/Sections',SectionController::class);
        Route::get('/calses/{id}',[SectionController::class, 'clasessection']);
    });

    Route::get('test',function(){
        return  view ('test') ;
    });
Route::view('addparents','livewire.showform')->name('addparents');
Route::resource('/Teachers',TeachersController::class);