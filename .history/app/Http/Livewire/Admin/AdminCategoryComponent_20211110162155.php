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
    if($scategory_slug){
        $this->scategory_slug = $scategory_slug;
        $scategory = Subcategory::where('slug',$scategory_slug)->first();
        $this->scategory_id = $scategory->id;
        $this->category_id = $scategory->category_id;
        $this->name = $scategory->name;
        $this->slug = $scategory->slug;
    }
    else{
        $this->category_slug = $category_slug;
        $category = Category::where('slug',$category_slug)->first();
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }
   $this->dispatchBrowserEvent('show-form'); //event show-form
}


    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}
