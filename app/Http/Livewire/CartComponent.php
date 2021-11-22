<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Models\Products;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;
class CartComponent extends Component
{
    public $haveCouponCode;
    public $couponCode;
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;
    public $calculateDiscount;

    // click + 1 item cart
    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');
    }
    // click - 1 item cart
    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
        $this->emitTo('cart-count-component', 'refreshComponent');
    }
    // delete cart
    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success_message', 'Sản phẩm đã được xoá khỏi giỏ hàng');
    }
    // delete all
    public function destroyAll()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    // lưu lại sản phẩm
    public function switchToSaveForLater($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        Cart::instance('cart')->remove($rowId);
        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Products');
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success_message', 'Đã lưu sản phảm');
    }

    // chuyển sản phẩm đã lưu vào giỏ hàng
    public function moveToCart($rowId)
    {
        $item = Cart::instance('saveForLater')->get($rowId);
        Cart::instance('saveForLater')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Products');
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('s_success_message', 'Đã đã di chuyển sản phẩm');
    }
    // delete item đã lưu
    public function deleteFromSaveForLater($rowId)
    {
        Cart::instance('saveForLater')->remove($rowId);
        session()->flash('s_success_message', 'Bạn đã bỏ lưu sản phẩm');
    }

    // get coupon
    public function applyCoupon()
    {
        $coupon = Coupon::where('code', $this->couponCode)->where('expiry_date','>=',Carbon::today())->where('cart_value', '<=', Cart::instance('cart')->subtotal())->first();
        if (!$coupon) {
            session()->flash('coupon_message', 'Mã code của bạn không hợp lệ');
            return;
        }
        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'cart_value' => $coupon->cart_value,
            'value' => $coupon->value,
        ]);
    }

    // calculate Coupon
    public function calculateDiscount()
    {
        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] == 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = (Cart::instance('cart')->subtotal * session()->get('coupon')['value'] / 100);
            }
            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
            $this->taxAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax')) / 100;
            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }

    //remove coupon
    public function removeCoupon()
    {
        session()->forget('coupon');
    }

    // checkout
    public function checkout(){
        if(Auth::check()){
            return redirect()->route('checkout');
        }
        else{
            return redirect()->route('login');
        }
    }

    // set số tiền thanh toán
    public function setAmountForCheckout(){
        if(!Cart::instance('cart')->count() >0){
            session()->forget('checkout');
            return;
        }
        if(session()->has('coupon')){
            session()->put('checkout',[
                'discount'=> $this->discount,
                'subtotal'=> $this->subtotalAfterDiscount,
                'tax'=> $this->taxAfterDiscount,
                'total'=>$this->totalAfterDiscount
            ]);
        }
        else{
            session()->put('checkout',[
                'discount'=> 0,
                'subtotal'=> Cart::instance('cart')->subtotal(),
                'tax'=> Cart::instance('cart')->tax(),
                'total'=> Cart::instance('cart')->total()
            ]);
        }
    }
    public function render()
    {
        if (session()->has('coupon')) {
            if (Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value']) {
                session()->forget('coupon');
            } else {
                $this->calculateDiscount();
            }
        }
        $this->setAmountForCheckout();
        $sale = Sale::find(1);
        if(Auth::check()){
            Cart::instance('cart')->store(Auth::user()->email);
        }
        $popular_products = Products::inRandomOrder()->limit(10)->get();
        return view('livewire.cart-component', ['sale' => $sale,'popular_products'=>$popular_products])->layout("layouts.base");
    }
}
