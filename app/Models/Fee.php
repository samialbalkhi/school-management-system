<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable=['title'];
    protected $guarded = [];

    public function gardes(){

        return $this->belongsTo(Grade::class,'grade_id');
    }
    public function classrooms(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }
}
