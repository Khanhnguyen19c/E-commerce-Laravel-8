<?php

namespace App\Http\Livewire\Admin;

use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\Products;
use App\Models\Subcategory;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
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
    public $images;
    public $scategory_id;

    public $attr;
    public $inputs =[];
    public $attribute_arr =[];
    public $attribute_value;

    public function mount(){
        $this->stock_status = 'Trong Kho';
        $this->featured = 0;
    }
    public function generateslug(){
        $this->slug= Str::slug($this->name,'-');
        $this->sale_price = 0 ;
    }
    //add attribute
    public function add(){
        if(!in_array($this->attr,$this->attribute_arr)){
            array_push($this->inputs,$this->attr);
            array_push($this->attribute_arr,$this->attr);
        }
    }
    //remove attribute
    public function remove($attr){
        unset($this->inputs[$attr]);
    }
    public function undated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
            'slug'=>'required|unique:products',
            'short_desc'=>'required',
            'desc'=>'required',
            'regular_price'=>'required|numeric',
            'sale_price'=>'numeric',
            'SKU'=>'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required|numeric',
            'image'=>'required|mimes:jpeg,png',
            'category_id'=>'required',
        ]);
    }
    public function addProduct(){
        $this->validate([
            'name'=>'required',
            'slug'=>'required|unique:products',
            'short_desc'=>'required',
            'desc'=>'required',
            'regular_price'=>'required|numeric',
            'sale_price'=>'numeric',
            'SKU'=>'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required|numeric',
            'image'=>'required|mimes:jpeg,png',
            'category_id'=>'required',
        ]);
        $product = New Products();
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
        $imageName = Carbon::now()->timestamp. '.' . $this->image->extension();
        $this->image->storeAs('products',$imageName);
        $product->image = $imageName;

        if($this->images){
            $imagesname= '';
            foreach($this->images as $key=>$image){
                $imgName = Carbon::now()->timestamp. $key. '.' . $image->extension();
                $image->storeAs('products',$imgName);
                $imagesname = $imagesname . ',' . $imgName;
            }
            $product->images= $imagesname;
        }
        if($this->scategory_id){
            $product->subcategory_id = $this->scategory_id;
        }
        $product->save();

        foreach($this->attribute_value as $key=>$attribute_val){
            $values = explode(",",$attribute_val);
            foreach($values as $value){
                $attr_value = new AttributeValue();
                $attr_value->product_attribute_id = $key;
                $attr_value->value= $value;
                $attr_value->product_id = $product->id;
                $attr_value->save();
            }
        }
        session()->flash('message','Thêm sản phẩm thành công!');


    }
    public function changeSubcategory(){
        $this->scategory_id = 0;
    }
    public function render()
    {
        $categories = Category::all();
        $scategories = Subcategory::where('category_id',$this->category_id)->get();

        $attributes = ProductAttribute::all();
        return view('livewire.admin.admin-add-product-component',['categories'=>$categories,'scategories'=>$scategories,'attributes'=>$attributes])->layout('layouts.base');
    }
}
