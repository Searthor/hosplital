<?php

namespace App\Livewire\Backend\Settings;

use App\Models\District;
use App\Models\Province;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ProvinceComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $ID,$name_la,$name_en,$search,$page_number;
    public function mount(){
        $this->page_number=10;
    }
    public function render()
    {
        $data = Province::orderBy('id', 'desc')
            ->where(function ($q) {
                $q->where('name_la', 'like', '%' . $this->search . '%')
                    ->orwhere('name_en', 'like', '%' . $this->search . '%');
            });
        if($this->page_number != "all"){
            $data = $data->paginate($this->page_number);
        }else{
            $data = $data->get();
        }
        return view('livewire.backend.settings.province-component',compact('data'))->layout('layouts.backend');
    }
    public function store()
    {
        $updateId = $this->ID;
        if ($updateId > 0) {
            $this->validate([
                'name_la' => 'required|unique:provinces,id,' . $this->ID,
            ], [
                'name_la.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
            ]);
            $data = Province::find($updateId);
            $data->name_la = $this->name_la;
            $data->name_en = $this->name_en;
            $data->save();
            $this->dispatch('edit');
            $this->resetform();
        } else //ເພີ່ມໃໝ່
        {
            $this->validate([
                'name_la' => 'required|unique:provinces',
            ], [
                'name_la.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'name_la.unique' => 'ຂໍ້ມູນນີ້ມີໃນລະບົບເເລ້ວ!',
            ]);
            try {
                DB::beginTransaction();
                $data = new Province();
                $data->name_la = $this->name_la;
                $data->name_en = $this->name_en;
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
        $data = Province::find($ids);
        $this->name_la = $data->name_la;
        $this->name_en = $data->name_en;
        $this->ID = $data->id;
    }

    public function resetform()
    {
        $this->name_la = '';
        $this->name_en = '';
  
        $this->ID = '';
    }

    public function showDestroy($ids)
    {
        $this->dispatch('show-modal-delete');
        $data = Province::find($ids);
        $this->ID = $data->id;
        $this->name_la = $data->name_la;
        
    }
    public function destroy($ids)
    {
        $check = District::where('province_id',$this->ID)->get();
        if(count($check)>0){
            $this->dispatch('can_not_delete');
            return;
        }
        // $ids = $this->ID;
        // $data = Province::find($ids);
        // $data->delete();
        $this->dispatch('hide-modal-delete');
        $this->dispatch('delete');
        $this->resetform();
    }
}
