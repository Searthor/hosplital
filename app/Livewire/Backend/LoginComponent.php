<?php

namespace App\Livewire\Backend;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $phone, $password;
    public function render()
    {
        return view('livewire.backend.login-component')->layout('layouts.login');
    }
    public function login()
    {
        $this->validate([
            'phone' => 'required',
            'password' => 'required',
        ], [
            'phone.required' => 'ກະລຸນາປ້ອນເບີໂທກ່ອນ!',
            'password.required' => 'ກະລຸນາປ້ອນລະຫັດຜ່ານກ່ອນ!',
        ]);
        if (Auth::attempt(
            [
                'phone' => $this->phone,
                'password' => $this->password
            ],
        )) {
            session()->flash('success', 'ເຂົ້າສູ່ລະບົບສຳເລັດເເລ້ວ');
            return redirect(route('backend.dashboard'));
        } else {
            $this->dispatch('login_faild');
        }
    }
}
