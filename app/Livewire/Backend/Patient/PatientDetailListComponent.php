<?php

namespace App\Livewire\Backend\Patient;

use App\Models\Treatments;
use Livewire\Component;

class PatientDetailListComponent extends Component
{
    public $patientID;
    public function mount($id){
        $this->patientID = $id;
    }
    public function render()
    {
        $data  = Treatments::where('patient_id',$this->patientID)->get();
        return view('livewire.backend.patient.patient-detail-list-component',compact('data'))->layout('layouts.backend');
    }
}
