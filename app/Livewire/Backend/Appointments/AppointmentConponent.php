<?php

namespace App\Livewire\Backend\Appointments;

use App\Models\appointment;
use App\Models\Patient;
use App\Models\Treatments;
use App\Models\User;
use Livewire\Component;

class AppointmentConponent extends Component
{
    public $hiddenId,$doctor_id,$appointment_date,$appointment_time,$patient_id,$appointment_detail;
    public function render()
    {
        $doctor = User::where('role_id','!=',1)->get();
        $patient = Patient::all();
        $appointments = Appointment::orderBy('id', 'desc')->get();
        return view('livewire.backend.appointments.appointment-conponent',compact('doctor','patient','appointments'))->layout('layouts.backend');
    }

    public function setappointment_time($time){
        $this->appointment_time =$time;
    }
    
    public function create(){
        $this->resetdata();
        $this->dispatch('show-modal-add');
    }

    public function resetdata(){
        $this->patient_id = '';
        $this->doctor_id = '';
        $this->appointment_date = '';
        $this->appointment_time = '';
        $this->appointment_detail = '';
    }
    public function Store(){
        $this->validate([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'appointment_date' => 'required',
        
        ], [
            'patient_id.required' => __('lang.please_information'),
            'doctor_id.required' => __('lang.please_information'),
            'appointment_date.required' => __('lang.please_information'),
  
        ]);
        if($this->appointment_date){
            if($this->appointment_time == null){
             $this->dispatch('required_time');
             return;
            }
         }
         $appointments = new appointment();
         $appointments->patient_id = $this->patient_id;
         $appointments->d_id = $this->doctor_id;
         $appointments->date = $this->appointment_date;
         $appointments->time = $this->appointment_time;
         $appointments->des = $this->appointment_detail;
         $appointments->creator_id = auth()->user()->id;
         $appointments->save();
         $this->resetdata();
         $this->dispatch('add');
         $this->dispatch('hide-modal-add');
    }


    public function showDestroy($id)
    {
        $this->hiddenId = $id;
        $this->dispatch('show-modal-delete');
    }
    public function Destroy()
    {
        $id = $this->hiddenId;
        $check = appointment::find($id);
        if($check->treatment_id != null){
            $treatment = Treatments::find($check->treatment_id);
            $treatment->appointments = 'no';
            $treatment->update();
        }
        $data = appointment::find($id);
        $data->delete();
        $this->dispatch('hide-modal-delete');
        $this->dispatch('delete');
    }

    public function showUpdate($id){
        $this->resetdata();
        $data = appointment::find($id);
        $this->patient_id = $data->patient_id;
        $this->doctor_id = $data->d_id;
        $this->appointment_date = $data->date;
        $this->appointment_time = $data->time;
        $this->appointment_detail = $data->des;
        $this->dispatch('show-modal-add');
    }
}
