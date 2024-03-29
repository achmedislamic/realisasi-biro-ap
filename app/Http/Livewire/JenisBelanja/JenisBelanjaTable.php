<?php

namespace App\Http\Livewire\JenisBelanja;

use App\Models\{JenisBelanja, KelompokBelanja};
use App\Traits\Pencarian;
use Livewire\{Component, WithPagination};
use WireUi\Traits\Actions;

class JenisBelanjaTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public int $idKelompokBelanja = 0;

    protected $queryString = ['cari' => ['except' => '']];

    protected $listeners = [
        'pilihIdKelompokBelanjaEvent' => 'pilihIdKelompokBelanja',
    ];

    public function pilihIdKelompokBelanja(int $idKelompokBelanja)
    {
        $this->idKelompokBelanja = $idKelompokBelanja;
    }

    public function pilihIdJenisBelanjaEvent(int $idJenisBelanja)
    {
        $this->emit('pilihIdJenisBelanjaEvent', $idJenisBelanja);
        $this->emit('rekeningGantiTabEvent', 'objek');
    }

    public function hapusJenisBelanja(int $id): void
    {
        try {
            JenisBelanja::destroy($id);
            $this->notification()->success(
                'BERHASIL',
                'Data jenis belanja terhapus.'
            );
        } catch (\Throwable $th) {
            $this->notification()->error(
                'GAGAL !!!',
                'Data jenis belanja tidak terhapus karena digunakan tabel lain.'
            );
        }
    }

    public function render()
    {
        $jenisBelanjas = JenisBelanja::query()
            ->whereKelompokBelanjaId($this->idKelompokBelanja)
            ->pencarian($this->cari)
            ->paginate();

        $kelompokBelanja = KelompokBelanja::find($this->idKelompokBelanja);

        return view('livewire.jenis-belanja.jenis-belanja-table', compact(['jenisBelanjas', 'kelompokBelanja']));
    }
}
