<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
class AdminCategoryComponent extends Component
{
    use WithPagination;
    public $category_slug;
    public $category_id;
    public $name;
    public $slug;

    public $scategory_id;
    public $scategory_slug;
    public $showEditModal = false;

    //open add form
    public function Addform(){
        $this->dispatchBrowserEvent('show-form');
        $this->showEditModal = false;
    }

    //delete cate
    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        session()->flash('message','Xoá danh mục thành công');
    }

    //delete sub cate
    public function deleteSubcategory($id){
        $category = Subcategory::find($id);
        $category->delete();
        session()->flash('message','Xoá danh mục thành công!');
    }

    //refesh category
    public function refesh(){
        $this->emitTo('admin.admin.admin-category-component','refreshComponent');
        $this->dispatchBrowserEvent('hide-form');
    }

//open modal edit
public function editcategory($category_id,$scategory_id=null){
    $this->showEditModal = true ;
    if($scategory_id){
        $this->scategory_id = $scategory_id;
        $scategory = Subcategory::find($scategory_id)->first();
        $this->category_id = $scategory->category_id;
        $this->name = $scategory->name;
        $this->slug = $scategory->slug;
    }
    else{
        $this->category_id = $category_id;
        $category = Category::find($category_id);
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

   $this->dispatchBrowserEvent('show-form'); //event show-form
}

//update category
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
public function updateCategory(){
    $this->validate([
        'name' => 'required',
        'slug' => 'required|unique:categories'
    ]);
    if($this->scategory_id){
        $scategory = Subcategory::find($this->scategory_id);
        $scategory->name= $this->name;
        $scategory->slug= $this->slug;
        $scategory->category_id= $this->category_id;
        $scategory->save();
    }else{
        $category = Category::find($this->category_id);
        $category->name = $this->name;
        $category->slug= $this->slug;
        $category->save();
    }
    session()->flash('message','Cập nhật danh mục thành công!');
}

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}
