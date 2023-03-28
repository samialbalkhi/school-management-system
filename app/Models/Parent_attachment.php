<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parent_attachment extends Model
{
    use HasFactory;
    protected $fillable=['name','father_id','created_at','updated_at'];
    protected $hidden=['created_at','updated_at'];

}
