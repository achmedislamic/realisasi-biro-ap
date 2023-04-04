<?php

namespace App\Http\Livewire\Kegiatan;

use App\Models\Kegiatan;
use App\Models\Program;
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class KegiatanForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public ?int $idKegiatan = null;

    public int $idProgram;

    public Kegiatan $kegiatan;

    public String $buttonText;

    public function mount(int $idProgram, int $id = null): void
    {
        $this->idProgram = $idProgram;

        if (is_null($id)) {
            $this->buttonText = 'Simpan';
            $this->kegiatan = new Kegiatan();
        } else {
            $this->buttonText = 'Simpan Perubahan';
            $this->idKegiatan = $id;
            $this->kegiatan = Kegiatan::find($id);
        }
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

           if (is_null($this->idKegiatan)) {
               $this->notification()->success(
                   'BERHASIL',
                   'Data kegiatan tersimpan.'
               );
               $this->kegiatan = new Kegiatan();
           } else {
               $this->notification()->success(
                   'BERHASIL',
                   'Data kegiatan diubah.'
               );
           }
       }

       public function render()
       {
           $program = Program::find($this->idProgram);

           return view('livewire.kegiatan.kegiatan-form', compact('program'));
       }
}
