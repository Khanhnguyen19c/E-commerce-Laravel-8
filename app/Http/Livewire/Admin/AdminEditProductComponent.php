<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Products;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Carbon\Carbon;
class AdminEditProductComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $short_desc;
    public $desc;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $category_id;
    public $newImage;
    public $product_id;

    public function mount($product_slug){
        $product = Products::where('slug',$product_slug)->first();
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_desc = $product->short_desc;
        $this->desc = $product->desc;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->stock_status = $product->stock_status;
        $this->featured = $product->featured;
        $this->SKU = $product->SKU;
        $this->quantity = $product->quantity;
        $this->image = $product->image;
        $this->category_id = $product->category_id;
        $this->product_id = $product->id;

    }
    public function generateslug(){
        $this->slug= Str::slug($this->name,'-');
    }

    public function undated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
            'slug'=>'required',
            'short_desc'=>'required',
            'desc'=>'required',
            'regular_price'=>'required|numeric',
            'sale_price'=>'numeric',
            'SKU'=>'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required|numeric',
            'category_id'=>'required',
        ]);
    }

    public function updateProduct(){
        $this->validate([
            'name'=>'required',
            'slug'=>'required',
            'short_desc'=>'required',
            'desc'=>'required',
            'regular_price'=>'required|numeric',
            'sale_price'=>'numeric',
            'SKU'=>'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required|numeric',
            'category_id'=>'required',
        ]);
            $product = Products::find($this->product_id);
            $product->name = $this->name;
            $product->slug = $this->slug;
            $product->short_desc = $this->short_desc;
            $product->desc = $this->desc;
            $product->regular_price = $this->regular_price;
            $product->sale_price = $this->sale_price;
            $product->stock_status = $this->stock_status;
            $product->featured = $this->featured;
            $product->category_id = $this->category_id;
            $product->SKU = $this->SKU;
            $product->quantity = $this->quantity;
            if($this->newImage){
            $imageName = Carbon::now()->timestamp. '.' . $this->newImage->extension();
            $this->newImage->storeAs('products',$imageName);
            $product->image = $imageName;
        }
        
        $product->save();
        session()->flash('message','Cập nhật sản phẩm thành công!');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-edit-product-component',['categories'=>$categories])->layout('layouts.base');
    }
}
