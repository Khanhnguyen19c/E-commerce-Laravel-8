<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Pagination\Paginator;

class CategoriesPostComponent extends Component
{
    // public $limitPerPage=1;

    // public function loadMore()
    // {
    //     $this->limitPerPage += 5;
    // }
    public function render()
    {
        Paginator::useBootstrap();
        $post_new = Post::orderby('created_at','ASC')->first();
        $posts = Post::paginate(5);
        return view('livewire.categories-post-component',['posts'=>$posts,'post_new'=>$post_new])->layout('layouts.base');
    }

}
