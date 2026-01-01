<?php

namespace App\Imports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SantriImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Pastikan nama kolom header di Excel sesuai dengan index array di sini
        return new Santri([
            'name'          => $row['nama_lengkap'], // Header di Excel: nama_lengkap
            'lp'            => $row['lp'],           // Header di Excel: lp
            'nis'           => $row['nis'] ?? null,  // Opsional
            'nisn'          => $row['nisn'] ?? null, // Opsional
            'address'       => $row['alamat'] ?? null,
            'dob'           => isset($row['tgl_lahir']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir']) : null,
            'th_child'      => $row['anak_ke'] ?? null,
            'siblings_count'=> $row['jumlah_saudara'] ?? null,
            'education'     => $row['pendidikan_sebelumnya'] ?? null,
            'registration_date' => isset($row['tgl_masuk']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_masuk']) : null,
            
            'father_name'   => $row['nama_ayah'] ?? null,
            'father_dob'    => isset($row['tgl_lahir_ayah']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir_ayah']) : null,
            'father_address'=> $row['alamat_ayah'] ?? null,
            'father_phone'  => $row['telepon_ayah'] ?? null,
            'father_education' => $row['pendidikan_ayah'] ?? null,
            'father_job'    => $row['pekerjaan_ayah'] ?? null,
            'father_alive'  => $row['status_hidup_ayah'] ?? null,
            
            'mother_name'   => $row['nama_ibu'] ?? null,
            'mother_dob'    => isset($row['tgl_lahir_ibu']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir_ibu']) : null,
            'mother_address'=> $row['alamat_ibu'] ?? null,
            'mother_phone'  => $row['telepon_ibu'] ?? null,
            'mother_education' => $row['pendidikan_ibu'] ?? null,
            'mother_job'    => $row['pekerjaan_ibu'] ?? null,
            'mother_alive'  => $row['status_hidup_ibu'] ?? null,
            
            'guardian_name' => $row['nama_wali'] ?? null,
            'guardian_dob'  => isset($row['tgl_lahir_wali']) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir_wali']) : null,
            'guardian_address'=> $row['alamat_wali'] ?? null,
            'guardian_phone'=> $row['telepon_wali'] ?? null,
            'guardian_education' => $row['pendidikan_wali'] ?? null,
            'guardian_job'  => $row['pekerjaan_wali'] ?? null,
            'guardian_relationship' => $row['hubungan_wali'] ?? null,

        ]);
    }

    // Aturan Validasi (Agar tidak error jika data kosong)
    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required',
            'lp'           => 'required|in:L,P', // Hanya boleh L atau P
        ];
    }
}