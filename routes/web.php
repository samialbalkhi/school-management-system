<?php

use App\Http\Controllers\Attendance\AttendanceController;
use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Grade\GradeController;

use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\ClassRoom\ClassController;
use App\Http\Controllers\Receipt\ReceiptController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Students\StudentsController;
use App\Http\Controllers\Teachers\TeachersController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\students\PromotionController;
use App\Http\Controllers\Students\FeesinvoicesController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\PaymentStudent\PaymentStudentController;
use App\Http\Controllers\StudentPremium\StudentpremiumController;

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

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth'],
    ],
    function () {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
        Route::resource('/grades', GradeController::class);
        Route::resource('/classes', ClassController::class);
        Route::post('/delete_all', [ClassController::class, 'delete_all'])->name('delete_all');
        Route::post('/filter_class', [ClassController::class, 'filter_class'])->name('filter_class');
        Route::resource('/Sections', SectionController::class);
        Route::get('/calses/{id}', [SectionController::class, 'clasessection']);
    },
);

////////////// parents        ///////////////////
Route::view('addparents', 'livewire.showform')->name('addparents');

/////////     Teachers       /////////////////
Route::resource('/Teachers', TeachersController::class);

/////////////  student      .///////
Route::resource('/Students', StudentsController::class);
Route::get('/getclasses/{id}', [StudentsController::class, 'getclassesroom']);
Route::get('/getsections/{id}', [StudentsController::class, 'getsection']);
Route::post('/attachment', [StudentsController::class, 'attachments'])->name('attachments_route');
Route::get('/Download_attachment/{studentsname}/{filename}', [StudentsController::class, 'Download_attachment'])->name('Download_attachment');
Route::post('/Delete_attachment/{id}', [StudentsController::class, 'Delete_attachment'])->name('Delete_attachment');

///    promotions students        /////////////////
Route::resource('/promotions', PromotionController::class);
Route::delete('/delete_promotion', [PromotionController::class, 'delete_promotion'])->name('Delete_promotion');

////////// Graduated      /////////////////

Route::resource('/graduated', GraduatedController::class);

//////////////////////  Fees          //////////////////
Route::resource('/fees', FeesController::class);

///////  Feesinvoices    /////////

Route::resource('/feesinvoices', FeesinvoicesController::class);

//////////          Receipt   /////////////
Route::resource('/receipt', ReceiptController::class);

/////////            PaymentStudent      ////////////////
Route::resource('/paymentStudent',PaymentStudentController::class);

//////////            StudentPremium         /////////////// 

Route::resource('/StudentPremium',StudentpremiumController::class);

Route::resource('/Attendance',AttendanceController::class);