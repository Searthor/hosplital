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
use Carbon\Carbon;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public
        $hiddenId,
        $search,
        $image,
        $page_number,
        $firstname,
        $lastname,
        $birthday,
        $phone,
        $password,
        $role_id,
        $confirm_password,
        $village,
        $dis_id,
        $pro_id,
        $nationality,
        $status,
        $gender,
        $ethnicity,
        $department_id,
        $old_image,
        $districts = [];

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
            $q->where('users.f_name', 'like', '%' . $this->search . '%')
                ->orwhere('users.l_name', 'like', '%' . $this->search . '%')
                ->orwhere('users.code', 'like', '%' . $this->search . '%')
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

        if ($this->pro_id) {
            $this->districts =  District::where('province_id', $this->pro_id)->get();
        }
        $provinces =  Province::get();
        $depament = Department::all();
        $roles = Role::all();

        return view('livewire.backend.settings.user-component', compact('depament', 'data', 'roles', 'provinces'))->layout('layouts.backend');
    }
    public function resetField()
    {
        $this->firstname = '';
        $this->lastname = '';
        $this->hiddenId = '';
        $this->phone = '';
        $this->password = '';
        $this->confirm_password = '';
        $this->role_id = '';
        $this->pro_id = '';
        $this->dis_id = '';
        $this->village = '';
        $this->ethnicity = '';
        $this->nationality = '';
        $this->old_image = '';
        $this->image= '';
        $this->gender= '';
        $this->status= '';
        $this->department_id= '';
        $this->birthday= null;
    }
    public function create()
    {
        $this->resetField();
        $this->dispatch('show-modal-add');
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
       
            $this->validate([
                'firstname' => 'required',
                'birthday' => 'required',
                'gender' => 'required',
                'phone' => 'required|unique:users,phone,' .$this->hiddenId,
                'role_id' => 'required',
                'department_id' => 'required',
                'nationality' => 'required',
                'ethnicity' => 'required',
            ], [
                'firstname.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'phone.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'phone.unique' => 'ຂໍ້ມູນນີ້ມີໃນລະບົບເເລ້ວ!',
                'role_id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'depament_id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'nationality.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'ethnicity.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'gender.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'birthday.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
              
            ]);

            try {
                $data = User::find($this->hiddenId);
                $data->f_name = $this->firstname;
                $data->l_name = $this->lastname;
                $data->gender = $this->gender;
                $data->birthday = $this->birthday;
                $data->phone = $this->phone;

                if ($this->password) {
                    $data->password = bcrypt($this->password);
                } 
                
                $data->role_id = $this->role_id;
                $data->village = $this->village;
                if ($this->dis_id) {
                    $data->dis_id = $this->dis_id;
                }
                if ($this->pro_id) {
                    $data->pro_id = $this->pro_id;
                }
                $data->nationality = $this->nationality;
                $data->status = $this->status;
                $data->ethnicity = $this->ethnicity;
                $data->department_id = $this->department_id;
                if ($this->image) {
                    $image= Carbon::now()->timestamp . '.' . $this->image->extension();
                    $this->image->storeAs('upload/doctor/', $image);
                    $data->image = 'upload/doctor/' . $image;
                }
                $data->update();
                $this->resetField();
                $this->dispatch('show-modal-hide');
                $this->dispatch('edit');
            } catch (\Exception $ex) {
                $this->dispatch('something_went_wrong');
            }
        } else {
            $this->validate([
                'firstname' => 'required',
                'birthday' => 'required',
                'gender' => 'required',
                'phone' => 'required|unique:users',
                'role_id' => 'required',
                'department_id' => 'required',
                'nationality' => 'required',
                'ethnicity' => 'required',
            ], [
                'firstname.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'phone.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'phone.unique' => 'ຂໍ້ມູນນີ້ມີໃນລະບົບເເລ້ວ!',
                'role_id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'depament_id.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'nationality.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'ethnicity.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'gender.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'birthday.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
            ]);

            $check_phone =  User::where('phone', $this->phone)->first();
            if ($check_phone) {
                $this->dispatch('phone_is_already');
                return;
            }
            if ($this->password) {
                if ($this->password != $this->confirm_password) {
                    $this->dispatch('something_went_wrong');
                    return;
                }
            }
          
            try {
                $code = $this->function_controller->generate_code('user');
                $data  =  new User();
                $data->code = $code;
                $data->f_name = $this->firstname;
                $data->l_name = $this->lastname;
                $data->gender = $this->gender;
                $data->birthday = $this->birthday;
                $data->phone = $this->phone;
                if ($this->password) {
                    $data->password = bcrypt($this->password);
                } else {
                    $data->password = bcrypt($this->phone);
                }
                $data->role_id = $this->role_id;
                $data->village = $this->village;
                if ($this->dis_id) {
                    $data->dis_id = $this->dis_id;
                }
                if ($this->pro_id) {
                    $data->pro_id = $this->pro_id;
                }
                $data->nationality = $this->nationality;
                $data->status = $this->status;
                $data->ethnicity = $this->ethnicity;
                $data->department_id = $this->department_id;
                if ($this->image) {
                    $image= Carbon::now()->timestamp . '.' . $this->image->extension();
                    $this->image->storeAs('upload/doctor/', $image);
                    $data->image = 'upload/doctor/' . $image;
                }
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
        $this->firstname = $data->f_name;
        $this->lastname = $data->l_name;
        $this->phone = $data->phone;
        $this->birthday = $data->birthday;
        $this->nationality = $data->nationality;
        $this->status = $data->status;
        $this->ethnicity = $data->ethnicity;
        $this->department_id = $data->department_id;
        $this->gender = $data->gender;
        $this->role_id = $data->role_id;
        $this->pro_id = $data->pro_id;
        $this->dis_id = $data->dis_id;
        $this->village = $data->village;
        $this->old_image = $data->image;
        $this->dispatch('show-modal-add');
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
            $data->delete();
            $this->resetField();
            $this->dispatch('hide-modal-delete');
            $this->dispatch('delete');
        } catch (\Exception $ex) {
            $this->dispatch('something_went_wrong');
        }
    }
}
