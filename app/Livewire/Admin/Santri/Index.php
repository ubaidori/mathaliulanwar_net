<?php

namespace App\Livewire\Admin\Santri;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Santri;
use App\Models\Dorm;
use App\Models\IslamicClass;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use App\Exports\SantriExport;
use App\Imports\SantriImport;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    // 1. Properti Filter
    public $search = '';
    public $filterDorm = '';
    public $filterClass = '';
    public $filterGender = '';
    public $filterStatus = 'aktif'; // Default tampilkan yang aktif saja

    // --- PROPERTY BARU UNTUK IMPORT ---
    public $showImportModal = false;
    public $importFile;

    // 2. Reset Halaman ke 1 saat filter berubah
    // Ini PENTING: Jika user di hal 5 lalu memfilter, harus kembali ke hal 1
    public function updatedSearch() { $this->resetPage(); }
    public function updatedFilterDorm() { $this->resetPage(); }
    public function updatedFilterClass() { $this->resetPage(); }
    public function updatedFilterGender() { $this->resetPage(); }
    public function updatedFilterStatus() { $this->resetPage(); }

    // 3. Method Reset Semua Filter
    public function resetFilters()
    {
        $this->reset(['search', 'filterDorm', 'filterClass', 'filterGender']);
        $this->filterStatus = 'aktif';
        $this->resetPage();
    }

    // --- FITUR EXPORT ---
    public function export()
    {
        // Kirim semua filter saat ini ke Class Export
        $filters = [
            'search' => $this->search,
            'dorm' => $this->filterDorm,
            'class' => $this->filterClass,
            'gender' => $this->filterGender,
            'status' => $this->filterStatus,
        ];

        return Excel::download(new SantriExport($filters), 'data_santri_'.date('Y-m-d_H-i').'.xlsx');
    }

    // --- FITUR IMPORT ---
    public function downloadTemplate()
    {
        // Cara simpel: Download file statis yang sudah disiapkan di folder public
        // Pastikan Anda membuat file excel contoh di public/templates/template_santri.xlsx
        return response()->download(public_path('templates/template_santri.xlsx'));
    }

    public function import()
    {
        $this->validate([
            'importFile' => 'required|mimes:xlsx,xls|max:10240',
        ]);

        try {
            Excel::import(new SantriImport, $this->importFile);
            
            $this->showImportModal = false;
            $this->importFile = null;
            session()->flash('message', 'Import data santri berhasil!');
            
        } catch (ValidationException $e) {
            // Menangkap error validasi baris Excel (misal: Kolom Nama kosong di baris 2)
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Baris " . $failure->row() . ": " . implode(', ', $failure->errors());
            }
            session()->flash('error', implode('<br>', $errorMessages));
            
        } catch (\Exception $e) {
            // Menangkap error umum (misal: Salah nama kolom)
            session()->flash('error', 'Gagal: ' . $e->getMessage());
        }
    }

    // 4. Fitur Hapus (Tetap ada)
    public function delete($id)
    {
        $santri = Santri::find($id);
        if($santri) {
            // Hapus foto jika ada (opsional, sesuaikan kode sebelumnya)
            $santri->delete();
            session()->flash('message', 'Data santri berhasil dihapus.');
        }
    }

    public function render()
    {
        // 5. Query Builder yang Canggih
        $santris = Santri::query()
            // Search Nama atau NIS
            ->when($this->search, function (Builder $query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                      ->orWhere('nis', 'like', '%'.$this->search.'%');
                });
            })
            // Filter Asrama
            ->when($this->filterDorm, function ($query) {
                $query->where('dorm_id', $this->filterDorm);
            })
            // Filter Kelas
            ->when($this->filterClass, function ($query) {
                $query->where('islamic_class_id', $this->filterClass);
            })
            // Filter Gender
            ->when($this->filterGender, function ($query) {
                $query->where('gender', $this->filterGender);
            })
            // Filter Status (Aktif / Boyong)
            ->when($this->filterStatus, function ($query) {
                if ($this->filterStatus == 'aktif') {
                    $query->whereNull('drop_date');
                } elseif ($this->filterStatus == 'boyong') {
                    $query->whereNotNull('drop_date');
                }
            })
            ->latest()
            ->paginate(10); // Pagination 10 per halaman

        return view('livewire.admin.santri.index', [
            'santris' => $santris,
            'dorms' => Dorm::all(), // Kirim data asrama untuk dropdown
            'classes' => IslamicClass::orderBy('class')->get(), // Kirim data kelas
        ]);
    }
}