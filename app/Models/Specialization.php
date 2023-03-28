<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialization extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable=['name'];
        
    protected $fillable=['name','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];
}
