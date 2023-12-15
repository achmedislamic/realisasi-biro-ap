<?php

namespace App\Http\Livewire\Program;

use App\Models\Bidang;
use App\Models\Program;
use App\Traits\WithLiveValidation;
use Livewire\Component;
use WireUi\Traits\Actions;

class ProgramForm extends Component
{
    use Actions, WithLiveValidation;

    public ?int $IdProgram = null;

    public Program $program;

    public string $buttonText;

    public function mount(int $id = null): void
    {
        if (is_null($id)) {
            $this->buttonText = 'Simpan';
            $this->program = new Program();
        } else {
            $this->buttonText = 'Simpan Perubahan';
            $this->IdProgram = $id;
            $this->program = Program::find($id);
        }
    }

    protected function rules(): array
    {
        return [
            'program.kode' => 'required|string|max:15',
            'program.nama' => 'required|string|max:255',
            'program.bidang_id' => 'required|integer',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->program->save();

        if (is_null($this->IdProgram)) {
            $this->notification()->success(
                'BERHASIL',
                'Data program tersimpan.'
            );
            $this->program = new Program();
        } else {
            $this->notification()->success(
                'BERHASIL',
                'Data program diubah.'
            );
        }

        return to_route('program-kegiatan');
    }

    public function render()
    {
        return view('livewire.program.program-form', [
            'bidangs' => Bidang::select('id', 'nama')->orderBy('nama')->get()
        ]);
    }
}
