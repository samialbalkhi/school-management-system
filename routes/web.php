<?php

use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Exam\ExamController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Quizz\QuizzController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\ClassRoom\ClassController;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Controllers\Receipt\ReceiptController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Students\StudentsController;
use App\Http\Controllers\Teachers\TeachersController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\students\PromotionController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Students\FeesinvoicesController;
use App\Http\Controllers\Classonline\ClassonlineController;
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

Route::get('/', [HomeController::class, 'index'])->name('selection');

Route::get('/login/{type}', [LoginController::class, 'loginForm'])
    ->middleware('guest')
    ->name('login.show');
Route::post('/login', [LoginController::class,'login'])->name('login');

Route::get('/logout/{type}',[LoginController::class,'logout'])->name('logout');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth'],
    ],
    function () {
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
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
Route::resource('/fees',FeesController::class);



///////  Feesinvoices    /////////

Route::resource('/feesinvoices', FeesinvoicesController::class);

//////////          Receipt   /////////////
Route::resource('/receipt', ReceiptController::class);

/////////            PaymentStudent      ////////////////
Route::resource('/paymentStudent', PaymentStudentController::class);

//////////            StudentPremium         ///////////////

Route::resource('/StudentPremium', StudentpremiumController::class);
/////////////////     Attendance             /////////////////////
Route::resource('/Attendance', AttendanceController::class);
////////  Subject         //////////////
Route::resource('/Subject', SubjectController::class);
///////       Exam       //////////
Route::resource('/Quizzes', QuizzController::class);

/////////         Question   ////////////
Route::resource('/Question', QuestionController::class);

/////////////  classonline     ///////////////

Route::resource('/classonline', ClassonlineController::class);

Route::post('/delete/{id}', [ClassonlineController::class, 'deletes'])->name('delete');

/////////////    Library /////////////////
Route::resource('/library', LibraryController::class);
Route::get('/downloadAttachment/{filename}', [LibraryController::class, 'downloadAttachment'])->name('downloadAttachment');
Route::get('/delete/{id}', [LibraryController::class, 'delete'])->name('delete_asd');

////////   setting    ///////
Route::get('/settings', [SettingController::class, 'index'])->name('settings');
Route::post('/update', [SettingController::class, 'update'])->name('update');
