<?php

namespace App\Livewire\Fontend;

use Livewire\Component;

class AboutComponent extends Component
{
    public function render()
    {
        return view('livewire.fontend.about-component')->layout('layouts.fontend.fontend');
    }
}
