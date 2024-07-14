<?php

namespace App\Livewire\Backend\Appointments;

use App\Models\appointment;
use App\Models\Patient;
use App\Models\Treatments;
use App\Models\User;
use Livewire\Component;

class AppointmentConponent extends Component
{
    public $hiddenId, $doctor_id, $appointment_date, $appointment_time, $patient_id, $appointment_detail, $check_time = [];
    public $time_list = [];
    public function render()
    {
        $doctor = User::where('role_id', '!=', 1)->get();
        $patient = Patient::all();

        $appointments = Appointment::orderBy('id', 'desc')->get();
        // $data = Appointment::leftjoin('patients', 'guarantee_types.id', 'guarantees.name')
        // ->leftjoin('guarantee_types  as type', 'type.id', 'guarantees.guarantee_types_id')
        // ->where(function ($q) use ($search) {
        //     $q->orwhere('guarantee_types.name_la', 'like', '%' . $search . '%');
        //     $q->orwhere('type.name_la', 'like', '%' . $search . '%');
        //     $q->orwhere('guarantees.land_number', 'like', '%' . $search . '%');
        //     $q->orwhere('guarantees.land_name', 'like', '%' . $search . '%');
        //     $q->orwhere('guarantees.serial_number', 'like', '%' . $search . '%');
        // })
        // ->select('guarantees.*')
        // ->where('guarantees.del', 1)
        // ->orderBy('guarantees.id', 'desc');

        if (auth()->user()->role_id == 1) {
            $appointments  = $appointments;
        } else {
            $appointments  = $appointments->where('d_id', auth()->user()->id);
        }
        if ($this->appointment_date) {
            $this->check_time = Appointment::where('d_id', $this->doctor_id)->where('date', $this->appointment_date)->get();
        }


        for ($i = 10; $i <= 16; $i++) {
            $status = 'Yes';
            if (count($this->check_time) > 0) {
                foreach ($this->check_time as $item) {
                    if ($item->time == str($i)) {
                        $status = 'No';
                    }
                }
            }
            $this->time_list[$i] = [
                'time' => $i,
                'status' => $status
            ];
        }








        return view('livewire.backend.appointments.appointment-conponent', compact('doctor', 'patient', 'appointments'))->layout('layouts.backend');
    }

    public function setappointment_time($time)
    {
        $this->appointment_time = $time;
    }

    public function create()
    {
        $this->resetdata();
        $this->dispatch('show-modal-add');
    }

    public function resetdata()
    {
        $this->patient_id = '';
        $this->doctor_id = '';
        $this->appointment_date = '';
        $this->appointment_time = '';
        $this->appointment_detail = '';
        $this->old_time='';
    }
    public function Store()
    {

        $this->validate([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'appointment_date' => 'required',

        ], [
            'patient_id.required' => __('lang.please_information'),
            'doctor_id.required' => __('lang.please_information'),
            'appointment_date.required' => __('lang.please_information'),

        ]);
        if ($this->appointment_date) {
            if ($this->appointment_time == null) {
                $this->dispatch('required_time');
                return;
            }
        }
        try {
            $appointments = new appointment();
            $appointments->patient_id = $this->patient_id;
            $appointments->d_id = $this->doctor_id;
            $appointments->date = $this->appointment_date;
            $appointments->time = $this->appointment_time;
            $appointments->des = $this->appointment_detail;
            $appointments->creator_id = auth()->user()->id;
            $appointments->save();
            $this->resetdata();
            $this->dispatch('add');
            $this->dispatch('hide-modal-add');
        } catch (\Exception $ex) {
            $this->dispatch('something_went_wrong');
        }
    }


    public function showDestroy($id)
    {
        $this->hiddenId = $id;
        $this->dispatch('show-modal-delete');
    }
    public function Destroy()
    {
        $id = $this->hiddenId;
        try {
            $check = appointment::find($id);
            if ($check->treatment_id != null) {
                $treatment = Treatments::find($check->treatment_id);
                $treatment->appointments = 'no';
                $treatment->update();
            }
            $data = appointment::find($id);
            $data->delete();
            $this->dispatch('hide-modal-delete');
            $this->dispatch('delete');
        } catch (\Exception $ex) {
            $this->dispatch('something_went_wrong');
        }
    }
    public $old_time;
    public function showUpdate($id)
    {
        $this->resetdata();

        $data = appointment::find($id);
        $this->old_time = $data->time;
        $this->hiddenId = $id;
        $this->patient_id = $data->patient_id;
        $this->doctor_id = $data->d_id;
        $this->appointment_date = $data->date;
        $this->appointment_time = $data->time;
        $this->appointment_detail = $data->des;
        $this->dispatch('show-modal-add');
    }


    public function Update($id)
    {
        $this->validate([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'appointment_date' => 'required',

        ], [
            'patient_id.required' => __('lang.please_information'),
            'doctor_id.required' => __('lang.please_information'),
            'appointment_date.required' => __('lang.please_information'),

        ]);
        if ($this->appointment_date) {
            if ($this->appointment_time == null) {
                $this->dispatch('required_time');
                return;
            }
        }

        try {
            $data = appointment::find($id);
            $data->patient_id  = $this->patient_id;
            $data->d_id  = $this->doctor_id;
            $data->date  = $this->appointment_date;
            $data->time  = $this->appointment_time;
            $data->des  = $this->appointment_detail;
            $data->Update();
            $this->resetdata();
            $this->dispatch('edit');
            $this->dispatch('hide-modal-add');
        } catch (\Exception $ex) {
            $this->dispatch('something_went_wrong');
        }
    }
}
