<?php

namespace App\Exports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Database\Eloquent\Builder;

class SantriExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    // Menerima parameter filter dari Livewire
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $filters = $this->filters;

        return Santri::query()
            ->with(['dorm', 'islamicClass']) // Eager load relasi biar cepat
            ->when($filters['search'], function (Builder $query) use ($filters) {
                $query->where(function ($q) use ($filters) {
                    $q->where('name', 'like', '%'.$filters['search'].'%')
                      ->orWhere('nis', 'like', '%'.$filters['search'].'%');
                });
            })
            ->when($filters['dorm'], fn($q) => $q->where('dorm_id', $filters['dorm']))
            ->when($filters['class'], fn($q) => $q->where('islamic_class_id', $filters['class']))
            ->when($filters['gender'], fn($q) => $q->where('gender', $filters['gender']))
            ->when($filters['status'], function ($query) use ($filters) {
                if ($filters['status'] == 'aktif') {
                    $query->whereNull('drop_date');
                } elseif ($filters['status'] == 'boyong') {
                    $query->whereNotNull('drop_date');
                }
            });
    }

    public function map($santri): array
    {
        // Mengubah data database menjadi baris Excel yang rapi
        return [
            $santri->nis,
            $santri->nisn,
            $santri->name,
            $santri->gender,
            $santri->address,
            $santri->dob, // Format YYYY-MM-DD
            $santri->islamicClass ? $santri->islamicClass->name . ' ' . $santri->islamicClass->class : '-',
            $santri->dorm ? 'Blok ' . $santri->dorm->block . ' - ' . $santri->dorm->room_number : '-',
            $santri->father_name,
            $santri->mother_name,
            $santri->drop_date ? 'Non-Aktif' : 'Aktif',
        ];
    }

    public function headings(): array
    {
        return [
            'NIS', 'NISN', 'Nama Lengkap', 'L/P', 'Alamat', 'Tanggal Lahir', 'Kelas Diniyah', 'Asrama', 'Nama Ayah', 'Nama Ibu', 'Status'
        ];
    }
}