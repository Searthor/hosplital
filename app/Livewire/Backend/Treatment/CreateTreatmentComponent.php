<?php

namespace App\Livewire\Backend\Treatment;

use App\Http\Controllers\Function\FunctionController;
use App\Models\Patient;
use App\Models\Treatments;
use App\Models\User;
use Livewire\Component;

class CreateTreatmentComponent extends Component
{
    public $code;
    public $patient_id, $height, $weight, $pressure, $hearbeat,
        $vak­_saeng, $date, $symptom, $old_new;
    public function mount()
    {
        $code = $this->function_controller->generate_code('Treatments');
        $this->code = 'TM-' . $code;
    }
    protected $function_controller;
    public function __construct()
    {
        $this->function_controller = app()->make(FunctionController::class);
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
