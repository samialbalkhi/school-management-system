<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notionalitio extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable=['name'];
    protected $fillabel=['name','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];
}
