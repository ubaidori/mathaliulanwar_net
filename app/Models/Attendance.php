<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function santri()   { return $this->belongsTo(Santri::class); }
    public function schedule() { return $this->belongsTo(Schedule::class); }
}