<?php

namespace App\Livewire\Backend\ExpendIncome;

use App\Models\Branch;
use App\Models\ExpendIncome;
use App\Models\ServiceUnit;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ExpendIncomeContent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $ID, $service_units_id, $type, $name, $total_price, $note, $search, $page_number, $branch_id, $service_unit,$select_branch;
    public function render()
    {
        $branches = Branch::all();
        if ($this->branch_id) {
            $this->service_unit = ServiceUnit::where('branches_id', $this->branch_id)->get();
        }
        $data = ExpendIncome::select('expend_incomes.*')
            ->where(function ($q) {
                $q->where('expend_incomes.name', 'like', '%' . $this->search . '%');
            })->where('del', 1)->orderBy('id', 'desc');
        if (auth()->user()->role_id == 1) {
            $data = $data;
        } elseif (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {
            $data = $data->join('branches as b', 'b.id', '=', 'expend_incomes.branches_id')
                ->join('chairman_availables as ca', 'ca.branch_id', '=', 'b.id')
                ->where('ca.role_id', auth()->user()->role_id);
            if ($this->select_branch) {
                $data = $data->where('expend_incomes.branches_id', $this->select_branch);
                dd($data);
            } else {
                $data = $data;
            }
        } else {
            $data = $data->where('expend_incomes.branches_id', auth()->user()->branch_id);
        }
        if (!empty($data)) {
            if ($this->page_number == 'all') {
                $data = $data->get();
            } else {
                $data = $data->paginate($this->page_number);
            }
        } else {
            $data = [];
        }
        return view('livewire.backend.expend-income.expend-income-content', compact('data', 'branches'))->layout('layouts.backend');
    }
    public function resetform()
    {
        $this->branch_id = '';
        $this->service_units_id = '';
        $this->type = '';
        $this->name = '';
        $this->total_price = '';
        $this->note = '';
        $this->ID = '';
    }
    protected $rules = [
        'name' => 'required|unique:expend_incomes',
    ];
    protected $messages = [
        'name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
        'name.unique' => 'ຂໍ້ມູນນີ້ມີໃນລະບົບເເລ້ວ!',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function store()
    {
        $updateId = $this->ID;
        if ($updateId > 0) {
            $this->validate([
                'name' => 'required',
            ], [
                'name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
            ]);
            $data = ExpendIncome::find($updateId);
            if ($this->branch_id) {
                $data->branches_id = $this->branch_id;
                $data->service_units_id = $this->service_units_id;
            }
            $data->type = $this->type;
            $data->name = $this->name;
            $data->total_price = $this->total_price;
            $data->note = $this->note;
            $data->save();
            $this->dispatch('edit');
            $this->resetform();
        } else //ເພີ່ມໃໝ່
        {
            $this->validate([
                'type' => 'required',
                'name' => 'required',
                'total_price' => 'required',
            ], [
                'type.required' => 'ກະລຸນາເລືອກຂໍ້ມູນກ່ອນ!',
                'name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'total_price.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
            ]);
            try {
                DB::beginTransaction();
                if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {
                    $this->validate([
                        'branch_id' => 'required',
                    ], [
                        'branch_id.required' => 'ເລືອກສາຂາກ່ອນ',
                    ]);
                }
                $data = new ExpendIncome();
                if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {
                    $data->branches_id = $this->branch_id;
                    $data->service_units_id = $this->service_units_id;
                } else {
                    $data->branches_id = auth()->user()->branch_id;
                    $data->service_units_id = auth()->user()->service_units_id;
                }
                $data->type = $this->type;
                $data->name = $this->name;
                $data->total_price = $this->total_price;
                $data->note = $this->note;
                $data->del = 1;
                $data->save();
                $this->dispatch('add');
                $this->resetform();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                dd($ex);
                $this->dispatch('something_went_wrong');
            }
        }
    }
    public function edit($ids)
    {
        $data = ExpendIncome::find($ids);
        $this->branch_id = $data->branches_id;
        $this->service_units_id = $data->service_units_id;
        $this->type = $data->type;
        $this->name = $data->name;
        $this->total_price = $data->total_price;
        $this->note = $data->note;
        $this->ID = $data->id;
    }
    public function showDestroy($ids)
    {
        $this->dispatch('show-modal-delete');
        $data = ExpendIncome::find($ids);
        $this->ID = $data->id;
        $this->name = $data->name;
    }
    public function destroy($ids)
    {
        $ids = $this->ID;
        $data = ExpendIncome::find($ids);
        $data->del = 0;
        $data->save();
        $this->dispatch('hide-modal-delete');
        $this->dispatch('delete');
        $this->resetform();
    }
}
