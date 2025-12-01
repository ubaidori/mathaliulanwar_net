<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $guarded = []; // Mengizinkan semua kolom diisi

    // Casting agar otomatis jadi objek Carbon (Tanggal)
    protected $casts = [
        'dob' => 'date',
        'father_dob' => 'date',
        'mother_dob' => 'date',
        'guardian_dob' => 'date',
        'registration_date' => 'date',
        'drop_date' => 'date',
    ];

    // Nanti tambahkan relasi ke Asrama/Kelas disini jika tabelnya sudah ada
    // public function dorm() { return $this->belongsTo(Dorm::class); }
}