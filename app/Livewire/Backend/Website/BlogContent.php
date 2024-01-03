<?php

namespace App\Livewire\Backend\Website;

use Carbon\Carbon;
use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class BlogContent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $ID, $image, $newimage, $name, $description, $search, $page_number;
    public function render()
    {
        $data = Blog::orderBy('id', 'desc')
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->where('del', 1)->paginate($this->page_number);
        return view('livewire.backend.website.blog-content', compact('data'))->layout('layouts.backend');
    }
    public function resetform()
    {
        $this->name = '';
        $this->image = '';
        $this->description = '';
        $this->ID = '';
    }
    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];
    protected $messages = [
        'name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
        'description.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
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
            $data = Blog::find($updateId);
            $data->name = $this->name;
            $data->description = $this->description;
            if ($this->image) {
                $this->validate([
                    'image' => 'required|mimes:png,jpg,jpeg',
                ]);
                if ($this->image) {
                    $this->validate([
                        'image' => 'required|mimes:png,jpg,jpeg',
                    ]);
                    if ($this->image != $data->image) {
                        if (!empty($data->image)) {
                            $images = explode(",", $data->images);
                            foreach ($images as $image) {
                                unlink('' . '' . $data->image);
                            }
                            $data->delete();
                        }
                    }
                    $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
                    $this->image->storeAs('upload/blog', $imageName);
                    $data->image = 'upload/blog' . '/' . $imageName;
                }
            }
            $data->save();
            $this->dispatch('edit');
            $this->resetform();
        } else //ເພີ່ມໃໝ່
        {
          
            $this->validate([
                'name' => 'required',
                'description' => 'required',
            ], [
                'name.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'description.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
            ]);
            try {
                DB::beginTransaction();
                $data = new Blog();
                $data->name = $this->name;
                $data->description = $this->description;
                //upload image
                if (!empty($this->image)) {
                    $this->validate([
                        'image' => 'required|mimes:jpg,png,jpeg',
                    ]);
                    $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
                    $this->image->storeAs('upload/blog', $imageName);
                    $data->image = 'upload/blog' . '/' . $imageName;
                } else {
                    $data->image = '';
                }
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
        $data = Blog::find($ids);
        $this->name = $data->name;
        $this->description = $data->description;
        $this->newimage = $data->image;
        $this->ID = $data->id;
    }
    public function showDestroy($ids)
    {
        $this->dispatch('show-modal-delete');
        $data = Blog::find($ids);
        $this->ID = $data->id;
        $this->name = $data->name;
    }
    public function destroy($ids)
    {
        $ids = $this->ID;
        $data = Blog::find($ids);
        $data->del = 0;
        $data->save();
        $this->dispatch('hide-modal-delete');
        $this->dispatch('delete');
        $this->resetform();
    }
}
