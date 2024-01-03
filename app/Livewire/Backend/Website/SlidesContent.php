<?php

namespace App\Livewire\Backend\Website;

use Carbon\Carbon;
use App\Models\Slide;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class SlidesContent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $ID, $image, $newimage, $name_la,$name_en,$name_cn, $search, $page_number;
    public function render()
    {
        $data = Slide::orderBy('id', 'desc')
            ->where(function ($q) {
                $q->where('name_la', 'like', '%' . $this->search . '%')
                ->orwhere('name_en', 'like', '%' . $this->search . '%')
                ->orwhere('name_cn', 'like', '%' . $this->search . '%');
            })
            ->where('del', 1)->paginate($this->page_number);
        return view('livewire.backend.website.slides-content', compact('data'))->layout('layouts.backend');
    }
    public function resetform()
    {
        $this->image = '';
        $this->name_la = '';
        $this->name_en = '';
        $this->name_cn = '';
        $this->ID = '';
    }
    protected $rules = [
        'name_la' => 'required|unique:slides',
    ];
    protected $messages = [
        'name_la.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
        'name_la.unique' => 'ຂໍ້ມູນນີ້ມີໃນລະບົບເເລ້ວ!',
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
            $data = Slide::find($updateId);
            $data->name_la = $this->name_la;
            $data->name_en = $this->name_en;
            $data->name_cn = $this->name_cn;
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
                    $this->image->storeAs('upload/slide', $imageName);
                    $data->image = 'upload/slide'.'/'.$imageName;
                }
            }
            $data->save();
            $this->dispatch('edit');
            $this->resetform();
        } else //ເພີ່ມໃໝ່
        {
            $this->validate([
                'name_la' => 'required|unique:slides',
            ], [
                'name_la.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນກ່ອນ!',
                'name_la.unique' => 'ຂໍ້ມູນນີ້ມີໃນລະບົບເເລ້ວ!',
            ]);
            try {
                DB::beginTransaction();
                $data = new Slide();
                $data->name_la = $this->name_la;
                $data->name_en = $this->name_en;
                $data->name_cn = $this->name_cn;
                //upload image
                if (!empty($this->image)) {
                    $this->validate([
                        'image' => 'required|mimes:jpg,png,jpeg',
                    ]);
                    $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
                    $this->image->storeAs('upload/slide', $imageName);
                    $data->image = 'upload/slide' . '/' . $imageName;
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
        $data = Slide::find($ids);
        $this->name_la = $data->name_la;
        $this->name_en = $data->name_en;
        $this->name_cn = $data->name_cn;
        $this->newimage = $data->image;
        $this->ID = $data->id;
    }
    public function showDestroy($ids)
    {
        $this->dispatch('show-modal-delete');
        $data = Slide::find($ids);
        $this->ID = $data->id;
        $this->name_la = $data->name_la;
    }
    public function destroy($ids)
    {
        $ids = $this->ID;
        $data = Slide::find($ids);
        $data->del = 0;
        $data->save();
        $this->dispatch('hide-modal-delete');
        $this->dispatch('delete');
        $this->resetform();
    }
}
