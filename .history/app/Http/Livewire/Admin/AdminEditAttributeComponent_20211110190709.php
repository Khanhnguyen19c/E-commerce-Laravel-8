<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductAttribute;
use Livewire\Component;

class AdminEditAttributeComponent extends Component
{
    public $name;
    public $attribute_id;

    public function mount($attribute_id){
        $attribute = ProductAttribute::find($attribute_id);
        $this->attribute_id = $attribute->id;
        $this->name = $attribute->name;
    }
    public function updated($fields){
        $this->validateOnly($fields,[
                'name'=>'required'
            ]);
    }
    public function updateAttribute(){
        $this->validate([
            'name'=>'required'
        ]);
        $attribute = ProductAttribute::find($this->attribute_id);
        $attribute->name =$this->name;
        $attribute->save();
        session()->flash('message','Cập nhật tên thuộc tính thành công!');
    }
    
    public function render()
    {
        return view('livewire.admin.admin-edit-attribute-component')->layout('layouts.base');
    }
}
