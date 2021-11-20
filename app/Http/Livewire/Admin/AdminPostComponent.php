<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;

class AdminPostComponent extends Component
{
    public function render()
    {
        $posts = Post::paginate(12);
        return view('livewire.admin.admin-post-component',['posts'=>$posts])->layout('layouts.base');
    }
}
