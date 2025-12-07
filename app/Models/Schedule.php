<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi ke tabel lain
    public function academicYear() { return $this->belongsTo(AcademicYear::class); }
    public function islamicClass() { return $this->belongsTo(IslamicClass::class); }
    public function subject()      { return $this->belongsTo(Subject::class); }
    public function staff()        { return $this->belongsTo(Staff::class); }
}