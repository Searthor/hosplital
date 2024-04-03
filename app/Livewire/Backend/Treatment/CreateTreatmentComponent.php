<?php

namespace App\Livewire\Backend\Treatment;

use App\Models\Patient;
use App\Models\Treatments;
use Livewire\Component;

class CreateTreatmentComponent extends Component
{
    public $code;
    public $patient_id, $height, $weight, $pressure, $hearbeat,
        $vak­_saeng, $date, $symptom, $old_new;
    public function mount()
    {
        $code = '';
        while (true) {
            $code = rand('100000', '999999');
            $check_code = Treatments::where('code', $code)->get();
            if (count($check_code) == 0) {
                break;
            }
        }
        $this->code = 'TM-' . $code;
    }

    public function render()
    {
        $data = Patient::where("del", 1)->get();
        return view('livewire.backend.treatment.create-treatment-component', compact('data'))->layout('layouts.backend');
    }


    public function resetField(){
        $this->patient_id = null;
        $this->height=null;
        $this->weight=null;
        $this->pressure=null;
        $this->hearbeat=null;
        $this->vak­_saeng=null;
        $this->date=null;
        $this->symptom=null;
        $this->old_new=0;
    }



    public function storeStore()
    {
        if ($this->patient_id == null) {
            $this->dispatch('required_patient');
            $this->resetValidation();
            return;
        }
        $this->validate([
            'height' => 'required',
            'weight' => 'required',
            'pressure' => 'required',
            'hearbeat' => 'required',
            'date' => 'required',
            // 'symptom' => 'required',
        ], [
            'weight.required' => __('lang.required_weight'),
            'height.required' => 'ປ້ອມລວງສູງ',
            'pressure.required' => 'ປ້ອມຄວາມດັນ',
            'hearbeat.required' => 'ປ້ອມຂໍ້ມູນກ່ອນ',
            'date.required' => 'ເລືອກວັນທີ່ກ່ອນ!',
            // 'symptom.required' => 'ລາຍລະອຽດ!',
        ]);
        try {
            $data = new Treatments();
            $data->d_id = auth()->user()->id;
            $data->code = $this->code;
            $data->patient_id = $this->patient_id;
            $data->symptom = $this->symptom;
            // $data->heartbeat = $this->heartbeat;
            $data->pressure = $this->pressure;
            $data->weight = $this->weight;
            $data->height = $this->height;
            $data->vak­_saeng = $this->vak­_saeng;
            $data->date = $this->date;
            $data->save();
            $this->resetField();
            $this->dispatch('add');
            return redirect()->route('backend.treatment');
        } catch (\Exception $ex) {
            $this->dispatch('something_went_wrong');
        }
    }
}
