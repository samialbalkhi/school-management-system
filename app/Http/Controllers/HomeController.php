<?php

namespace App\Http\Controllers;

use App\Models\Father;
use App\Models\Fees_invoice;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use PHPUnit\Event\Tracer\Tracer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


     public function index()
    {
        return view('auth.selection');
    }

    public function dashboard()
    {
        $data['student']=Student::count();
        $data['Teacher']=Teacher::count();
        $data['Father']=Father::count();
        $data['Section']=Section::count();
        $data['Student']=Student::latest()->take(5)->get();
        $data['Teachertake']=Teacher::latest()->take(5)->get();
        $data['Fathertake']=Father::latest()->take(5)->get();
        $data['Fees_invoice']=Fees_invoice::latest()->take(5)->get();
        
        return view('dashboard',$data);
    }
   
}
