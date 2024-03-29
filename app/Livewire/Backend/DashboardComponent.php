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
        $count_Patient = Patient::selectRaw('DATE(created_at) as date, count(id) as count_id')
                ->groupBy('date')
                ->get();
        $date =[];
        $count =[];
        foreach($count_Patient as $item){
            $date[] = $item->date;
            $count[] = $item->count_id;

        }
        return view('livewire.backend.dashboard-component',compact('all_user','all_patient','all_treatment','all_treatment_today','date','count'))->layout('layouts.backend');
    }
    public function logout()
    {
        Auth::logout();
        session()->flash('success', 'ອອກລະບົບສຳເລັດເເລ້ວ');
        return redirect(route('backend.login'));
    }
}
