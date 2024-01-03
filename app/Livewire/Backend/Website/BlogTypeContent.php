<?php

namespace App\Livewire\Backend\Website;

use Livewire\Component;
use App\Models\BlogType;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class BlogTypeContent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $ID, $name, $search, $page_number;
    public function render()
    {
        $data = BlogType::orderBy('id', 'desc')
        ->where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })
        ->where('del', 1)->paginate($this->page_number);
        return view('livewire.backend.website.blog-type-content',compact('data'))->layout('layouts.backend');
    }
    public function resetform()
    {
        $this->name = '';
        $this->ID = '';
    }
    protected $rules = [
        'name' => 'required|unique:blog_types',
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
            // $this->validate([
            //     'image' => 'required',
            // ], [
            //     'image.required' => 'ກະລຸນາເລືອກຂໍ້ມູນກ່ອນ!',
            // ]);
            $data = BlogType::find($updateId);
            $data->name = $this->name;
            $data->save();
            $this->dispatch('edit');
            $this->resetform();
        } else //ເພີ່ມໃໝ່
        {
            $this->validate([
                'name' => 'required|unique:blog_types',
            ], [
                'name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'name.unique' => 'ຂໍ້ມູນນີ້ມີໃນລະບົບເເລ້ວ!',
            ]);
            try {
                DB::beginTransaction();
                $data = new BlogType();
                $data->name = $this->name;
                $data->del = 1;
                $data->save();
                $this->dispatch('add');
                $this->resetform();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                $this->dispatch('something_went_wrong');
            }
        }
    }
    public function edit($ids)
    {
        $data = BlogType::find($ids);
        $this->name = $data->name;
        $this->ID = $data->id;
    }
    public function showDestroy($ids)
    {
        $this->dispatch('show-modal-delete');
        $data = BlogType::find($ids);
        $this->ID = $data->id;
        $this->name = $data->name;
    }
    public function destroy($ids)
    {
        $ids = $this->ID;
        $data = BlogType::find($ids);
        $data->del = 0;
        $data->save();
        $this->dispatch('hide-modal-delete');
        $this->dispatch('delete');
        $this->resetform();
    }
}
