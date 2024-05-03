<?php

namespace App\Livewire\Backend\Report;

use App\Models\Patient;
use Livewire\Component;

class ReportPateintComponent extends Component
{
    public $start_date,$end_date;
    public function render()
    {


        $pateunts =  Patient::all();
        $end = date('Y-m-d H:i:s', strtotime($this->end_date . '23:23:59'));

        if ($this->start_date && $this->end_date) {
      
            $pateunts = $pateunts->whereBetween('created_at', [$this->start_date, $end]);
        }
        return view('livewire.backend.report.report-pateint-component',compact('pateunts'))->layout('layouts.backend');
    }
}
