<?php

namespace App\Livewire\Backend\Patient;

use Livewire\Component;

class DetailsComponent extends Component
{
    public function render()
    {
        return view('livewire.backend.patient.details-component')->layout('layouts.backend');
    }
}
