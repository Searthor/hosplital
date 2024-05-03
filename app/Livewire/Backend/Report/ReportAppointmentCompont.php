<?php

namespace App\Livewire\Backend\Report;

use App\Models\appointment;
use Livewire\Component;

class ReportAppointmentCompont extends Component
{
    public $start_date,$end_date;
    public function render()
    {
        $data = appointment::all();
        return view('livewire.backend.report.report-appointment-compont',compact('data'))->layout('layouts.backend');
    }
}
