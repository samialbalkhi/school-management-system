<?php

use App\Models\Father;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Fees_invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students\StudentsController;
use App\Http\Controllers\Teachers\dashbord\QuizzController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Teachers\dashbord\ProfileController;
use App\Http\Controllers\Teachers\dashbord\StudentController;
use App\Http\Controllers\Teachers\dashbord\QuestionController;
use App\Http\Controllers\Teachers\dashbord\OnlineZoomClassesController;

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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher'],
    ],
    function () {
        //==============================dashboard============================
        Route::get('/teacher/dashboard', function () {
            $id = Teacher::findorFail(auth()->user()->id)
                ->Sections()
                ->pluck('section_id');
            $data['count_sections'] = $id->count();
            $data['count_students'] = Student::whereIn('section_id', $id)->count();
            $data['students'] = Student::latest()
                ->take(5)
                ->get();
            $data['Teachers'] = Teacher::latest()
                ->take(5)
                ->get();
            $data['Father'] = Father::latest()
                ->take(5)
                ->get();
            $data['Fees_invoice'] = Fees_invoice::latest()
                ->take(5)
                ->get();

            return view('pages.Teacher.dashboard.dashboard', $data);
        });

        Route::resource('student', App\Http\Controllers\Teachers\dashbord\StudentController::class);
        Route::controller(App\Http\Controllers\Teachers\dashbord\StudentController::class)->group(function () {
            Route::get('teacher_sections', 'section')->name('tech_section');
            Route::get('/reports', 'reports')->name('reports');
            Route::post('/ReportsSearch', 'ReportsSearch')->name('ReportsSearch');
            Route::resource('/Quizzes', QuizzController::class);
            Route::resource('/Question', QuestionController::class);
            Route::resource('/classonline', OnlineZoomClassesController::class);

        });
        Route::get('/profile', [ProfileController::class, 'index'])->name('show.profile');
        Route::post('/profileupdate/{id}', [ProfileController::class,'update'])->name('profile.update');

    },
);
