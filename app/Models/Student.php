<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    public $guarded=[];

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
    public function sections(){
        return $this->belongsTo(Section::class,'section_id');
    }

   public function images()
   {
    return $this->morphMany(Image::class,'imagetable');
   }
    public function notionalitios(){

        return $this->belongsTo(Notionalitio::class, 'notionalitio_id');
    }
    public function fathers(){
        return $this->belongsTo(Father::class,'father_id');
    }
}
