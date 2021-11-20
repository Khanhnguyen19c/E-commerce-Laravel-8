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
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\Sale;
class TopProductsReviewComponent extends Component
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
        $this->max_price = 100000000;
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
            if($this->sorting =='date'){
                $products = Products::whereBetween('regular_price',[$this->min_price,$this->max_price])->with('orderItems')->with('review')->where('rating','>',0)->orderBy('created_at','DESC')->paginate($this->pagesize);
            }
            else if($this->sorting =='price'){
                $products = Products::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','ASC')->paginate($this->pagesize);
            }
            else if($this->sorting =='price-desc'){
                $products = Products::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','DESC')->paginate($this->pagesize);
            }
            else{

                $products = OrderItem::join('products','products.id','=','order_items.product_id')->join('reviews','reviews.order_item_id','order_items.id')->where('reviews.rating','>',0)->whereBetween('regular_price',[$this->min_price,$this->max_price])->paginate($this->pagesize);
            }


        // save store when customer logout
        if(Auth::check()){
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return view('livewire.top-products-review-component',['products' => $products])->layout("layouts.base");
    }
}
