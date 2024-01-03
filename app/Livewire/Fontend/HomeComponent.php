<?php

namespace App\Livewire\Fontend;

use App\Models\Blog;
use App\Models\Slide;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        // $slides = Slide::where('del',1)->get();
        // $news = Blog::where('del', 1)->take(6)->get();
        
  
        return view('livewire.fontend.home-component')->layout('layouts.fontend.fontend');
    }
}
