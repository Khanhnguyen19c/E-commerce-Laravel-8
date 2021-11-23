<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;
use Illuminate\Support\Str;
class AdminBrandComponent extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    public $name;
    public $slug;
    public $brand_id;
    public $showEditModal = False;


    //delete brand
    public function deleteBrand($brand_id){
        $this->authorize('brand-delete');
        $brand = Brand::find($brand_id);
        $brand->delete();
        session()->flash('message','Xoá thương hiệu thành công');
    }

    //refesh page
    public function refesh(){
        $this->emitTo('livewre.admin.admin-brand-component','refreshComponent');
        $this->emitTo('livewre.admin.admin-add-brand-component','refreshComponent');
        $this->emitTo('livewre.footer-component','refreshComponent');
        $this->dispatchBrowserEvent('hide-form');
    }

    //open modal add
    public function addbrand(){
        $this->dispatchBrowserEvent('show-form');
        $this->showEditModal = false;
    }

    //open modal edit
    public function editbrand($brand_id){
        $this->showEditModal = true ;
        $brand = Brand::find($brand_id); // change function mount
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->brand_id = $brand_id;
       $this->dispatchBrowserEvent('show-form'); //event show-form
    }

    //update brand
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:brands'
        ]);
    }
    public function updateBrand(){
        $this->authorize('brand-edit');
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands'
        ]);
            $brand = Brand::find($this->brand_id);
            $brand->name = $this->name;
            $brand->slug= $this->slug;
            $brand->save();
        session()->flash('message','Cập nhật thương hiệu thành công!');
    }
    //slug
    public function generateslug(){
        $this->slug= Str::slug($this->name);
    }

    public function render()
    {
        $brands = Brand::all();
        return view('livewire.admin.admin-brand-component',['brands'=>$brands])->layout('layouts.base');
    }
}
