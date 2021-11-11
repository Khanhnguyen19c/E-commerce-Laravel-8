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
use Carbon\Carbon;
class TopProductOnWeekComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $min_price;
    public $max_price;
    use WithPagination;

    public function mount(){
        $this->sorting = "default";
        $this->pagesize = 12;

        $this->min_price = 100000;
        $this->max_price = 20000000;
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
    public function render()
    {
        //get date
        $from = Carbon::now();
        $to = $from->subDays(7);
        if($this->sorting =='date'){
            $products = Products::whereBetween('regular_price',[$this->min_price,$this->max_price])->whereBetween('created_at',[$from,$to])->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting =='price'){
            $products = Products::whereBetween('regular_price',[$this->min_price,$this->max_price])->whereBetween('created_at',[$from,$to])->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else if($this->sorting =='price-desc'){
            $products = Products::whereBetween('regular_price',[$this->min_price,$this->max_price])->whereBetween('created_at',[$from,$to])->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else{
            $products = Products::whereBetween('regular_price',[$this->min_price,$this->max_price])->whereBetween('created_at',[$from,$to])->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        var_dump($from);
        var_dump()
        $categories = Category::all();
        $sale = Sale::find(1);
        $popular_products = Products::inRandomOrder()->limit(4)->get();
        // save store when customer logout
        if(Auth::check()){
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
        $brands = Brand::all();
        $new_product_banner = HomeSlider::where('status',1)->where('type',0)->orderBy('created_at','DESC')->first();
        return view('livewire.top-product-on-week-component',['brands'=>$brands,'new_product_banner'=>$new_product_banner,'products' => $products,'categories'=> $categories,'sale' => $sale,'popular_products'=>$popular_products])->layout('layouts.base');
    }
}
