<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable=['name'];
    
    protected $fillable=['name','status','grade_id','classroom_id','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class,'classroom_id');
    }
}
