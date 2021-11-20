<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductAttribute;
use App\Models\Products;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class AdminAttributeComponent extends Component
{
    use AuthorizesRequests;
    public $name;
    public $attribute_id;
    public $showEditModal=false;

    //show modal add
    public function addAtribute(){
        $this->showEditModal= false;
        $this->dispatchBrowserEvent('show-form');
    }

    //show modal edit
    public function editAttribute($attribute_id){
        $attribute = ProductAttribute::find($attribute_id);
        $this->attribute_id = $attribute->id;
        $this->name = $attribute->name;
        $this->showEditModal= true;
        $this->dispatchBrowserEvent('show-form');
    }
    //validate
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
        $this->authorize('productAtrribute-edit');
        $attribute = ProductAttribute::find($this->attribute_id);
        $attribute->name =$this->name;
        $attribute->save();
        session()->flash('message','Cập nhật thuộc tính thành công!');
    }
    //delete attribute
    public function deleteAttribute($attribute_id){
        $this->authorize('productAtrribute-delete');
        $attribute = ProductAttribute::find($attribute_id);
        $attribute->delete();
        session()->flash('message_del','Xoá thuộc tính thành công!');
    }
//refesh page
public function refesh(){
    $this->emitTo('admin.admin-attribute-component','refreshComponent');
    $this->dispatchBrowserEvent('hide-form');
}
    public function render()
    {
        $attributes = ProductAttribute::paginate(10);
        return view('livewire.admin.admin-attribute-component',['attributes'=>$attributes])->layout('layouts.base');
    }
}
