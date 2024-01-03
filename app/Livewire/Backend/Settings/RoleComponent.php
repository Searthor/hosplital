<?php

namespace App\Livewire\Backend\Settings;

use App\Models\FunctionAvailable;
use App\Models\FunctionModel;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class RoleComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name,
        $hiddenId,
        $search, $des,
        $selected = [], $page_number;
    public function mount()
    {
        $this->page_number  = 10;
    }
    public function render()
    {
        $data = Role::where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
                ->orwhere('des', 'like', '%' . $this->search . '%');
        })->orderBy('id', 'desc');
        if (!empty($data)) {
            if ($this->page_number == 'all') {
                $data =  $data->get();
            } else {
                $data =  $data->paginate($this->page_number);
            }
        } else {
            $data = [];
        }
        $functions = FunctionModel::whereNull('parent_id')->get();
        return view('livewire.backend.settings.role-component', compact('data', 'functions'))->layout('layouts.backend');
    }
    public function resetField()
    {
        $this->name = '';
        $this->selected = [];
        $this->hiddenId = '';
        $this->des = '';
    }
    public function create()
    {
        $this->resetField();
        $this->dispatch('show-modal-add');
    }
    public function Store()
    {
        $this->validate([
            'name' => 'required|unique:roles',
        ], [
            'name.required' => __('lang.please_fill_information_first')
        ]);
        try {
            DB::beginTransaction();
            $data = new Role();
            $data->name = $this->name;
            $data->des = $this->des;
            $data->save();
            for ($i = 0; $i < count($this->selected); $i++) {
                $check_already = FunctionAvailable::where('role_id', $data->id)->where('function_id', $this->selected[$i])->first();
                if (!$check_already) {
                    $function = new FunctionAvailable();
                    $function->role_id = $data->id;
                    $function->function_id = $this->selected[$i];
                    $function->save();
                }
            }
            DB::commit();
            $this->resetField();
            $this->dispatch('show-modal-hide');
            $this->dispatch('add');
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->dispatch('something_went_wrong');
        }
    }
    public function edit($id)
    {
        $this->resetField();
        $this->hiddenId = $id;
        $data = Role::find($id);
        if ($data) {
            $this->name = $data->name;
            $this->des = $data->des;
        }
        $selectData = FunctionAvailable::select('function_availables.*')
            ->join('function_models as f', 'f.id', '=', 'function_availables.function_id')->where('function_availables.role_id', $id)->pluck('function_availables.function_id')->toArray();
        if (count($selectData) > 0) {
            $this->selected = $selectData;
        }
        $this->dispatch('show-modal-add');
    }
    public function update()
    {

        $this->validate([
            'name' => 'required',
        ], [
            'name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ',
        ]);
        try {
            DB::beginTransaction();
            $data = Role::find($this->hiddenId);
            if ($this->name) {
                $data->name = $this->name;
            }
            if ($this->des) {
                $data->des = $this->des;
            }
            $data->save();
            FunctionAvailable::where('role_id', $this->hiddenId)->delete();
            if (count($this->selected) > 0) {
                for ($i = 0; $i < count($this->selected); $i++) {
                    $check_already = FunctionAvailable::select('function_availables.*')
                        ->where('function_availables.role_id', $this->hiddenId)
                        ->where('function_availables.function_id', $this->selected[$i])->first();
                    if (!$check_already && intval($this->selected[$i]) > 0) {
                        $function = new FunctionAvailable();
                        $function->role_id = $data->id;
                        $function->function_id = $this->selected[$i];
                        $function->save();
                    }
                }
            }
            DB::commit();
            $this->resetField();
            $this->dispatch('show-modal-hide');
            $this->dispatch('edit');
        } catch (\Error $ex) {
            DB::rollBack();
            $this->dispatch('something_went_wrong');
        }
    }
    public function showDestroy($ids)
    {
        $singleData = Role::find($ids);
        $this->hiddenId = $singleData->id;
        $this->dispatch('show-modal-delete');
    }
    public function delete_parent($ids)
    {
        $check_parent = FunctionModel::where('parent_id', $ids)->get();
        foreach ($check_parent as $parent_item) {
            $function_child = FunctionModel::where('parent_id', $parent_item->id)->pluck('id')->map(fn ($id) => (string)$id)->toArray();
            $this->selected = array_merge(array_diff($this->selected, $function_child));
        }
        $function = FunctionModel::where('parent_id', $ids)->pluck('id')->map(fn ($id) => (string)$id)->toArray();
        $this->selected = array_merge(array_diff($this->selected, $function));
    }
    public function delete_child($ids)
    {
        $function = FunctionModel::where('parent_id', $ids)->pluck('id')->map(fn ($id) => (string)$id)->toArray();
        $this->selected = array_merge(array_diff($this->selected, $function));
    }


    public function destroy()
    {
        $ids = $this->hiddenId;
        if (User::where('role_id', $ids)->first()) {
            $this->dispatch('hide-modal-delete');
            $this->dispatch('can_not_delete');
            return;
        }
        if (FunctionAvailable::where('role_id', $ids)->first()) {
            $this->dispatch('hide-modal-delete');
            $this->dispatch('can_not_delete');
            return;
        }
        try {
            $data = Role::find($ids);
            $data->delete();
            $this->resetField();
            $this->dispatch('hide-modal-delete');
            $this->dispatch('delete');
        } catch (\Exception $ex) {
            $this->dispatch('something_went_wrong');
        }
    }
}
