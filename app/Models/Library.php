<?php

namespace App\Models;

use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Library extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'librarys';

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
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
