<?php

namespace App\Http\Livewire\Kegiatan;

use App\Models\Kegiatan;
use App\Models\Program;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class KegiatanForm extends Component
{
    use WithLiveValidation;

    private ?int $idKegiatan = null;
    public int $idProgram;
    public Kegiatan $kegiatan;

    public function mount(int $idProgram, int $id = null): void
    {
        $this->idKegiatan = $id;
        $this->kegiatan = is_null($id) ? new Kegiatan() : Kegiatan::find($id);
        $this->idProgram = $idProgram;
    }

    protected function rules(): array
    {
        return [
            'kegiatan.kode' => 'required',
            'kegiatan.nama' => 'required|string|max:255',
        ];
    }

       public function simpan()
       {
           $this->validate();
           $this->kegiatan->program_id = $this->idProgram;
           $this->kegiatan->save();

           return to_route('program-kegiatan');
       }

       public function render()
       {
           $program = Program::find($this->idProgram);
           return view('livewire.kegiatan.kegiatan-form', compact('program'));
       }
}
