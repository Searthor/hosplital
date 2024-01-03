<?php

namespace App\Livewire\Backend\Website;

use Carbon\Carbon;
use App\Models\Abouts;
use Livewire\Component;
use Livewire\WithFileUploads;

class AboutContent extends Component
{
    use WithFileUploads;
    public $description,$latitude,$longitude;
    public $newimage, $image;
    public function mount()
    {
        $data = Abouts::find(1);
        if($this->image){
            $this->image = $data->image;
            $this->description = $data->description;
            $this->latitude = $data->latitude;
            $this->longitude = $data->longitude;
        }
    }
    public function render()
    {
        return view('livewire.backend.website.about-content')->layout('layouts.backend');
    }
    public function update()
    {
        $this->validate([
            'description' => 'required',
        ], [
            'description.required' => 'ປ້ອນຂໍ້ມູນກ່ອນ!',
        ]);
        $data = Abouts::find(1);
        if (!empty($this->image)) {
            $this->validate([
                'image' => 'required|mimes:jpg,png,jpeg',
            ]);
            $imageName = date('ymdhis').'_'.$this->image->getClientOriginalName(). '.' . $this->image->extension();
            $this->image->storeAs('upload/about/', $imageName);
            $data->image = 'upload/about/'.$imageName;
        }
        // if ($this->image) {
        //     $this->validate([
        //         'image' => 'required|mimes:png,jpg,jpeg',
        //     ]);
        //     if ($this->image != $data->image) {
        //         if (!empty($data->image)) {
        //             $images = explode(",", $data->images);
        //             foreach ($images as $image) {
        //                 unlink('' . '' . $data->image);
        //             }
        //             $data->delete();
        //         }
        //     }
        //     $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        //     $this->image->storeAs('upload/about', $imageName);
        //     $data->image = 'upload/about' . '/' . $imageName;
        // }
        $data->description = $this->description;
        $data->save();
        $this->dispatch('edit');
        return redirect(route('backend.about'));
    }
}
