<?php

namespace App\Livewire\Backend\Medicine;

use App\Models\medicine;
use App\Models\medicine_type;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class MedicineTypesComponent extends Component
{
    public $ID, $detail, $type_name,$search;
    public function render()
    {
        $data = medicine_type::where(function ($q) {
            $q->where('type_name', 'like', '%' . $this->search . '%')
                ->orwhere('des', 'like', '%' . $this->search . '%');  
            })
            ->get();
        return view('livewire.backend.medicine.medicine-types-component', compact('data'))->layout('layouts.backend');
    }

    public function resetform()
    {
        $this->ID = '';
        $this->type_name = '';
        $this->detail = '';
    }


    public function store()
    {
        $updateId = $this->ID;
        if ($updateId > 0) {
            try {
                DB::beginTransaction();

                $this->validate([
                    'type_name' => 'required|unique:medicine_types,type_name,' . $this->ID,
                ], [
                    'type_name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                    'type_name.unique' => 'ຂໍ້ມູນນີ້ມີໃນລະບົບເເລ້ວ!',
                ]);
                $data = medicine_type::find($updateId);
                $data->type_name = $this->type_name;
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
            $check  = medicine_type::where('type_name',$this->type_name)->get();
            if(count($check)>0){
                $this->dispatch('already_data');
                return;
                
            }
            $this->validate([
                'type_name' => 'required|unique:medicine_types,type_name,',
            ], [
                'type_name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
              

            ]);
            try {
                DB::beginTransaction();
                $data = new medicine_type();
                $data->type_name = $this->type_name;
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
        $data = medicine_type::find($ids);
        $this->type_name = $data->type_name;
        $this->detail = $data->des;
        $this->ID = $data->id;
    }
    public function showDestroy($ids)
    {
        $this->dispatch('show-modal-delete');
        $data = medicine_type::find($ids);
        $this->ID = $data->id;
        $this->type_name = $data->type_name;
        
    }
    public function destroy($ids)
    {
        $check = medicine::where('med_type_id',$ids)->get();
        if(count($check)> 0){
            $this->resetform();
            $this->dispatch('can_not_delete');
            $this->dispatch('hide-modal-delete');
            return;
        }
        $data = medicine_type::find($ids);
        $data->delete();
        $this->dispatch('hide-modal-delete');
        $this->dispatch('delete');
        $this->resetform();
    }
}
