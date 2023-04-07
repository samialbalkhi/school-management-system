<?php

namespace App\Models;

use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];
    use HasTranslations;

    public $translatable=['name'];

    public function grade(){

        return $this->belongsTo(Grade::class,'grade_id');
    }
    public function classroom(){

        return $this->belongsTo(Classroom::class,'classroom_id');   
    }

    public function teacher(){  

        return $this->belongsTo(Teacher::class,'teacher_id');
    }
}
