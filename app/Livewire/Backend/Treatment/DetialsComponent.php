<?php

namespace App\Livewire\Backend\Treatment;

use App\Models\appointment;
use App\Models\medicine;
use App\Models\Patient;
use App\Models\treatment_details;
use App\Models\Treatments;
use App\Models\User;
use Livewire\Component;

class DetialsComponent extends Component
{
    public $ID;
    public $code;
    public $patient_id, $height, $weight, $pressure, $heartbeat,
        $vak­_saeng, $date, $symptom, $old_new,$doctor_id;
    public $check_admit='no',$appointments,$doctor_appointment_id,$appointment_date,$appointment_time,$bongmati;
    public $medicine_id,$med_id,$medicine_to_user,$appointment_detail;
    public function mount($id){
        $this->ID = $id;
        $data = Treatments::find($id);
        $this->patient_id = $data->patient_id;
        $this->height = $data->height;
        $this->weight = $data->weight;
        $this->pressure = $data->pressure;
        $this->heartbeat = $data->heartbeat;
        $this->vak­_saeng = $data->vak­_saeng;
        $this->date = $data->date;
        $this->symptom = $data->symptom;
        $this->doctor_id = $data->d_id;
        $this->bongmati = $data->bongmati;
        $this->check_admit = $data->sleep_hospital;
        if($data->appointments =='Yes'){
            $this->appointments = 1;
            $appointment = appointment::where('treatment_id',$id)->first();
            $this->doctor_appointment_id = $appointment->d_id;
            $this->appointment_date = $appointment->date;
            $this->appointment_time = $appointment->time;
            $this->appointment_detail = $appointment->des;
        }

        $check_medicine = treatment_details::where('treatment_id',$id)->get();
        foreach($check_medicine as $item){
            $this->medicine_id[$item->medicine_id] = $item->medicine_id;
        }
       
       
    }
    public function render()
    {
      
        $patient = Patient::all();
        $doctor = User::where('role_id','!=',1)->get();
        $medicine = medicine::all();

        if($this->med_id){
            $this->addmedicine();
        }
       
        if ($this->medicine_id) {
            $this->medicine_to_user = medicine::whereIn('id', $this->medicine_id)->get();
        } else {
            $this->medicine_to_user = [];
        }
        return view('livewire.backend.treatment.detials-component',compact('patient','doctor','medicine'))->layout('layouts.backend');
    }
    public function setappointment_time($time){
        $this->appointment_time =$time;
    }

    public function addmedicine(){
        $this->medicine_id[$this->med_id] = $this->med_id;
      
        $this->med_id ='';
    }

    public function removemedicine($id){
        unset($this->medicine_id[$id]);
    }


    public function updateTreatment($id){

        if($this->appointments == 1){
            $this->validate([
                'doctor_appointment_id' => 'required',
                'appointment_date' => 'required',
                
            
            ], [
                'doctor_appointment_id.required' => __('lang.required_weight'),
                'appointment_date.required' => __('lang.required_weight'),
      
            ]);
        }
        if($this->appointment_date){
           if($this->appointment_time == null){
            $this->dispatch('required_time');
            return;
           }
        }
        $data = Treatments::find($id);
        $data->bongmati = $this->bongmati;
        $data->sleep_hospital = $this->check_admit;
        $data->bongmati = $this->bongmati;
        if($this->appointments == 1){
            $data->appointments = 'Yes';
        }else{
            $data->appointments = 'no';
        }
        $data->update();

        $delete_details = treatment_details::where('treatment_id',$data->id)->delete();
        foreach($this->medicine_to_user as $item){
            $detail = new treatment_details();
            $detail->treatment_id = $data->id;
            $detail->medicine_id = $item->id;
            $detail->save();
        }
        if($this->appointments == 1){
            $delete_appointment = appointment::where('treatment_id',$data->id)->delete();
            $appointments = new appointment();
            $appointments->treatment_id = $data->id;
            $appointments->patient_id = $this->patient_id;
            $appointments->d_id = $this->doctor_appointment_id;
            $appointments->date = $this->appointment_date;
            $appointments->time = $this->appointment_time;
            $appointments->des = $this->appointment_detail;
            $appointments->creator_id = auth()->user()->id;
            $appointments->save();
        }
        $this->dispatch('edit');
        // dd($this->appointment_date,$this->appointment_time,$this->doctor_appointment_id,$this->check_admit,$this->medicine_to_user,$this->bongmati,$this->appointment_detail);
    }

    
}
