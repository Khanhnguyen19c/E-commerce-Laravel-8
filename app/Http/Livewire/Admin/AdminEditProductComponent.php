<?php

namespace App\Http\Livewire\Admin;

use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\Products;
use App\Models\Subcategory;
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

    public $images;
    public $newImages;
    public $scategory_id;

    public $attr;
    public $inputs =[];
    public $attribute_arr =[];
    public $attribute_value=[];

    public function mount($product_slug)
    {
        $product = Products::where('slug', $product_slug)->first();
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
        $this->images = explode(",", $product->images);
        $this->category_id = $product->category_id;
        $this->product_id = $product->id;
        $this->scategory_id = $product->subcategory_id;
        $this->inputs = $product->attributevalues->where('product_id',$product->id)->unique('product_attribute_id')->pluck('product_attribute_id');
        $this->attribute_arr =$product->attributevalues->where('product_id',$product->id)->unique('product_attribute_id')->pluck('product_attribute_id');

        foreach($this->attribute_arr as $a_rr){
            $allAtributeValue = AttributeValue::where('product_id',$product->id)->where('product_attribute_id',$a_rr)->get()->pluck('value');
            $valueString = '';
            foreach($allAtributeValue as $value){
                $valueString = $valueString. $value .',' ;
            }
            $this->attribute_value[$a_rr]= rtrim($valueString,",");
        }
    }
    public function generateslug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    //add attribute
    public function add(){
        if(!$this->attribute_arr->contains($this->attr)){
            $this->inputs->push($this->attr);
            $this->attribute_arr->push($this->attr);
        }
    }
    //remove attribute
    public function remove($attr){
        unset($this->inputs[$attr]);
    }
    public function undated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'short_desc' => 'required',
            'desc' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            'category_id' => 'required',
        ]);
        if ($this->newImage) {
            $this->validateOnly($fields, [
                'newImage' => 'required|mimes:png,jpg'
            ]);
        }
    }

    public function updateProduct()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'short_desc' => 'required',
            'desc' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            'category_id' => 'required',
        ]);
        if ($this->newImage) {
            $this->validate([
                'newImage' => 'required|mimes:png,jpg'
            ]);
        }
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
        if ($this->newImage) {
            unlink('assets/images/products' . '/' . $product->image);
            $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('products', $imageName);
            $product->image = $imageName;
        }
        if ($this->newImages) {
            if ($product->images) {
                $images = explode(",", $product->images);
                foreach ($images as $image) {
                    if ($image) {
                        unlink('assets/images/products' . '/' . $image);
                    }
                }
            }
            $imagesName = '';
            foreach ($this->newImages as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('products', $imgName);
                $imagesName = $imagesName . ',' . $imgName;
            }
            $product->images = $imagesName;
        }
        if($this->scategory_id){
            $product->subcategory_id = $this->scategory_id;
        }
        $product->save();
        AttributeValue::where('product_id',$product->id)->delete();
        foreach($this->attribute_value as $key=>$attrbute_value)
        {
            $avalues = explode(",",$attrbute_value);
            foreach($avalues as $avalue){
                $attr_value = new AttributeValue();
                $attr_value->product_attribute_id = $key;
                $attr_value->value = $avalue;
                $attr_value->product_id = $product->id;
                $attr_value->save();
            }
        }
        session()->flash('message', 'Cập nhật sản phẩm thành công!');
    }
    public function changeSubcategory(){
        $this->scategory_id = 0;
    }
    public function render()
    {
        $scategories = Subcategory::where('category_id',$this->category_id)->get();
        $categories = Category::all();
        $attributes = ProductAttribute::all();
        return view('livewire.admin.admin-edit-product-component', ['categories' => $categories,'scategories'=>$scategories,'attributes'=>$attributes])->layout('layouts.base');
    }
}
