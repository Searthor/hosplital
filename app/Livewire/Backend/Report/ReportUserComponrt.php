<?php

namespace App\Livewire\Backend\Report;

use App\Models\User;
use Livewire\Component;

class ReportUserComponrt extends Component
{
    public $end_date,$start_date;
    public function render()
    {
        $data =User::all();
        return view('livewire.backend.report.report-user-componrt',compact('data'))->layout('layouts.backend');
    }
}
