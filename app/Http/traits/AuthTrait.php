<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

trait AuthTrait
{
    public function chekGuard(Request $request){
        // dd($request);
        if($request->type == 'student'){
            $guardName= 'student';
        }
        elseif ($request->type == 'parent'){
            $guardName= 'parent';
        }
        elseif ($request->type == 'teacher'){
            $guardName= 'teacher';
        }
        else{
            $guardName= 'web';
        }
        return $guardName;
    }
    public function redirect($request){
        // dd($request->type);
        if($request->type == 'student'){
            
            return redirect()->intended(RouteServiceProvider::STUDENT);
        }
        elseif ($request->type == 'parent'){
            return redirect()->intended(RouteServiceProvider::PARENT);
        }
        elseif ($request->type == 'teacher'){
            return redirect()->intended(RouteServiceProvider::TEACHER);
        }
        else{
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}