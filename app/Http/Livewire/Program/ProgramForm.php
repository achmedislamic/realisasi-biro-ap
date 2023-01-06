<?php

namespace App\Http\Livewire\Program;

use App\Models\Program;
use App\Traits\WithLiveValidation;
use Livewire\Component;

class ProgramForm extends Component
{
    use WithLiveValidation;

    private ?int $IdProgram = null;
    public Program $program;

    public function mount(int $id = null): void
    {
        $this->IdProgram = $id;
        $this->program = is_null($id) ? new Program() : Program::find($id);
    }

    protected function rules(): array
    {
        return [
            'program.kode' => 'required|string|max:15',
            'program.nama' => 'required|string|max:255',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $this->program->save();

        return to_route('program');
    }

    public function render()
    {
        return view('livewire.program.program-form');
    }
}
