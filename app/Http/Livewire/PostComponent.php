<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostComponent extends Component
{
    public $slug;
    public $currentUrl;
    public function mount($post_slug){
        $this->slug = $post_slug;
        $this->currentUrl = url()->current();
    }
    public function render()
    {
        $url_canonical = $this->currentUrl;
        $post= Post::where('slug',$this->slug)->first();
        $popularPost = Post::whereNotIn('slug',[$this->slug])->limit(4)->inRandomOrder()->get();
        return view('livewire.post-component',['url_canonical'=>$url_canonical,'post'=>$post,'popularPost'=>$popularPost])->layout('layouts.base');
    }
}
