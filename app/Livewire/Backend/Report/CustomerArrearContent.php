<?php

namespace App\Livewire\Backend\Report;

use Livewire\Component;

class CustomerArrearContent extends Component
{
    public function render()
    {
        return view('livewire.backend.report.customer-arrear-content')->layout('layouts.backend');
    }
}
