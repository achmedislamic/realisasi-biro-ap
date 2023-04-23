<?php

namespace App\Http\Livewire;

use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class JadwalForm extends Component
{
    public $jadwal;

    public function mount(): void
    {
        $this->jadwal = new Jadwal();
    }

    protected function rules(): array
    {
        return [
            'jadwal.nama_bulan' => 'required|max:10',
            'jadwal.tanggal_waktu' => 'required|date',
        ];
    }

    public function updated($model, $value): void
    {
        if ($model == 'jadwal.nama_bulan') {
            $this->jadwal = Jadwal::where('nama_bulan', $value)->firstOrNew();
            // dd($value);
            $this->jadwal->nama_bulan = $value;
        }
    }

    public function simpan()
    {
        $this->validate();

        DB::table('jadwals')->update(['is_aktif' => false]);

        $this->jadwal->tahun = cache('tahapanApbd')->tahun;
        $this->jadwal->is_aktif = true;

        $this->jadwal->save();

        return to_route('pengguna');
    }

    public function render()
    {
        return view('livewire.jadwal-form');
    }
}
