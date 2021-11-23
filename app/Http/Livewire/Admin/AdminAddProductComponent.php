<?php

namespace App\Http\Livewire\Admin;

use App\Models\AttributeValue;
use App\Models\Brand;
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
    public $brand_id;
    public $attr;
    public $inputs =[];
    public $attribute_arr =[];
    public $attribute_value;

    public function mount(){
        $this->stock_status = 'Trong Kho';
        $this->featured = 0;
        $this->sale_price = 0;
    }
    public function generateslug(){
        $this->slug= Str::slug($this->name,'-');
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
    public function updated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
            'slug'=>'required|unique:products',
            'short_desc'=>'required',
            'desc'=>'required',
            'regular_price'=>'required|regex:/^[0-9\.\-\/]+$/',
            'sale_price'=>'required|regex:/^[0-9\.\-\/]+$/',
            'SKU'=>'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required|numeric',
            'image'=>'required|mimes:jpeg,png|max:1024',
            'images'=>'max:1000',
            'category_id'=>'required',
            'brand_id' =>'required'
        ]);
    }
    protected $messages = [
        'name.required' => 'Thông tin này không được bỏ trống.',
        'slug.required' => 'Thông tin này không được bỏ trống.',
        'short_desc.required' => 'Thông tin này không được bỏ trống.',
        'regular_price.required' => 'Thông tin này không được bỏ trống.',
        'sale_price.required' => 'Thông tin này không được bỏ trống.',
        'SKU.required'=> 'Thông tin này không được bỏ trống.',
        'stock_status.required'=> 'Thông tin này không được bỏ trống.',
        'featured.required'=> 'Thông tin này không được bỏ trống.',
        'quantity.required'=> 'Thông tin này không được bỏ trống.',
        'quantity.numeric' => 'Bạn phải nhập định dạng là chữ số.',
        'image.required'=> 'Hình ảnh không được bỏ trống tối đa 1MB.',
        'image.mimes'=> 'Bạn phải chọn một định dạnh jpeg or png.',
        'category_id.required'=> 'Thông tin này không được bỏ trống.',
        'brand_id.required'=> 'Thông tin này không được bỏ trống.',
    ];
    public function addProduct(){
        $this->validate([
            'name'=>'required',
            'slug'=>'required|unique:products',
            'short_desc'=>'required',
            'desc'=>'required',
            'regular_price'=>'required|regex:/^[0-9\.\-\/]+$/',
            'sale_price'=>'required|regex:/^[0-9\.\-\/]+$/',
            'SKU'=>'required',
            'stock_status'=>'required',
            'featured'=>'required',
            'quantity'=>'required|numeric',
            'image'=>'required|mimes:jpeg,png|max:1024',
            'category_id'=>'required',
            'images'=>'max:1000',
            'brand_id' =>'required'
        ]);
        $product = New Products();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_desc = $this->short_desc;
        $product->desc = $this->desc;

        $product->regular_price = str_replace('.','',$this->regular_price );
        $product->sale_price = str_replace('.','',$this->sale_price );
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->category_id = $this->category_id;
        $product->SKU = $this->SKU;
        $product->quantity = $this->quantity;
        $product->brand_id = $this->brand_id;
        $product->sold = 0;
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
        // var_dump($product);
        if($this->attribute_value){
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
        }
        session()->flash('message','Thêm sản phẩm thành công!');
        $this->reset();
      return redirect()->back();
    }

    //validate price
    public function format_regularprice(){
        $regular_price = $this->regular_price;
        $regular_price = preg_replace('/[^0-9]+/', '', $regular_price);
        $regular_price = substr($regular_price, 0, 11);
        $length = strlen($regular_price);
        $formatted = "";
        for ($i = 0; $i < $length; $i++) {
            if($length == 7){
                $formatted .= $regular_price[$i];
                if($i == 0 || $i == 3){
                    $formatted .= ".";
                }
            }else{
                $formatted .= $regular_price[$i];
                if($i == 1 || $i == 4){
                    $formatted .= ".";
                }
            }

        }
        $this->regular_price = $formatted;
    }
    //validate sale_price
    public function format_saleprice(){
        $sale_price = $this->sale_price;
        $sale_price = preg_replace('/[^0-9]+/', '', $sale_price);
        $sale_price = substr($sale_price, 0, 11);
        $length = strlen($sale_price);
        $formatted = "";
        for ($i = 0; $i < $length; $i++) {
            if($length == 7){
                $formatted .= $sale_price[$i];
                if($i == 0 || $i == 3){
                    $formatted .= ".";
                }
            }else{
                $formatted .= $sale_price[$i];
                if($i == 1 || $i == 4){
                    $formatted .= ".";
                }
            }

        }
        $this->sale_price = $formatted;

    }
    public function changeSubcategory(){
        $this->scategory_id = 0;
    }
    public function render()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $scategories = Subcategory::where('category_id',$this->category_id)->get();

        $attributes = ProductAttribute::all();
        return view('livewire.admin.admin-add-product-component',['brands'=>$brands,'categories'=>$categories,'scategories'=>$scategories,'attributes'=>$attributes])->layout('layouts.base');
    }
}
