<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
class AdminBrandComponent extends Component
{
    use WithPagination;

    public $brand;
    public $name;
    public $slug;
    public $brand_id=0;
    public $showEditModal = False;

    public function deleteBrand($brand_id){
        $brand = Brand::find($brand_id);
        $brand->delete();
        session()->flash('message','Xoá thương hiệu thành công');
    }
    //refesh page
    public function refesh(){
        $this->emitTo('admin.admin.admin-brand-component','refreshComponent');
    }
    //open modal add
    public function addbrand(){
        $this->dispatchBrowserEvent('show-form');
        $this->showEditModal = false;
    }
    //open modal edit
    public function editbrand(Brand $brand){
        $this->showEditModal = true ;
        $this->brand =  $brand->toArray();
        dd($brand);
       $this->dispatchBrowserEvent('show-form');
    }
    public function mount($brand_id){
        $brand = Brand::find($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->brand_id = $brand_id;
    }
    //update brand
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:brands'
        ]);
    }
    public function updateBrand(){
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

    public function generateslug(){
        $this->slug= Str::slug($this->name);
    }
    public function render()
    {
        $brands = Brand::paginate(12);
        return view('livewire.admin.admin-brand-component',['brands'=>$brands])->layout('layouts.base');
    }
}
