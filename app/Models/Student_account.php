<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student_account extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable=[];
    protected $guarded = [];
}
