<?php

namespace App\Http\Livewire;

use App\Enums\RoleName;
use App\Models\{User, UserRole};
use App\Traits\WithLiveValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

final class PenggunaForm extends Component
{
    use Actions, WithLiveValidation;

    public $userId = null;

    public $password;

    public $password_confirmation;

    public $user;

    public $userRole;

    public function mount(int $id = null): void
    {
        if(! is_null($id)) {
            $this->userId = $this->id;

            $this->user = User::findOrFail($id);
            $this->userRole = $this->user->role;
        } else {
            $this->user = new User;
            $this->userRole = new UserRole;
        }
    }

    public function updated(string $name, mixed $value): void
    {
        if($name == 'user.imageable_type'){
            $this->user->imageable_id = null;
        }
    }

    protected function rules(): array
    {
        $rules = [
            'user.name' => 'required|string|max:255',
            'user.email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user->id)],
            'userRole.imageable_id' => Rule::requiredIf($this->userRole->imageable_type != RoleName::ADMIN),
            'userRole.imageable_type' => ['required', 'max:20']
        ];

        if (is_null($this->userId) || $this->password != '') {
            return array_merge($rules, ['password' => ['required', 'confirmed', Password::min(8)]]);
        }

        return $rules;
    }

    public function simpan()
    {
        $this->validate();

        DB::transaction(function () {
            if (is_null($this->userId)) {
                $this->user->password = bcrypt($this->password);
            }

            $this->user->save();

            $this->userRole->user_id = $this->user->id;

            $this->userRole->save();
        });

        $this->notification()->success(
            'BERHASIL',
            'Data pengguna tersimpan.'
        );

        return to_route('pengguna');
    }

    public function render(): View
    {
        return view('livewire.pengguna-form');
    }
}
