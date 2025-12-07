<?php

namespace App\Livewire\Admin\Santri;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Santri;
use App\Models\Dorm;
use App\Models\IslamicClass;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    use WithPagination;

    // 1. Properti Filter
    public $search = '';
    public $filterDorm = '';
    public $filterClass = '';
    public $filterGender = '';
    public $filterStatus = 'aktif'; // Default tampilkan yang aktif saja

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