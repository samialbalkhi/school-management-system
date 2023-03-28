<?php

namespace App\Models;

use App\Models\Gender;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = ['name', 'email', 'password', 'specialization_id', 'gender_id', 'joining_date', 'address', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function specializations()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }
    public function genders()
    {
        return $this->belongsTo(Gender::class,'gender_id');
    }
}
