<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Toastr;
use Livewire\Component;
use Illuminate\Support\Str;
class AdminAddCategoryComponent extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh'];
    public $name;
    public $slug;
    public $category_id;

    public function generateslug(){
        $this->slug= Str::slug($this->name);
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);

    }
    protected $messages = [

        'name.required' => 'Thông tin này không được bỏ trống.',

        'slug.required' => 'Thông tin này không được bỏ trống.',


    ];


    public function storeCategory(){
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
        if($this->category_id){
            $category = new Subcategory();
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->category_id = $this->category_id;
            $category->save();
        }else{
            $category = new Category();
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->save();
        }
        session()->flash('message','Thêm danh mục thành công!');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-category-component',['categories'=>$categories]);
    }
}
