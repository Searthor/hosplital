<?php

namespace App\Livewire\Backend\Patient;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\Function\FunctionController;
use App\Models\Treatments;
use Carbon\Carbon;

class PatientComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $hiddenId;
    public $first_name, $last_name, $birthday, $phone, $gender,
        $status, $unit_house, $ethnicity, $village, $province, $district,
        $number_house, $address, $number_doc_person, $doc_person_name, $doc_person_date,
        $file, $nationality, $job,$page_number;
    public $search;

    protected $function_controller;
    public function __construct()
    {
        $this->function_controller = app()->make(FunctionController::class);
    }

    public function mount()
    {
        $this->page_number = 10;
    }

    public function render()
    {
        $data = Patient::where(function ($q) {
            $q->where('f_name', 'like', '%' . $this->search . '%')
                ->orwhere('l_name', 'like', '%' . $this->search . '%')
                ->orwhere('code', 'like', '%' . $this->search . '%');  
            })
        ->where('del',1);
        if (!empty($data)) {
            if ($this->page_number == 'all') {
                $data =  $data->get();
            } else {
                $data =  $data->paginate($this->page_number);
            }
        } else {
            $data = [];
        }

        return view('livewire.backend.patient.patient-component', compact('data'))->layout('layouts.backend');
    }
    public function create()
    {
        $this->resetField();
        $this->dispatch('show-modal-add');
    }

    public function resetField()
    {
        $this->hiddenId ='';
        $this->first_name = '';
        $this->last_name = '';
        $this->gender = '';
        $this->address = '';
        $this->birthday = '';
        $this->phone = '';
        $this->unit_house = '';
        $this->number_doc_person = '';
        $this->number_house = '';
        $this->status = '';
        $this->province = '';
        $this->district = '';
        $this->village = '';
        $this->doc_person_name = '';
        $this->doc_person_date = '';;
        $this->file = null;
        $this->nationality = '';
        $this->job = '';
    }


    public function Store()
    {
        
        // dd( $this->function_controller);

        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'birthday' => 'required',
            'phone' => 'required|min:8|unique:patients,phone,',
            'village' => 'required',
            'district' => 'required',
            'province' => 'required',
            'nationality' => 'required',

            // 'number_doc_person' => 'required',
        ], [
            'first_name.required' => 'ໃສ່ຊື່ກ່ອນ',
            'last_name.required' => 'ນາມສະກຸນ',
            'gender.required' => 'ໃສ່ເພດກ່ອນ',
            'status.required' => 'ໃສ່ສະຖານະກ່ອນ',
            'birthday.required' => 'ໃສ່ວັນເດືອນປີເກິດກ່ອນ',
            'phone.required' => 'ໃສ່ເບີໂທກ່ອນ',
            'phone.unique' => 'ເບີໂທນີ້ຖືກໃຊ້ແລ້ວ!',
            'phone.min' => 'ເບີໂທຕ້ອງບໍຕໍ່າກ່ວາ8ຕົວເລກ!',
            'village.required' => 'ເລືອກບ້ານກ່ອນ',
            'district.required' => 'ເລືອກເມືອງກ່ອນ',
            'province.required' => 'ເລືອກແຂວງກ່ອນ',
            'nationality.required' => 'ປ້ອມຂໍ້ມູນກ່ອນ',

            // 'number_doc_person.required' => 'ໃສ່ເລກບັດປະຈຳຕົວ ຫຼື ໜັງສືຜ່ານແດນ',
        ]);

        try {
            $code = $this->function_controller->generate_code('Patient');
            $data = new Patient();
            $data->f_name = $this->first_name;
            $data->code = 'PT-' . $code;
            $data->l_name = $this->last_name;
            $data->phone = $this->phone;
            $data->birthday = $this->birthday;
            $data->gender = $this->gender;
            $data->status = (int)$this->status;
            $data->unit = $this->unit_house;
            $data->house_number = $this->number_house;
            $data->nationality = $this->nationality;
            $data->ethnicity = $this->ethnicity;
            $data->village = $this->village;
            $data->city = $this->district;
            $data->province = $this->province;
            $data->job = $this->job;
        
            $data->save();
            $this->resetField();
            $this->dispatch('show-modal-hide');
            $this->dispatch('add');
        } catch (\Exception $ex) {
            $this->dispatch('something_went_wrong');
        }
    }


    public function edit($id)
    {
        $this->resetField();
        $singleData = Patient::find($id);
        $this->hiddenId = $singleData->id;
        $this->first_name = $singleData->f_name;
        $this->last_name = $singleData->l_name;
        $this->gender = $singleData->gender;
        $this->birthday = $singleData->birthday;
        $this->status = $singleData->status;
        $this->phone = $singleData->phone;
        $this->province = $singleData->province;
        $this->district = $singleData->city;
        $this->village = $singleData->village;
        $this->unit_house = $singleData->unit;
        $this->number_house = $singleData->house_number;
        $this->address = $singleData->address;
        $this->number_doc_person = $singleData->number_doc_person;
        $this->doc_person_date = $singleData->doc_person_date;
        $this->job = $singleData->job;
        $this->nationality = $singleData->nationality;
        $this->dispatch('show-modal-add');
    }
    public function Update($id)
    {
   
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'birthday' => 'required',
            'phone' => 'required|min:8|unique:patients,phone,'.$id,
            'village' => 'required',
            'district' => 'required',
            'province' => 'required',
            'nationality' => 'required',

            // 'number_doc_person' => 'required',
        ], [
            'first_name.required' => 'ໃສ່ຊື່ກ່ອນ',
            'last_name.required' => 'ນາມສະກຸນ',
            'gender.required' => 'ໃສ່ເພດກ່ອນ',
            'status.required' => 'ໃສ່ສະຖານະກ່ອນ',
            'birthday.required' => 'ໃສ່ວັນເດືອນປີເກິດກ່ອນ',
            'phone.required' => 'ໃສ່ເບີໂທກ່ອນ',
            'phone.unique' => 'ເບີໂທນີ້ຖືກໃຊ້ແລ້ວ!',
            'phone.min' => 'ເບີໂທຕ້ອງບໍຕໍ່າກ່ວາ8ຕົວເລກ!',
            'village.required' => 'ເລືອກບ້ານກ່ອນ',
            'district.required' => 'ເລືອກເມືອງກ່ອນ',
            'province.required' => 'ເລືອກແຂວງກ່ອນ',
            'nationality.required' => 'ປ້ອມຂໍ້ມູນກ່ອນ',

            // 'number_doc_person.required' => 'ໃສ່ເລກບັດປະຈຳຕົວ ຫຼື ໜັງສືຜ່ານແດນ',
        ]);

        try {

            $data = Patient::find($id);
            $data->f_name = $this->first_name;
            $data->l_name = $this->last_name;
            $data->phone = $this->phone;
            $data->province = $this->province;
            $data->city = $this->district;
            $data->village = $this->village;
            // $data->address = $this->address;
            $data->birthday = $this->birthday;
            $data->job = $this->job;
            $data->gender = $this->gender;
            $data->status = (int)$this->status;
            $data->unit = $this->unit_house;
            $data->house_number = $this->number_house;

            $data->nationality = $this->nationality;
     
            
            $data->Update();
            $this->resetField();
            $this->dispatch('show-modal-hide');
            $this->dispatch('edit');
        } catch (\Exception $ex) {
            $this->dispatch('something_went_wrong');
        }
    }

    public function showDestroy($id)
    {
        $this->hiddenId = $id;
        $this->dispatch('show-modal-delete');
    }

    public function Destroy($id)
    {
        $check =  Treatments::where('patient_id',$id)->get();
        if(count($check)> 0){
            $this->dispatch('can_not_delete');
            return;
        }
        try {
            $data = Patient::find($id);
            $data->delete();
            $this->dispatch('hide-modal-delete');
            $this->dispatch('delete');
        } catch (\Exception $ex) {
            $this->dispatch('something_went_wrong');
        }
    }
}
