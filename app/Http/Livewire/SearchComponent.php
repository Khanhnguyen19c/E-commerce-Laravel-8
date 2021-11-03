<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Products;
use Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Sale;

class SearchComponent extends Component
{
    public $sorting;
    public $pagesize;

    public $search;
    public $product_cat;
    public $product_cat_id;
    public $min_price;
    public $max_price;
    public function mount(){
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->fill(request()->only('search','product_cat','product_cat_id'));
        $this->min_price = 100000;
        $this->max_price = 20000000;
    }
    // add cart
    public function store($product_id,$product_name,$product_price){
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Products');
        Session()->flash('success_message','Sản Phẩm Đã Được Thêm Vào Giỏ Hàng');
        return redirect()->route('product.cart');
    }
     use WithPagination;
    public function render()
    {
        if($this->sorting =='date'){
            $products = Products::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('name','like','%'.$this->search .'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting =='price'){
            $products = Products::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('name','like','%'.$this->search .'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else if($this->sorting =='price-desc'){
            $products = Products::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('name','like','%'.$this->search .'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else{
            $products =  Products::whereBetween('regular_price',[$this->min_price,$this->max_price])->where('name','like','%'.$this->search .'%')->where('category_id','like','%'.$this->product_cat_id.'%')->paginate($this->pagesize);
        }
        $categories = Category::all();
        if(Auth::check()){
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
        $brands = Brand::all();
        $sale = Sale::find(1);
        $popular_products = Products::inRandomOrder()->limit(4)->get();
        $new_product_banner = HomeSlider::where('status',1)->where('type',0)->orderBy('created_at','DESC')->first();
        return view('livewire.search-component',['brands'=>$brands,'new_product_banner'=>$new_product_banner,'sale'=>$sale,'popular_products'=>$popular_products,'products' => $products,'categories'=> $categories])->layout("layouts.base");
    }
}
