<?php

namespace App\Http\Livewire;

use App\Models\CategoriesPost;
use Livewire\Component;

class CategoriesPostComponent extends Component
{
    public function render()
    {
        $categoriesPost = CategoriesPost::all();
        return view('livewire.categories-post-component',['categriesPost'=>$categoriesPost])->layout('layouts.base');
    }
}
