<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
class AdminBrandComponent extends Component
{
    use WithPagination;

    public $brand_id;
    public $showEditModal
    public function deleteBrand($brand_id){
        $brand = Brand::find($brand_id);
        $brand->delete();
        session()->flash('message','Xoá thương hiệu thành công');
    }
    public function refesh(){
        $this->emitTo('admin.admin.admin-brand-component','refreshComponent');
    }
    public function editbrand(Brand $brand_id){
       $this->dispatchBrowserEvent('show-form');

    }
    public function render()
    {
        $brands = Brand::paginate(12);
        return view('livewire.admin.admin-brand-component',['brands'=>$brands])->layout('layouts.base');
    }
}
