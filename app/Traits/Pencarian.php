<?php

namespace App\Traits;

trait Pencarian
{
    public string $cari = '';

    public function updatingCari()
    {
        $this->resetPage();
    }
}
