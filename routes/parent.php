<?php
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Parents\dashboard\ChildrenController;


/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

        Route::get('/parent/dashboard',[ChildrenController::class,'index'])->name('parents');
        Route::get('/Children',[ChildrenController::class,'Children'])->name('Children');
        Route::get('/ResultsChildren/{id}',[ChildrenController::class,'ResultsChildren'])->name('ResultsChildren');
        Route::get('/attendances',[ChildrenController::class,'attendances'])->name('attendances');
        Route::post('/AttendanceSearch',[ChildrenController::class,'AttendanceSearch'])->name('attendance.search');
        Route::get('/fees',[ChildrenController::class,'Fees'])->name('fees');
        Route::get('/receipt/{id}',[ChildrenController::class,'Receipt'])->name('receipt');
        Route::get('/profile',[ChildrenController::class,'Profile'])->name('profile');
        Route::post('/profile/{id}',[ChildrenController::class,'update'])->name('profile.update');



    });