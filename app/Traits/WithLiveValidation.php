<?php

namespace App\Traits;

trait WithLiveValidation
{
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
