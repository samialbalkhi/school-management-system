<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quizze extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['name'];
    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }
    public function degrees(){

        return $this->hasMany(Degree::class);
    }
}
