<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Traits\WithLiveValidation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Livewire\Component;

class PenggunaForm extends Component
{
    use WithLiveValidation;

    private ?int $userId = null;
    public $password;
    public $password_confirmation;
    public User $user;

    public function mount(int $id = null): void
    {
        $this->userId = $id;
        $this->user = is_null($id) ? new User() : User::find($id);
    }

    protected function rules(): array
    {
        return [
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ];
    }

    public function simpan()
    {
        $this->validate();

        if(is_null($this->userId))
        {
            $this->user->password = $this->password;
        }

        $this->user->save();

        return to_route('pengguna');
    }

    public function render(): View
    {
        return view('livewire.pengguna-form');
    }
}
