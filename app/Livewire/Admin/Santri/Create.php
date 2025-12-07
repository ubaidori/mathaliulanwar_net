<?php

namespace App\Livewire\Admin\Santri;

use Livewire\Component;
use App\Models\Santri;
use App\Models\Dorm;
use App\Models\IslamicClass;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads; //Upload Foto
    public $photo; // Properti untuk menyimpan foto


    // --- 1. DATA PRIBADI ---
    public $nis, $nisn, $name, $gender = 'L', $address, $dob;
    public $th_child, $siblings_count, $education;

    // --- 2. DATA PONDOK ---
    public $registration_date;
    public $dorm_id, $islamic_class_id;

    // --- 3. DATA ORANG TUA ---
    public $father_name, $father_dob, $father_address, $father_phone, $father_education, $father_job, $father_alive = 'Hidup';
    public $mother_name, $mother_dob, $mother_address, $mother_phone, $mother_education, $mother_job, $mother_alive = 'Hidup';

    // --- 4. DATA WALI ---
    public $guardian_name, $guardian_dob, $guardian_address, $guardian_phone, $guardian_education, $guardian_job, $guardian_relationship;

    public function mount()
    {
        $this->registration_date = date('Y-m-d'); // Default hari ini
    }

    protected $rules = [
        'name' => 'required',
        'gender' => 'required',
        'registration_date' => 'required|date',
        'nis' => 'nullable|unique:santris,nis',
        'photo' => 'nullable|image|max:2048',
        // Validasi lain bisa ditambahkan sesuai kebutuhan
    ];

    public function store()
    {
        $this->validate();

        // 4. Logika Simpan Foto
        $photoPath = null;
        if ($this->photo) {
            // Simpan di folder 'santri-photos' di dalam storage public
            $photoPath = $this->photo->store('santri-photos', 'public');
        }

        Santri::create([
            // Data Pribadi
            'photo' => $photoPath, // Simpan path foto
            'nis' => $this->nis,
            'nisn' => $this->nisn,
            'name' => $this->name,
            'gender' => $this->gender,
            'address' => $this->address,
            'dob' => $this->dob,
            'th_child' => $this->th_child,
            'siblings_count' => $this->siblings_count,
            'education' => $this->education,
            
            // Data Pondok
            'registration_date' => $this->registration_date,
            'dorm_id' => $this->dorm_id ?: null, // Cegah error string kosong
            'islamic_class_id' => $this->islamic_class_id ?: null,

            // Ayah
            'father_name' => $this->father_name,
            'father_dob' => $this->father_dob,
            'father_address' => $this->father_address,
            'father_phone' => $this->father_phone,
            'father_education' => $this->father_education,
            'father_job' => $this->father_job,
            'father_alive' => $this->father_alive,

            // Ibu
            'mother_name' => $this->mother_name,
            'mother_dob' => $this->mother_dob,
            'mother_address' => $this->mother_address,
            'mother_phone' => $this->mother_phone,
            'mother_education' => $this->mother_education,
            'mother_job' => $this->mother_job,
            'mother_alive' => $this->mother_alive,

            // Wali
            'guardian_name' => $this->guardian_name,
            'guardian_dob' => $this->guardian_dob,
            'guardian_address' => $this->guardian_address,
            'guardian_phone' => $this->guardian_phone,
            'guardian_education' => $this->guardian_education,
            'guardian_job' => $this->guardian_job,
            'guardian_relationship' => $this->guardian_relationship,
        ]);

        session()->flash('message', 'Data santri berhasil didaftarkan.');
        return redirect()->route('admin.santri.index');
    }

    public function render()
    {
        return view('livewire.admin.santri.create', [
            'dorms' => Dorm::all(),
            'classes' => IslamicClass::orderBy('class')->get(),
        ]);
    }
}