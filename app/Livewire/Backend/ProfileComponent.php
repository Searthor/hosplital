<?php

namespace App\Livewire\Backend;

use App\Models\Branch;
use App\Models\District;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use App\Models\Village;
use Livewire\Component;

class ProfileComponent extends Component
{
    public $vill_id,
        $dis_id,
        $pro_id,
        $districts = [],
        $villages = [], $firstname, $lastname, $phone, $address, $email, $password, $confirm_password;
    public function mount()
    {
        $this->firstname =  auth()->user()->firstname;
        $this->lastname =  auth()->user()->lastname;
        $this->phone =  auth()->user()->phone;
        $this->email =  auth()->user()->email;
        $this->address =  auth()->user()->address;
        $this->vill_id =  auth()->user()->vill_id;
        $this->dis_id =  auth()->user()->dis_id;
        $this->pro_id =  auth()->user()->pro_id;
        
    }
    public function render()
    {
        $data = User::find(auth()->user()->id);
        $this->firstname = $data->firstname;
        $this->lastname =  $data->lastname;
        $this->phone =  $data->phone;
        $this->email =  $data->email;
        $this->address =  $data->address;
        $this->vill_id =  $data->vill_id;
        $this->dis_id =  $data->dis_id;
        $this->pro_id =  auth()->user()->pro_id;
        
        if ($this->pro_id) {
            $this->districts =  District::where('province_id', $this->pro_id)->orderBy('name_la')->get();
        }
        if ($this->dis_id) {
            $this->villages =  Village::where('district_id', $this->dis_id)->orderBy('name_la')->get();
        }
        $provinces =  Province::get();
        $roles =   Role::get();
        return view('livewire.backend.profile-component', compact('provinces', 'roles'))->layout('layouts.backend');
    }
    public function resetField()
    {
        $this->firstname = '';
        $this->lastname = '';
        $this->phone = '';
        $this->email = '';
        $this->password = '';
        $this->confirm_password = '';
        $this->pro_id = '';
        $this->vill_id = '';
        $this->dis_id = '';
    }
    public function updateProfile()
    {
        if ($this->password) {
            if ($this->password != $this->confirm_password) {
                $this->dispatch('something_went_wrong');
                return;
            }
        }
        try {
            $data = User::find(auth()->user()->id);
            $data->firstname = $this->firstname;
            $data->lastname = $this->lastname;
            $data->phone = $this->phone;
            $data->email = $this->email;
            if ($this->password) {
                $data->password = bcrypt($this->password);
            }
            $data->vill_id = $this->vill_id;
            $data->pro_id = $this->pro_id;
            $data->dis_id = $this->dis_id;
            $data->update();
            $this->mount();
            $this->dispatch('show-modal-hide');
            $this->dispatch('edit');
        } catch (\Exception $ex) {
            $this->dispatch('something_went_wrong');
        }
    }
}
