<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class AdmineditPostComponent extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    public $title;
    public $author;
    public $short_desc;
    public $desc;
    public $slug;
    public $image;
    public $status;
    public $newImage;
    public $post_id;

    public function generateslug(){
        $this->slug= Str::slug($this->title,'-');
    }

    public function mount($post_id){
        $post = Post::find($post_id);
        $this->title = $post->title;
        $this->author = $post->author;
        $this->short_desc = $post->short_desc;
        $this->desc = $post->content;
        $this->slug = $post->slug;
        $this->status = $post->status;
        $this->image = $post->image;
        $this->post_id = $post_id;
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'title'=>'required',
            'author'=>'required',
            'short_desc'=>'required',
            'desc'=>'required',
            'slug'=>'required',
            'image'=>'required',
            'status'=>'required',
        ]);
    }

    public function updatePost(){
        $this->authorize('posts-edit');
        $post = Post::find($this->post_id);
        $post->title = $this->title;
        $post->author = $this->author;
        $post->short_desc = $this->short_desc;
        $post->content = $this->desc;
        $post->slug = $this->slug;
        $post->status = $this->status;
        if($this->newImage){
            $imageName = Carbon::now()->timestamp. '.' . $this->newImage->extension();
            $this->newImage->storeAs('posts',$imageName);
            $post->image = $imageName;
        }else{
            $post->image = $this->image;
        }
        $post->save();
        session()->flash('message','Cập nhật bài viết thành công!');
        return redirect()->route('admin.posts');
    }


    public function render()
    {
        return view('livewire.admin.adminedit-post-component')->layout('layouts.base');
    }
}
