<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Products;
use Cart;
use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Subcategory;
use App\Models\Sale;
class CategoryComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $category_slug;
    public $scategory_slug;
    public $min_price;
    public $max_price;

    public function mount($category_slug,$scategory_slug=null){
        $this->sorting = "default";
        $this->pagesize = 5;
        $this->min_price = 100000;
        $this->max_price = 100000000;

        $this->category_slug = $category_slug;
        $this->scategory_slug =$scategory_slug;

    }
    // add cart
    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Products');
        Session()->flash('success_message','Sản Phẩm Đã Được Thêm Vào Giỏ Hàng');
        return redirect()->route('product.cart');
    }

    //add wish-list
    public function addToWishlist($product_id,$product_name,$product_price){
    Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Products');
    $this->emitTo('wish-list-count-component','refreshComponent');
    }

    //remove wishlist
    public function removeFromWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $witem){
            if($witem->id == $product_id){
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wish-list-count-component','refreshComponent');
                return;
            }
        }
    }
     use WithPagination;
    public function render()
    {
        $category_id = null;
        $category_name ="";
        $filter= "";

        if($this->scategory_slug){
            $scategory = Subcategory::where('slug',$this->scategory_slug)->first();
            $category_id = $scategory->id;
            $category_name = $scategory->name;
            $filter= "sub";
        }
        else{
            $category = Category::where('slug',$this->category_slug)->first();
            $category_id = $category->id;
            $category_name = $category->name;
            $filter= "";
        }

        if($this->sorting =='date'){
            $products = Products::where($filter.'category_id',$category_id)->whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting =='price'){
            $products = Products::where($filter.'category_id',$category_id)->whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else if($this->sorting =='price-desc'){
            $products = Products::where($filter.'category_id',$category_id)->whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else{
            $products = Products::where($filter.'category_id',$category_id)->whereBetween('regular_price',[$this->min_price,$this->max_price])->paginate($this->pagesize);
        }

        return view('livewire.category-component',['products' => $products,'category_name'=>$category_name])->layout("layouts.base");
    }
}
