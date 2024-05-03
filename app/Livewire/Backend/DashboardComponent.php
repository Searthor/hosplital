<?php

namespace App\Livewire\Backend;

use App\Models\appointment;
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
        $all_appointment  = appointment::all();

        if (auth()->user()->role_id == 1) {
            $all_appointment = $all_appointment;
        } else {
            $all_appointment = $all_appointment->where('d_id', auth()->user()->id);
        }

        $count_Patient = Treatments::selectRaw('date, count(id) as count_id')
            ->groupByRaw('date')
            ->get();

        $date = [];
        $count = [];
        foreach ($count_Patient as $item) {
            $date[] = $item->date;
            $count[] = $item->count_id;
        }
        return view('livewire.backend.dashboard-component', compact('all_user', 'all_patient', 'all_treatment', 'all_treatment_today', 'date', 'count', 'all_appointment'))->layout('layouts.backend');
    }
    public function logout()
    {
        Auth::logout();
        session()->flash('success', 'ອອກລະບົບສຳເລັດເເລ້ວ');
        return redirect(route('backend.login'));
    }
}
