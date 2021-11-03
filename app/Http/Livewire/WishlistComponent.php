<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Livewire\Component;
use Cart;
class WishlistComponent extends Component
{
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

    // move product to cart
    public function moveProductFromWishlistToCart($rowId){
        $item = Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Products');
        $this->emitTo('wish-list-count-component','refreshComponent');
        $this->emitTo('cart-count-component','refreshComponent');
    }
    public function render()
    {
        $sale = Sale::find(1);
        return view('livewire.wishlist-component',['sale'=>$sale])->layout('layouts.base');
    }
}
