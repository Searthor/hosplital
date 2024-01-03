<?php

namespace App\Livewire\Fontend;

use App\Models\Blog;

use Livewire\Component;

use Livewire\WithPagination;
class NewsComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data = Blog::paginate(9);
        return view('livewire.fontend.news-component',compact('data'))->layout('layouts.fontend.fontend');
    }
}
