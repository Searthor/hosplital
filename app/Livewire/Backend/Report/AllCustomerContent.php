<?php

namespace App\Livewire\Backend\Report;

use Livewire\Component;

class AllCustomerContent extends Component
{
    public function render()
    {
        return view('livewire.backend.report.all-customer-content')->layout('layouts.backend');
    }
}
