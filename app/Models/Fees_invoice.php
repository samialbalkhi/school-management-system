<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fees_invoice extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable = [];
    protected $guarded = [];

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function fees()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }
    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
