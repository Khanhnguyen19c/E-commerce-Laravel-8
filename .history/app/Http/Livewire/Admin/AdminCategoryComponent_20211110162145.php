<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;
    public $category_slug;
    public $category_id;
    public $name;
    public $slug;

    public $scategory_id;
    public $scategory_slug;
    public $showEditModal = False;

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
public function editbrand($category_slug,$scategory_slug=null){
    $this->showEditModal = true ;
    $brand = Category::find($category_id); // change function mount
    $this->name = $brand->name;
    $this->slug = $brand->slug;
    $this->category_id = $category_id;
   $this->dispatchBrowserEvent('show-form'); //event show-form
}


    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}
