<?php

namespace App\Livewire\Backend\Treatment;

use App\Models\Treatments;
use Livewire\Component;

class TreatmentComponent extends Component
{
    public $hiddenId;
    public function render()
    {
        $data = Treatments::orderBy('id', 'desc')->get();
        return view('livewire.backend.treatment.treatment-component',compact('data'))->layout('layouts.backend');
    }
    public function showDestroy($ids)
    {
        $this->dispatch('show-modal-delete');
        $this->hiddenId = $ids;
    }
    public function Destroy($ids)
    {
        $data = Treatments::find($ids);
        $data->delete();
        $this->dispatch('hide-modal-delete');
        $this->dispatch('delete');
    }

}
