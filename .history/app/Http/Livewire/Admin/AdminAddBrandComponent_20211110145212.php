<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
class AdminAddBrandComponent extends Component
{
    public $name;
    public $slug;

    public function generateslug(){
        $this->slug= Str::slug($this->name);
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:brands'
        ]);
    }
    public function storeBrand(){
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands'
        ]);
            $category = new Brand();
            $category->name = $this->name;
            $category->slug = $this->slug;
            $category->save();
        session()->flash('message','Thêm thương hiệu thành công!');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-brand-component');
    }
}
