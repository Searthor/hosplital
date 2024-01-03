<?php

namespace App\Livewire\Fontend;

use App\Models\Blog;
use Livewire\Component;

class NewDetailComponent extends Component
{
    public $description,$image,$date;
    public function mount($id){
        $data = Blog::where('del',1)->find($id);
        if(!empty($data)){
            $this->description = $data->description;
            $this->image = $data->image;
            $this->date = optional($data->created_at)->format('Y-m-d');
            
        } 
    }
    public function render()
    {
        return view('livewire.fontend.new-detail-component')->layout('layouts.fontend.fontend');
    }
}
