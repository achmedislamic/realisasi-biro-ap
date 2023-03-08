<?php

namespace App\Http\Livewire\BidangUrusan;

use App\Models\BidangUrusan;
use App\Models\Urusan;
use App\Traits\Pencarian;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class BidangUrusanTable extends Component
{
    use Pencarian;
    use WithPagination;
    use Actions;

    public int $urusanId;

    protected $queryString = ['cari' => ['except' => '']];

    public function mount(int $urusanId): void
    {
        $this->urusanId = $urusanId;
    }

     public function hapusBidangUrusan(int $id): void
     {
         BidangUrusan::destroy($id);
     }

     public function render()
     {
         $bidangUrusans = BidangUrusan::query()->where('urusan_id', $this->urusanId)->pencarian($this->cari)->paginate();
         $urusan = Urusan::find($this->urusanId);
         return view('livewire.bidang-Urusan.bidang-Urusan-table', compact('urusan', 'bidangUrusans'));
     }
}
