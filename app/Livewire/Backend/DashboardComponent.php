<?php

namespace App\Livewire\Backend;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardComponent extends Component
{
    public $search, $start_date, $end_date;
    public function render()
    {
        return view('livewire.backend.dashboard-component')->layout('layouts.backend');
    }
    public function logout()
    {
        Auth::logout();
        session()->flash('success', 'ອອກລະບົບສຳເລັດເເລ້ວ');
        return redirect(route('backend.login'));
    }
}
