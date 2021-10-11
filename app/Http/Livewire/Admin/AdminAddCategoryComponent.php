<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Toastr;
use Livewire\Component;
use Illuminate\Support\Str;
class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;

    public function generateslug(){
        $this->slug= Str::slug($this->name);
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
    }

    public function storeCategory(){
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
         $category->save();
        // Toastr::success('Thêm danh mục thành công','Thông Báo');
        session()->flash('message','Thêm danh mục thành công!');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}
