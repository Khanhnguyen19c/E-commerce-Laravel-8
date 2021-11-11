<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductAttribute;
use App\Models\Products;
use Livewire\Component;

class AdminAttributeComponent extends Component
{
    unction deleteAttribute($attribute_id){
        $attribute = ProductAttribute::find($attribute_id);
        $attribute->delete();
        session()->flash('message','Xoá thuộc tính thành công!');
    }
    public function render()
    {
        $attributes = ProductAttribute::paginate(10);
        return view('livewire.admin.admin-attribute-component',['attributes'=>$attributes])->layout('layouts.base');
    }
}
