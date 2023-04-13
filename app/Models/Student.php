<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Attendance;
use App\Models\Fundaccount;
use App\Models\Payment_student;
use App\Models\Receipt_student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;
    public $translatable = ['name'];
    public $guarded = [];

    public function genders()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function gardes()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
    public function sections()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imagetable');
    }
    public function notionalitios()
    {
        return $this->belongsTo(Notionalitio::class, 'notionalitio_id');
    }
    public function fathers()
    {
        return $this->belongsTo(Father::class, 'father_id');
    }
    public function student_accounts()
    {
        return $this->hasMany(Student_account::class, 'student_id');
    }

    public function Receipt_student()
    {
        return $this->hasMany(Receipt_student::class);
    }

    public function payemntStudent()
    {
        return $this->hasMany(Payment_student::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class,'student_id');
    }
}
