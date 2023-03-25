<?php

namespace App\Http\Livewire;

use App\Models\Opd;
use App\Models\SubOpd;
use App\Models\User;
use App\Models\UserRole;
use App\Traits\WithLiveValidation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class PenggunaForm extends Component
{
    use WithLiveValidation;
    use Actions;

    public ?int $userId = null;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $pods;
    public $subOpds;
    public $opdPilihan = null;
    public $subOpdPilihan = null;
    public $rolePengguna;
    public String $buttonText;

    public User $user;

    public function mount(int $id = null): void
    {
        $this->pods = Opd::orderBy('kode')->get();
        if (is_null($id)) {
            $this->buttonText = "Simpan";
            $this->subOpds = collect();
            $this->rolePengguna = 'opd';
            $this->user = new User();
        } else {
            $this->buttonText = "Simpan Perubahan";
            $this->userId = $id;
            $this->user = User::with('role')->find($id);

            $subOpd = SubOpd::find($this->user->role->sub_opd_id);
            $this->rolePengguna = $this->user->role->role_name;
            $this->name = $this->user->name;
            $this->email = $this->user->email;

            if ($subOpd) {
                $this->subOpds = SubOpd::query()
                    ->where('opd_id', $subOpd->opd_id)
                    ->get();
                $this->subOpdPilihan = $subOpd->id;
                $this->opdPilihan = $subOpd->opd_id;
            }
        }
    }

    public function updatedOpdPilihan($opd)
    {
        $this->subOpds = SubOpd::where('opd_id', $opd)
            ->orderBy('kode')
            ->get();
        $this->subOpdPilihan = null;
    }

    protected function rules(): array
    {
        $rules =  [
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|email|max:255|unique:users,email,'.$this->email.',email',
            'rolePengguna' => 'required',
            'opdPilihan' => 'required_if:rolePengguna,opd',
            'subOpdPilihan' => 'required_if:rolePengguna,opd',
        ];

        if (is_null($this->userId) || $this->password != "") {
            return array_merge($rules, [ 'password' => ['required', 'confirmed', Password::min(8)]]);
        }

        return $rules;
    }

    public function simpan()
    {
        $this->validate();

        $success = false;

        if (is_null($this->userId)) {
            $this->user->password = Hash::make($this->password);
            $success = $this->user->save();
        } else {
            $success = $this->user->save();
        }

        if ($success) {
            UserRole::create([
                'role_name' => $this->rolePengguna,
                'user_id' => $this->user->id,
                'sub_opd_id' => $this->subOpdPilihan,
            ]);


            if (is_null($this->userId)) {
                $this->notification()->success(
                    'BERHASIL',
                    'Data pengguna tersimpan.'
                );
            } else {
                $this->notification()->success(
                    'BERHASIL',
                    'Data pengguna diubah.'
                );
            }

            return redirect()->route('pengguna');
        }
    }

    public function render(): View
    {
        return view('livewire.pengguna-form');
    }
}
