<?php

namespace App\Livewire\Fontend;

use App\Models\ServiceUnit;
use Livewire\Component;
use Livewire\WithPagination;

class ContactComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $service_unit = ServiceUnit::where('del',1)->paginate(8);
        return view('livewire.fontend.contact-component',compact('service_unit'))->layout('layouts.fontend.fontend');
    }
}
