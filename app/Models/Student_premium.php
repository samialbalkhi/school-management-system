<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_premium extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table='student_premiums';

    public function students(){
      return  $this->belongsTo(Student::class,'student_id');
    }
}
