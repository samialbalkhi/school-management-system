<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Father extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name','job'];
    protected $fillable=['email','password','name','national_id','passport_id','phone','job','notionalitio_id','type_blood_id','religion_id','address','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];
}
