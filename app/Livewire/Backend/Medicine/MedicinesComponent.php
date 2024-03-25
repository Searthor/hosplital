<?php

namespace App\Livewire\Backend\Medicine;

use App\Models\medicine;
use App\Models\medicine_type;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class MedicinesComponent extends Component
{
    public $ID,$type,$name,$detail,$search;
    public function render()
    {
        $medicinesType = medicine_type::all();
        $data = medicine::where(function ($q) {
            $q->where('med_name', 'like', '%' . $this->search . '%')
                ->orwhere('des', 'like', '%' . $this->search . '%');  
            })
        ->get();
        return view('livewire.backend.medicine.medicines-component',compact('medicinesType','data'))->layout('layouts.backend');
    }
    public function resetform()
    {
        $this->ID = '';
        $this->name = '';
        $this->type = '';
        $this->detail = '';
    }
    public function store()
    {
        $updateId = $this->ID;
        if ($updateId > 0) {
            try {
                DB::beginTransaction();

                $this->validate([
                    'name' => 'required|unique:medicines,med_name,' . $this->ID,
                    'type' => 'required',
                ], [
                    'name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                    'type.required' => 'ຂໍ້ມູນນີ້ມີໃນລະບົບເເລ້ວ!',
                ]);
                $data = medicine::find($updateId);
                $data->med_name = $this->name;
                $data->med_type_id = $this->type;
                $data->des = $this->detail;
                $data->update();
                $this->dispatch('edit');
                $this->resetform();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                $this->dispatch('something_went_wrong');
            }
        } else //ເພີ່ມໃໝ່
        {
            $check  = medicine::where('med_name',$this->name)->get();
            if(count($check)>0){
                $this->dispatch('already_data');
                return;
                
            }

            $this->validate([
                'name' => 'required|unique:medicines,med_name,',
                'type' => 'required',
            ], [
                'name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'type.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
            ]);
            try {
                DB::beginTransaction();
                $data = new medicine();
                $data->med_name = $this->name;
                $data->med_type_id = $this->type;
                $data->des = $this->detail;
                $data->save();
                $this->dispatch('add');
                $this->resetform();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                $this->dispatch('something_went_wrong');
            }
        }
    }

    public function edit($ids)
    {
        $this->resetform();
        $data = medicine::find($ids);
        $this->name = $data->med_name;
        $this->type = $data->med_type_id;
        $this->detail = $data->des;
        $this->ID = $data->id;
    }
    public function showDestroy($ids)
    {
        $this->dispatch('show-modal-delete');
        $data = medicine::find($ids);
        $this->ID = $data->id;
        $this->name = $data->med_name;
        
    }
    public function destroy($ids)
    {
        $data = medicine::find($ids);
        $data->delete();
        $this->dispatch('hide-modal-delete');
        $this->dispatch('delete');
        $this->resetform();
    }
}
