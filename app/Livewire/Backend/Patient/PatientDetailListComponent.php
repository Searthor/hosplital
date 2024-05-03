<?php

namespace App\Livewire\Backend\Patient;

use App\Models\appointment;
use App\Models\Patient;
use App\Models\Treatments;
use Livewire\Component;

class PatientDetailListComponent extends Component
{
    public $patientID,$step;
    public function mount($id){
        $this->step =1;
        $this->patientID = $id;
    }
    public function render()
    {
        $patient = Patient::find($this->patientID);
        $Appointments = appointment::where('patient_id',$this->patientID)->get();
        $data  = Treatments::where('patient_id',$this->patientID)->get();
        return view('livewire.backend.patient.patient-detail-list-component',compact('data','patient','Appointments'))->layout('layouts.backend');
    }
    public function set_step($i){
     
        $this->step =$i;
    }
}
