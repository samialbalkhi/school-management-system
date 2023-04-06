<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function students()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
    public function f_grades()
    {
        return $this->belongsTo(Grade::class,'from_grade');
    }
    public function f_classrooms()
    {
        return $this->belongsTo(Classroom::class,'from_Classroom');
    }
    public function f_sections()
    {
        return $this->belongsTo(Section::class,'from_section');
    }

    public function t_grades()
    {
        return $this->belongsTo(Grade::class,'to_grade');
    }
    public function t_classrooms()
    {
        return $this->belongsTo(Classroom::class,'to_Classroom');
    }
    public function t_sections()
    {
        return $this->belongsTo(Section::class,'to_section');
    }
}
