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
            'jadwal.bulan' => 'required|date|after_or_equal:' . today()->startOfYear(),
            'jadwal.tanggal_waktu' => 'required|date|after_or_equal:' . today()->startOfYear(),
        ];
    }

    public function updated($model, $value): void
    {
        if ($model == 'jadwal.bulan') {
            $this->jadwal = Jadwal::where('bulan', $value)->firstOrNew();
            // dd($value);
            $this->jadwal->bulan = $value;
        }
    }

    public function simpan()
    {
        $this->validate();

        DB::table('jadwals')->update(['is_aktif' => false]);

        $this->jadwal->is_aktif = true;

        $this->jadwal->save();

        return to_route('jadwal.form');
    }

    public function render()
    {
        return view('livewire.jadwal-form');
    }
}
