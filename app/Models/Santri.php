<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    // 1. TAMBAHKAN $guarded ATAU $fillable AGAR IMPORT BISA MASUK
    // Kita gunakan guarded = [] agar semua kolom boleh diisi via Excel
    protected $guarded = ['id']; 

    // 2. TAMBAHKAN RELASI AGAR EXPORT TIDAK ERROR
    public function dorm()
    {
        // Relasi ke tabel asrama
        return $this->belongsTo(Dorm::class, 'dorm_id');
    }

    public function islamicClass()
    {
        // Relasi ke tabel kelas diniyah
        return $this->belongsTo(IslamicClass::class, 'islamic_class_id');
    }
}