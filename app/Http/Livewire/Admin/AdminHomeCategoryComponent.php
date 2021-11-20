<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class AdminHomeCategoryComponent extends Component
{
    use AuthorizesRequests;
    public $selected_categories = [];
    public $numberofproducts;

    public function mount(){
        $category = HomeCategory::find(1);
        $this->selected_categories = explode(',',$category->sel_categories);
        $this->numberofproducts = $category->no_of_products;
    }

    public function updateHomeCategory(){
        $this->authorize('homeCategory-edit');
        $category = HomeCategory::find(1);
        $category->sel_categories = implode(',',$this->selected_categories);
        $category->no_of_products = $this -> numberofproducts;
        $category->save();
        session()->flash('message','Bạn đã cập nhật thành công!');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-home-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}
