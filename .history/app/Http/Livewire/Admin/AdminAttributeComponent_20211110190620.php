<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductAttribute;
use App\Models\Products;
use Livewire\Component;

class AdminAttributeComponent extends Component
{
    public $name;
    public $attribute_id;
    public
    //show modal edit
    public function editAttribute($attribute_id){
        $attribute = ProductAttribute::find($attribute_id);
        $this->attribute_id = $attribute->id;
        $this->name = $attribute->name;
    }

    public function updated($fields){
        $this->validateOnly($fields,[
                'name'=>'required'
            ]);
    }
    //update attribute
    public function updateAttribute(){
        $this->validate([
            'name'=>'required'
        ]);
        $attribute = ProductAttribute::find($this->attribute_id);
        $attribute->name =$this->name;
        $attribute->save();
        session()->flash('message','Cập nhật thuộc tính thành công!');
    }
    //delete attribute
    public function deleteAttribute($attribute_id){
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
