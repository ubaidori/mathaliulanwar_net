<?php

namespace App\Livewire\Admin\Santri;

use Livewire\Component;
use App\Models\Santri;
use App\Models\Dorm;
use App\Models\IslamicClass;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads; //Upload Foto

    public $photo;
    public $old_photo; // Menyimpan path foto lama jika ada

    public $santriId;

    // --- Properti sama persis dengan Create ---
    public $nis, $nisn, $name, $gender, $address, $dob;
    public $th_child, $siblings_count, $education;

    public $registration_date, $drop_date, $drop_reason; // Tambahan untuk Edit: Data Keluar
    public $dorm_id, $islamic_class_id;

    public $father_name, $father_dob, $father_address, $father_phone, $father_education, $father_job, $father_alive;
    public $mother_name, $mother_dob, $mother_address, $mother_phone, $mother_education, $mother_job, $mother_alive;

    public $guardian_name, $guardian_dob, $guardian_address, $guardian_phone, $guardian_education, $guardian_job, $guardian_relationship;

    public function mount($id)
    {
        $santri = Santri::findOrFail($id);
        $this->santriId = $santri->id;

        // Isi properti dengan data dari database
        $this->old_photo = $santri->photo; // Simpan path foto lama
        $this->nis = $santri->nis;
        $this->nisn = $santri->nisn;
        $this->name = $santri->name;
        $this->gender = $santri->gender;
        $this->address = $santri->address;
        // Format tanggal agar terbaca di input date (Y-m-d)
        $this->dob = $santri->dob ? $santri->dob->format('Y-m-d') : null;
        $this->th_child = $santri->th_child;
        $this->siblings_count = $santri->siblings_count;
        $this->education = $santri->education;

        $this->registration_date = $santri->registration_date ? $santri->registration_date->format('Y-m-d') : null;
        $this->drop_date = $santri->drop_date ? $santri->drop_date->format('Y-m-d') : null;
        $this->drop_reason = $santri->drop_reason;
        $this->dorm_id = $santri->dorm_id;
        $this->islamic_class_id = $santri->islamic_class_id;

        // Data Ayah
        $this->father_name = $santri->father_name;
        $this->father_alive = $santri->father_alive;
        $this->father_job = $santri->father_job;
        $this->father_phone = $santri->father_phone;
        
        // Data Ibu
        $this->mother_name = $santri->mother_name;
        $this->mother_alive = $santri->mother_alive;
        $this->mother_job = $santri->mother_job;
        $this->mother_phone = $santri->mother_phone;

        // Data Wali (Ambil sisanya jika perlu detail lengkap seperti Create)
        $this->guardian_name = $santri->guardian_name;
        $this->guardian_relationship = $santri->guardian_relationship;
        $this->guardian_phone = $santri->guardian_phone;
    }

    protected $rules = [
        'name' => 'required',
        'gender' => 'required',
    ];

    public function update()
    {
        $this->validate();
        
        $santri = Santri::findOrFail($this->santriId);

        $santri->update([
            'nis' => $this->nis,
            'nisn' => $this->nisn,
            'name' => $this->name,
            'gender' => $this->gender,
            'address' => $this->address,
            'dob' => $this->dob,
            'th_child' => $this->th_child,
            'siblings_count' => $this->siblings_count,
            'education' => $this->education,
            
            'registration_date' => $this->registration_date,
            'drop_date' => $this->drop_date, // Update tanggal keluar
            'drop_reason' => $this->drop_reason,
            'dorm_id' => $this->dorm_id ?: null,
            'islamic_class_id' => $this->islamic_class_id ?: null,

            'father_name' => $this->father_name,
            'father_alive' => $this->father_alive,
            'father_job' => $this->father_job,
            'father_phone' => $this->father_phone,

            'mother_name' => $this->mother_name,
            'mother_alive' => $this->mother_alive,
            'mother_job' => $this->mother_job,
            'mother_phone' => $this->mother_phone,

            'guardian_name' => $this->guardian_name,
            'guardian_relationship' => $this->guardian_relationship,
            'guardian_phone' => $this->guardian_phone,

            'photo' => 'nullable|image|max:2048',
        ]);

        $santri = Santri::findOrFail($this->santriId);
        $photoPath = $santri->photo; // Default pakai foto lama

        // Cek jika ada foto baru diupload
        if ($this->photo) {
            // 1. Hapus foto lama dari storage jika ada
            if ($santri->photo && Storage::disk('public')->exists($santri->photo)) {
                Storage::disk('public')->delete($santri->photo);
            }
            // 2. Simpan foto baru
            $photoPath = $this->photo->store('santri-photos', 'public');
        }

        $santri->update([
            'photo' => $photoPath,
            // ... update field lain ...
        ]);

        session()->flash('message', 'Data santri berhasil diperbarui.');
        return redirect()->route('admin.santri.index');
    }

    public function render()
    {
        return view('livewire.admin.santri.edit', [
            'dorms' => Dorm::all(),
            'classes' => IslamicClass::orderBy('class')->get(),
        ]);
    }
}