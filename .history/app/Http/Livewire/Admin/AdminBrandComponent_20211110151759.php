<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\PseudoTypes\False_;
use phpDocumentor\Reflection\PseudoTypes\True_;

class AdminBrandComponent extends Component
{
    use WithPagination;

    public $brand_id;
    public $showEditModal = False;
    public function deleteBrand($brand_id){
        $brand = Brand::find($brand_id);
        $brand->delete();
        session()->flash('message','Xoá thương hiệu thành công');
    }
    public function refesh(){
        $this->emitTo('admin.admin.admin-brand-component','refreshComponent');
    }

    public function addbrand(){
        $this->dispatchBrowserEvent('show-form');
    }
    public function editbrand(Brand $brand_id){
       $this->dispatchBrowserEvent('show-form');
       $this->showEditModal = True ;


    }
    public function render()
    {
        $brands = Brand::paginate(12);
        return view('livewire.admin.admin-brand-component',['brands'=>$brands])->layout('layouts.base');
    }
}
