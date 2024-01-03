<?php

namespace App\Livewire\Backend\Customers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\District;
use App\Models\Province;
use App\Models\ServiceUnit;
use App\Models\Village;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Function\FunctionController;

class CustomerComponent extends Component
{

    use WithFileUploads;
    use WithPagination;
    public $districts = [], $villages = [], $pro_id, $dis_id, $vill_id, $hiddenId, $page_number;
    public $first_name, $last_name, $birthday, $phone, $gender,
        $status, $unit_house,
        $number_house, $address, $number_doc_person, $doc_person_name, $doc_person_date,
        $file,$nationality,$job;
    public $search;

   
    protected $function_controller;
    public function __construct()
    {
        $this->function_controller = app()->make(FunctionController::class);
    }

    public function mount()
    {
        $this->page_number  = 10;
    }
    public function render()
    {

        if ($this->pro_id) {
            $this->districts =  District::where('province_id', $this->pro_id)->get();
        }
        if ($this->dis_id) {

            $this->villages =  Village::where('district_id', $this->dis_id)->get();
        }
      


        $provinces =  Province::get();

        $data = Customer::where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
                ->orwhere('lastname', 'like', '%' . $this->search . '%')
                ->orwhere('phone', 'like', '%' . $this->search . '%');
            })
            ->where('del', 1)
            ->orderBy('id', 'desc');
        if (!empty($data)) {
            if ($this->page_number == 'all') {
                $data =  $data->get();
            } else {
                $data =  $data->paginate($this->page_number);
            }
        } else {
            $data = [];
        }
        return view('livewire.backend.customers.customer-component', compact('data', 'provinces',))->layout('layouts.backend');
    }

    public function create()
    {
        $this->resetField();
        $this->dispatch('show-modal-add');
    }
    public function resetField()
    {
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
        $this->pro_id = '';
        $this->dis_id = '';
        $this->vill_id = '';
        $this->doc_person_name = '';
        $this->doc_person_date = '';;
        $this->file = null;
        $this->nationality = '';
        $this->job = '';
    }
    public function Store()
    {
    
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'birthday' => 'required',
            'phone' => 'required|min:8|unique:customers,phone,',
            'vill_id' => 'required',
            'dis_id' => 'required',
            'pro_id' => 'required',
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
            'vill_id.required' => 'ເລືອກບ້ານກ່ອນ',
            'dis_id.required' => 'ເລືອກເມືອງກ່ອນ',
            'pro_id.required' => 'ເລືອກແຂວງກ່ອນ',
            // 'number_doc_person.required' => 'ໃສ່ເລກບັດປະຈຳຕົວ ຫຼື ໜັງສືຜ່ານແດນ',
        ]);

        // try {

        $data = new Customer();
        $data->name = $this->first_name;
        $data->lastname = $this->last_name;
        $data->phone = $this->phone;
        $data->pro_id = $this->pro_id;
        $data->dis_id = $this->dis_id;
        $data->vill_id = $this->vill_id;
        $data->address = $this->address;
        $data->birthday = $this->birthday;
        $data->gender = $this->gender;
        $data->status = (int)$this->status;
        $data->unit_house = $this->unit_house;
        $data->number_house = $this->number_house;
        $data->number_doc_person = $this->number_doc_person;
        $data->doc_person_name = $this->doc_person_name;
        $data->nationality = $this->nationality;
        $data->job = $this->job;
        if ($this->doc_person_date) {
            $data->doc_person_date = $this->doc_person_date;
        }
        if ($this->file) {
            $file= Carbon::now()->timestamp . '.' . $this->file->extension();
            $this->file_image->storeAs('upload/custormer/', $file);
            $data->file = 'upload/custormer/' . $file;
        }
        $data->save();
        $this->resetField();
        $this->dispatch('show-modal-hide');
        $this->dispatch('add');
        // } catch (\Exception $ex) {
        //     $this->dispatch('something_went_wrong');
        // }
    }

    public function edit($id)
    {
        $this->resetField();
        $singleData = Customer::find($id);
        $this->hiddenId = $singleData->id;
        $this->first_name = $singleData->name;
        $this->last_name = $singleData->lastname;
        $this->gender = $singleData->gender;
        $this->birthday = $singleData->birthday;
        $this->status = $singleData->status;
        $this->phone = $singleData->phone;
        $this->pro_id = $singleData->pro_id;
        $this->dis_id = $singleData->dis_id;
        $this->vill_id = $singleData->vill_id;
        $this->unit_house = $singleData->unit_house;
        $this->number_house = $singleData->number_house;
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
            'phone' => 'required|min:8|unique:customers,phone,' . $id,
            'vill_id' => 'required',
            'dis_id' => 'required',
            'pro_id' => 'required',
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
            'vill_id.required' => 'ເລືອກບ້ານກ່ອນ',
            'dis_id.required' => 'ເລືອກເມືອງກ່ອນ',
            'pro_id.required' => 'ເລືອກແຂວງກ່ອນ',
            // 'number_doc_person.required' => 'ໃສ່ເລກບັດປະຈຳຕົວ ຫຼື ໜັງສືຜ່ານແດນ',
        ]);

        try {

            $data = Customer::find($id);
            $data->name = $this->first_name;
            $data->lastname = $this->last_name;
            $data->phone = $this->phone;
           
            $data->pro_id = $this->pro_id;
            $data->dis_id = $this->dis_id;
            $data->vill_id = $this->vill_id;
            $data->address = $this->address;
            $data->birthday = $this->birthday;
            $data->job = $this->job;
         
            $data->gender = $this->gender;
            $data->status = (int)$this->status;
            $data->unit_house = $this->unit_house;
            $data->number_house = $this->number_house;
            $data->number_doc_person = $this->number_doc_person;
            $data->doc_person_date = $this->doc_person_date;
            $data->doc_person_name = $this->doc_person_name;
           
            $data->nationality = $this->nationality;
        
            // $data->subject_study = $this->subject_study;

 
            if ($this->file) {

                $imageName = Carbon::now()->timestamp . '.' . $this->file->extension();
                $this->file->storeAs('upload/custormer', $imageName);
                $data->file = 'upload/custormer/' . $imageName;
            }
            
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
        try {
            $data = Customer::find($id);
            $data->del = 0;
            $data->Update();
            $this->dispatch('hide-modal-delete');
            $this->dispatch('delete');
        } catch (\Exception $ex) {
            $this->dispatch('something_went_wrong');
        }
    }
    public function add_Hus_wife()
    {
        $this->resetField_Hus_wife();
        $this->dispatch('show-modal-hide');
        $this->dispatch('show-modal-hus-wife');
    }
    public function download($id)
    {
        $dl_custormer = Customer::find($id);

        if ($dl_custormer->file_doc) {
            // Check if the file exists
            if (file_exists($dl_custormer->file_doc)) {
                return response()->file($dl_custormer->file_doc);
            } else {

                return redirect()->back()->with('warning', 'ຊອກຟາຍເອກະສານບໍເຫັນ.');
            }
        } else {

            return redirect()->back()->with('error', 'ບໍມີຟາຍເອກະສານ');
        }
    }

}
