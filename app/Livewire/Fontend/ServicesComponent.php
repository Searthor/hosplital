<?php

namespace App\Livewire\Fontend;

use App\Models\Province;
use Livewire\Component;
use Livewire\WithPagination;
class ServicesComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data = Province::paginate(6);
        return view('livewire.fontend.services-component',compact('data'))->layout('layouts.fontend.fontend');
    }
}
