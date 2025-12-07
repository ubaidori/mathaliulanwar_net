<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Fungsi helper untuk memastikan hanya 1 tahun ajaran yang aktif
    public static function setActive($id)
    {
        self::query()->update(['is_active' => false]); // Matikan semua
        self::find($id)->update(['is_active' => true]); // Aktifkan yang dipilih
    }
}