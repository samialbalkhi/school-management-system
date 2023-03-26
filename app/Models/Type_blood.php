<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_blood extends Model
{
    use HasFactory;
    protected $fillable=['name','created_at','updated_at'];
    protected $hodden=['created_at','updated_at'];
}
