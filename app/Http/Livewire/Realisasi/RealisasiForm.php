<?php

namespace App\Http\Livewire\Realisasi;

use Livewire\Component;

class RealisasiForm extends Component
{
    protected function rules(): array
    {
        return [
           'tahapan_apbd_id' => 'required|numeric',
           'sub_opd_id' => 'required|numeric',
           'sub_kegiatan_id' => 'required|numeric',
           'sub_rincian_objek_id' => 'required|numeric',
           'tanggal' => 'required|date',
           'angaran' => 'required|numeric',
           'realisasi' => 'required|numeric',
        ];
    }

    public function render()
    {
        return view('livewire.realisasi.realisasi-form');
    }
}
