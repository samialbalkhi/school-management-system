<?php

namespace App\Models;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable=['name'];
    protected $fillable=['name','grade_id','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

    public function grades()
    {
      return  $this->belongsTo(Grade::class,'grade_id');
    }
}
