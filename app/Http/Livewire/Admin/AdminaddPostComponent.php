<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class AdminaddPostComponent extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    public $title;
    public $short_desc;
    public $desc;
    public $slug;
    public $image;
    public $status;

    public function updated($fields){
        $this->validateOnly($fields,[
            'title'=>'required',
            'short_desc'=>'required',
            'desc'=>'required',
            'slug'=>'required',
            'image'=>'required',
            'status'=>'required',
        ]);
    }

       public function addPost(){
        $this->validate([
            'title'=>'required',
            'short_desc'=>'required',
            'desc'=>'required',
            'slug'=>'required',
            'image'=>'required',
            'status'=>'required',
        ]);
        $this->authorize('posts-add');
        $post = New Post();
        $post->title = $this->title;
        $post->author = Auth::user()->name;
        $post->short_desc = $this->short_desc;
        $post->content = $this->desc;
        $post->slug = $this->slug;
        $post->status = $this->status;
        $imageName = Carbon::now()->timestamp. '.' . $this->image->extension();
        $this->image->storeAs('posts',$imageName);
        $post->image = $imageName;
        $post->views = 100;
        $post->save();
         session()->flash('message','Thêm bài viết thành công!');
         return redirect()->route('admin.addpost');
    }
    public function generateslug(){
        $this->slug= Str::slug($this->title,'-');
    }
    public function render()
    {
        return view('livewire.admin.adminadd-post-component')->layout('layouts.base');
    }
}
