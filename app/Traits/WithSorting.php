<?php

namespace App\Traits;

trait WithSorting
{
    public $sortField;

    public $sortAsc = true;

    public $sort = 'asc';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
            $this->sort = 'desc';
        } else {
            $this->sortAsc = true;
            $this->sort = 'asc';
        }

        $this->sortField = $field;
    }
}
