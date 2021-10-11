<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
class CartComponent extends Component
{
    // click + 1 item cart
    public function increaseQuantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');
    }
    // click - 1 item cart
    public function decreaseQuantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');
    }
    // delete cart
    public function destroy($rowId){
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('success_message','Sản phẩm đã được xoá khỏi giỏ hàng');
        
    }
    // delete all
    public function destroyAll(){
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component','refreshComponent');
    }

    // saveforlater
    public function switchToSaveForLater($rowId){
        $item = Cart::instance('cart')->get($rowId);
        Cart::instance('cart')->remove($rowId);
        Cart::instance('saveForLater')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Products');
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('success_message','Đã lưu sản phảm');
    }

    // moveToCart
    public function moveToCart($rowId){
        $item = Cart::instance('saveForLater')->get($rowId);
        Cart::instance('saveForLater')->remove($rowId);
        Cart::instance('cart')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Products');
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('s_success_message','Đã đã di chuyển sản phẩm');
    }
    
    public function deleteFromSaveForLater($rowId){
        Cart::instance('saveForLater')->remove($rowId);
        session()->flash('s_success_message','Bạn đã bỏ lưu sản phẩm');
    }
    public function render()
    {
        return view('livewire.cart-component')->layout("layouts.base");
    }
}
