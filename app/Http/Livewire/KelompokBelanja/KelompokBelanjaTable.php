<?php

namespace App\Http\Livewire\KelompokBelanja;

use App\Models\AkunBelanja;
use App\Models\KelompokBelanja;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class KelompokBelanjaTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public int $idAkunBelanja = 0;

    protected $queryString = ['cari' => ['except' => '']];
    protected $listeners = [
        'pilihIdAkunBelanjaEvent' => 'pilihIdAkunBelanja'
    ];

    public function pilihIdAkunBelanja(int $idAkunBelanja)
    {
        $this->idAkunBelanja = $idAkunBelanja;
    }

    public function pilihIdKelompokBelanjaEvent(int $idKelompokBelanja)
    {
        $this->emit('pilihIdKelompokBelanjaEvent', $idKelompokBelanja);
        $this->emit('rekeningGantiTabEvent', 'jenis');
    }

    public function hapusKelompokBelanja(int $id): void
    {
        try {
            KelompokBelanja::destroy($id);
            $this->notification()->success(
                'BERHASIL',
                'Data kelompok belanja terhapus.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error(
                'GAGAL !!!',
                'Data kelompok belanja tidak terhapus karena digunakan tabel lain.'
            );
        }
    }

    public function render()
    {
        $kelompokBelanjas = KelompokBelanja::query()
            ->whereAkunBelanjaId($this->idAkunBelanja)
            ->pencarian($this->cari)
            ->paginate();

        $akunBelanja = AkunBelanja::find($this->idAkunBelanja);

        return view('livewire.kelompok-belanja.kelompok-belanja-table', compact(['kelompokBelanjas', 'akunBelanja']));
    }
}
