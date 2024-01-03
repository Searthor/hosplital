<?php

namespace App\Livewire\Backend\Settings;

use App\Http\Controllers\Function\FunctionController;
use App\Models\Branch;
use App\Models\Department;
use App\Models\District;
use App\Models\Province;
use App\Models\Role;
use App\Models\ServiceUnit;
use App\Models\User;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public
        $hiddenId,
        $search, $page_number,
        $firstname,
        $lastname,
        $phone,
        $email,
        $password, $role_id,
        $confirm_password,
        $branch_id,
        $vill_id,
        $dis_id,
        $pro_id,
        $districts = [],
        $villages = [];
    
    protected $function_controller;
    public function __construct()
    {
        $this->function_controller = app()->make(FunctionController::class);
    }
    public function hydrate()
    {
        $this->dispatch('role_id');
    }
    public function mount()
    {
        $this->search = '';
        $this->page_number  = 10;
    }
    public function render()
    {
        $data = User::select('users.*')->where(function ($q) {
            $q->where('users.firstname', 'like', '%' . $this->search . '%')
                ->orwhere('users.lastname', 'like', '%' . $this->search . '%')
                ->orwhere('users.phone', 'like', '%' . $this->search . '%');
        })->where('users.del', 1)->orderBy('id', 'desc');
        
        if (!empty($data)) {
            if ($this->page_number == 'all') {
                $data = $data->get();
            } else {
                $data = $data->paginate($this->page_number);
            }
        } else {
            $data = [];
        }
        
       if(auth()->user()->role_id == 1){
            $roles = Role::select('roles.*')->get();
       }else{
            $roles = Role::select('roles.*')->whereNotIn('roles.id',[1,2,3])->get();
       }
       
        if ($this->pro_id) {
            $this->districts =  District::where('province_id', $this->pro_id)->get();
        }
        if ($this->dis_id) {
            $this->villages =  Village::where('district_id', $this->dis_id)->get();
        }
        $provinces =  Province::get();
        
        return view('livewire.backend.settings.user-component', compact('data', 'roles','provinces'))->layout('layouts.backend');
    }
    public function resetField()
    {
        $this->firstname = '';
        $this->lastname = '';
        $this->hiddenId = '';
        $this->phone = '';
        $this->email = '';
        $this->password = '';
        $this->confirm_password = '';
        $this->role_id = '';
        $this->pro_id = '';
        $this->vill_id = '';
        $this->dis_id = '';
       
    }
    public function create()
    {
        $this->resetField();
        $this->dispatch('show-modal-add');
    }
    protected $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'phone' => 'required',
        'password' => 'required',
        'role_id' => 'required',
        'pro_id' => 'required',
        'dis_id' => 'required',
        'vill_id' => 'required',
        'confirm_password' => 'required',
       
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function Store()
    {
        if ($this->hiddenId) {
            if ($this->password) {
                if ($this->password != $this->confirm_password) {
                    $this->dispatch('something_went_wrong');
                    return;
                }
            }
            try {
                $data = User::find($this->hiddenId);
                if ($this->firstname) {
                    $data->firstname = $this->firstname;
                }
                if ($this->lastname) {
                    $data->lastname = $this->lastname;
                }
                if ($this->phone) {
                    $data->phone = $this->phone;
                }
                $data->email = $this->email;
                if ($this->password) {
                    $data->password = bcrypt($this->password);
                }
                if ($this->role_id) {
                    $data->role_id = $this->role_id;
                }
                if ($this->vill_id) {
                    $data->vill_id = $this->vill_id;
                }
                if ($this->pro_id) {
                    $data->pro_id = $this->pro_id;
                }
                if ($this->dis_id) {
                    $data->dis_id = $this->dis_id;
                }
                $data->save();
                $this->resetField();
                $this->dispatch('show-modal-hide');
                $this->dispatch('edit');
            } catch (\Exception $ex) {
                $this->dispatch('something_went_wrong');
            }
        } else {
            $this->validate();
            $check_phone =  User::where('phone', $this->phone)->first();
            if($check_phone){
                $this->dispatch('phone_is_already');
                return;
            }
            if ($this->function_controller->check_admin() == true) {
                $this->validate([
                    'branch_id' => 'required',
                    'service_units_id' => 'required',
                ], [
                    'branch_id.required' => 'ເລືອກສາຂາກ່ອນ',
                    'service_units_id' => 'ເລືອກໜ່ວຍບໍລະການກ່ອນ'
                ]);
            }
            if($this->function_controller->check_permission('access_user_service_unit') ==  true){
                $this->validate([
                    'service_units_id' => 'required',
                ], [
                    'service_units_id' => 'ເລືອກໜ່ວຍບໍລະການກ່ອນ'
                ]);
            }
            if ($this->password != $this->confirm_password) {
                $this->dispatch('something_went_wrong');
                return;
            }
            try {
                $data  =  new User();
                $data->firstname = $this->firstname;
                $data->lastname = $this->lastname;
                $data->phone = $this->phone;
                $data->email = $this->email;
                $data->password = bcrypt($this->password);
                $data->role_id = $this->role_id;
                $data->vill_id = $this->vill_id;
                $data->dis_id = $this->dis_id;
                $data->pro_id = $this->pro_id;
                $data->save();
                $this->resetField();
                $this->dispatch('show-modal-hide');
                $this->dispatch('add');
            } catch (\Exception $ex) {
                $this->dispatch('something_went_wrong');
            }
        }
    }
    public function edit($id)
    {
        $this->resetField();
        $this->hiddenId = $id;
        $data = User::find($id);
        $this->firstname = $data->firstname;
        $this->lastname = $data->lastname;
        $this->phone = $data->phone;
        $this->email = $data->email;
        $this->role_id = $data->role_id;
        $this->branch_id = $data->branches_id;
        $this->vill_id = $data->vill_id;
        $this->pro_id = $data->pro_id;
        $this->dis_id = $data->dis_id;
        $this->dispatch('show-modal-add');
    }
    public function update()
    {
        try {
            $this->resetField();
            $this->dispatch('show-modal-hide');
            $this->dispatch('edit');
        } catch (\Error $ex) {
            $this->dispatch('something_went_wrong');
        }
    }
    public function showDestroy($ids)
    {
        $singleData = User::find($ids);
        $this->hiddenId = $singleData->id;
        $this->dispatch('show-modal-delete');
    }
    public function destroy()
    {
        $ids = $this->hiddenId;
        try {
            $data = User::find($ids);
            $data->del = 0;
            $data->update();
            $this->resetField();
            $this->dispatch('hide-modal-delete');
            $this->dispatch('delete');
        } catch (\Exception $ex) {
            $this->dispatch('something_went_wrong');
        }
    }
}
