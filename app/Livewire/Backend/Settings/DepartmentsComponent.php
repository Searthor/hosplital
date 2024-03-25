<?php

namespace App\Livewire\Backend\Settings;

use App\Models\Department;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
class DepartmentsComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $ID,$dep_name_la,$dep_name_en,$detail,$search;
    public function render()
    {
        
        $data = Department::orderBy('id', 'desc')
            ->where(function ($q) {
                $q->where('dep_name_la', 'like', '%' . $this->search . '%')
                    ->orwhere('dep_name_en', 'like', '%' . $this->search . '%');
        });

        if(!empty($data)){
            $data = $data->paginate(10);
        }else{
            $data= [];
        }
        return view('livewire.backend.settings.departments-component',compact('data'))->layout('layouts.backend');
    }


    public function resetform(){
        $this->dep_name_en='';
        $this->dep_name_la='';
        $this->detail='';
        $this->ID='';
    }

    public function store(){
        $updateId = $this->ID;
        if ($updateId > 0) {
            $this->validate([
                'dep_name_la' => 'required|unique:departments,dep_name_la,' . $this->ID,
            ], [
                'dep_name_la.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'dep_name_la.unique' => 'ຂໍ້ມູນນີ້ມີໃນລະບົບເເລ້ວ!',
            ]);
            $data = Department::find($updateId);
            $data->dep_name_la = $this->dep_name_la;
            $data->dep_name_en = $this->dep_name_en;
            $data->dep_detail = $this->detail;
            $data->save();
            $this->dispatch('edit');
            $this->resetform();
        } else //ເພີ່ມໃໝ່
        {
            $this->validate([
                'dep_name_la' => 'required|unique:departments',
            ], [
                'dep_name_la.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'dep_name_la.unique' => 'ຂໍ້ມູນນີ້ມີໃນລະບົບເເລ້ວ!',
            ]);
            try {
                DB::beginTransaction();
                $data = new Department();
                $data->dep_name_la = $this->dep_name_la;
                $data->dep_name_en = $this->dep_name_en;
                $data->dep_detail = $this->detail;
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
        $data = Department::find($ids);
        $this->dep_name_la = $data->dep_name_la;
        $this->dep_name_en = $data->dep_name_en;
        $this->detail = $data->dep_detail;
        $this->ID = $data->id;
    }


    public function showDestroy($ids)
    {
        $this->dispatch('show-modal-delete');
        $data = Department::find($ids);
        $this->ID = $data->id;
        $this->dep_name_la = $data->dep_name_la;
        
    }

    public function destroy($ids)
    {
        $check = User::where('department_id',$this->ID)->get();
        if(count($check)>0){
            $this->dispatch('can_not_delete');
            return;
        }
        $data = Department::find($ids);
        $data->delete();
        $this->dispatch('hide-modal-delete');
        $this->dispatch('delete');
        $this->resetform();
    }
}
