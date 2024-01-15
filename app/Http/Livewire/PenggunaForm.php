<?php

namespace App\Http\Livewire;

use App\Enums\RoleName;
use App\Models\{Opd, SubOpd, User, UserRole};
use App\Traits\WithLiveValidation;
use Illuminate\Support\Facades\DB;
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

    public $opd;

    public $opdPilihan = null;

    public $subOpdPilihan = null;

    public $sektorPilihan = null;

    public $rolePengguna;

    public String $buttonText;

    public User $user;

    public function mount(int $id = null): void
    {
        $this->pods = Opd::orderBy('kode')->get();
        $this->subOpds = auth()->user()->isOpd() ? SubOpd::where('opd_id', auth()->user()->role->imageable_id)->orderBy('nama')->get() : collect();
        if (is_null($id)) {
            $this->buttonText = 'Simpan';
            $this->rolePengguna = RoleName::OPD;
            if(auth()->user()->isOpd()){
                $this->rolePengguna = RoleName::SUB_OPD;
            }
            $this->user = new User();

            // jika admin, maka null. jika opd, maka imageable_id. jika subopd maka role->imageable->opd_id
            $this->opdPilihan = null;
            if(auth()->user()->isOpd()){
                $this->opdPilihan = auth()->user()->role->imageable_id;
            }
            if(auth()->user()->isSubOpd()){
                $this->opdPilihan = auth()->user()->role->imageable->opd_id;
            }
            $this->subOpdPilihan = auth()->user()->isSubOpd() ? auth()->user()->role->imageable_id : null;
        } else {
            $this->buttonText = 'Simpan Perubahan';
            $this->userId = $id;
            $this->user = User::with('role')->find($id);

            $this->rolePengguna = $this->user->role->role_name;
            $this->name = $this->user->name;
            $this->email = $this->user->email;

            $userRole = $this->user->role;
            if ($userRole->role_name == RoleName::SUB_OPD) {
                $this->subOpds = SubOpd::query()
                    ->where('opd_id', $userRole->imageable->id)
                    ->get();
                $this->subOpdPilihan = $userRole->imageable->id;
                $this->opdPilihan = $userRole->imageable->opd->id;
            }

            if ($userRole->role_name == RoleName::OPD) {
                $this->opdPilihan = $userRole->imageable->id;
            }
        }

        $this->opd = Opd::find($this->opdPilihan);
        // dd($this->opdPilihan);
    }

    public function updatedRolePengguna($value)
    {
        $this->rolePengguna = RoleName::from($value);
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
        $rules = [
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|email|max:255|unique:users,email,'.$this->email.',email',
            'rolePengguna' => 'required',
            'opdPilihan' => 'required_if:rolePengguna,opd',
            'subOpdPilihan' => 'required_if:rolePengguna,opd',
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
            if (filled($this->password)) {
                $this->user->password = bcrypt($this->password);
            }

            $this->user->save();

            UserRole::updateOrCreate(
                ['user_id' => $this->user->id],
                [
                    'role_name' => $this->rolePengguna,
                    'imageable_id' => match ($this->rolePengguna) {
                        RoleName::SUB_OPD => $this->subOpdPilihan,
                        RoleName::OPD => $this->opdPilihan,
                        RoleName::SEKTOR => $this->sektorPilihan,
                        default => null
                    },
                    'imageable_type' => match ($this->rolePengguna) {
                        RoleName::SUB_OPD => 'sub_opd',
                        RoleName::OPD => 'opd',
                        RoleName::SEKTOR => 'sektor',
                        default => null
                    },
                ]
            );
        });

        $this->notification()->success(
            'BERHASIL',
            'Data pengguna tersimpan.'
        );

        return auth()->user()->isSubOpd() ? to_route('dashboard') : to_route('pengguna');
    }

    public function render(): View
    {
        // dd($this->rolePengguna);
        return view('livewire.pengguna-form');
    }
}
