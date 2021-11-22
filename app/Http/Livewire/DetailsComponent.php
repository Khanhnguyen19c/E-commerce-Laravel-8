<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Products;
use App\Models\Sale;
use App\Models\Subcategory;
use Livewire\Component;
use Cart;
use Illuminate\Http\Request;

class DetailsComponent extends Component
{
    public $slug;
    public $qty;

    public $satt = [];
    public $currentUrl;


    public function mount($slug){
        $this->slug = $slug;
        $this->qty = 1;
        $this->currentUrl = url()->current();
    }
    //add card
    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,$this->qty,$product_price,$this->satt)->associate('App\Models\Products');
        Session()->flash('success_message','Sản Phẩm Đã Được Thêm Vào Giỏ Hàng');
        return redirect()->route('product.cart');
    }
    //tăng số lượng
    public function increaseQuantity(){
        $this->qty++;
    }
    //giảm số lượng
    public function decreseQuantity(){
        if($this->qty >1){
            $this->qty--;
        }
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
        $product = Products::where('slug',$this->slug)->first();
        $popular_products = Products::whereNotIn('slug',[$this->slug])->inRandomOrder()->limit(4)->get();
        $related_products = Products::whereNotIn('slug',[$this->slug])->where('brand_id',$product->brand_id)->inRandomOrder()->limit(12)->get();
        $category = Category::find($product->category_id);
        $scategory = Subcategory::find($product->subcategory_id);
        $url_canonical = $this->currentUrl;
        $image_og = url('public/assets/images/products/'.$product->image);
        return view('livewire.details-component',['scategory'=>$scategory,'category'=>$category,'url_canonical'=>$url_canonical,'image_og'=>$image_og,'product'=>$product,'popular_products'=>$popular_products,'related_products'=>$related_products])->layout('layouts.base');
    }
}
