<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class AdminAddBrandComponent extends Component
{
    public $name;
    public $slug;
    use AuthorizesRequests;
    protected $listeners = ['refreshComponent'=>'$refresh'];
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
         $this->authorize('brand-add');
            $brand = new Brand();
            $brand->name = $this->name;
            $brand->slug = $this->slug;
            $brand->save();
        session()->flash('message','Thêm thương hiệu thành công!');
        $this->reset();
    }
    public function render()
    {
        return view('livewire.admin.admin-add-brand-component');
    }
}
