<?php

namespace App\Livewire\Backend;

use App\Models\Patient;
use App\Models\Treatments;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardComponent extends Component
{
    public $search, $start_date, $end_date;
    public function render()
    {
        $all_user = User::all();
        $all_patient = Patient::all();
        $all_treatment = Treatments::all();
        $all_treatment_today = Treatments::all();
        return view('livewire.backend.dashboard-component',compact('all_user','all_patient','all_treatment','all_treatment_today'))->layout('layouts.backend');
    }
    public function logout()
    {
        Auth::logout();
        session()->flash('success', 'ອອກລະບົບສຳເລັດເເລ້ວ');
        return redirect(route('backend.login'));
    }
}
