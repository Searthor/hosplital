<?php

namespace App\Livewire\Backend\Report;

use App\Models\medicine;
use Livewire\Component;

class MedicineComponrt extends Component
{
    public function render()
    {
        $data = medicine::all();
        return view('livewire.backend.report.medicine-componrt',compact('data'))->layout('layouts.backend');
    }
}
