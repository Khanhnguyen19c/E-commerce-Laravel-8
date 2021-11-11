<?php

namespace App\Http\Livewire;

use App\Mail\OrderMail;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Province;
use App\Models\Shipping;
use App\Models\Transaction;
use App\Models\Ward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use PhpParser\Node\Stmt\Echo_;
use Cart;
use Exception;
use Stripe;
class CheckoutComponent extends Component
{
    public $ship_to_different;

    public $firstname;
    public $lastname;
    public $email;
    public $mobile;
    public $line;
    public $city;
    public $province;
    public $ward;

    public $s_firstname;
    public $s_lastname;
    public $s_email;
    public $s_mobile;
    public $s_line;

    public $paymentmode;

    public $thankyou;

    public $card_no;
    public $exp_month;
    public $exp_year;
    public $cvc;

    public $vnd_to_usd ;
    public $selectedCity = null;
    public $selectedProvince = null;
    public $selectedWard = null;

    public function updated($fields){
        $this->validateOnly($fields,[
            'firstname' => 'required',
            'lastname' => 'required',
            'email'=> 'required',
            'mobile'=> 'required|numeric',
            'line'=> 'required',
            'selectedCity'=> 'required',
            'selectedProvince'=> 'required',
            'selectedWard'=> 'required',
            'paymentmode' => 'required'
        ]);

        if($this->ship_to_different){
            $this->validateOnly($fields,[
                's_firstname' => 'required',
                's_lastname' => 'required',
                's_email'=> 'required',
                's_mobile'=> 'required|numeric',
                's_line'=> 'required',
                ]);
        }
        if($this->paymentmode =='card'){
            $this->validateOnly($fields,[
                'card_no'=>'required|numeric',
                'exp_month'=>'required|numeric',
                'exp_year'=>'required|numeric',
                'cvc'=>'required|numeric'
            ]);

        }
    }
    public function placeOrder(){
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email'=> 'required',
            'mobile'=> 'required|numeric',
            'line'=> 'required',
            'selectedCity'=> 'required',
            'selectedProvince'=> 'required',
            'selectedWard'=> 'required',
            'paymentmode' => 'required'
        ]);
        if($this->paymentmode =='card'){
            $this->validate([
                'card_no'=>'required|numeric',
                'exp_month'=>'required|numeric',
                'exp_year'=>'required|numeric',
                'cvc'=>'required|numeric'
            ]);
        }
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->subtotal = Session()->get('checkout')['subtotal'];
        $order->discount = Session()->get('checkout')['discount'];
        $order->tax = Session()->get('checkout')['tax'];
        $order->total = Session()->get('checkout')['total'];
        $order->firstname = $this->firstname;
        $order->lastname = $this->lastname;
        $order->email = $this->email;
        $order->mobile = $this->mobile;
        $order->line = $this->line;
        $order->city =  $this->selectedCity;
        $order->province =  $this->selectedProvince;
        $order->ward = $this->selectedWard;
        $order->status = 'ordered';
        $order->is_shipping_different = $this->ship_to_different ? 1:0;
        $order->save();

        foreach(Cart::instance('cart')->content() as $item){
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            if($item->options){
                $orderItem->options = serialize($item->options);
            }
            $orderItem->save();
        };
        if($this->ship_to_different){
            $this->validate([
                's_firstname' => 'required',
                's_lastname' => 'required',
                's_email'=> 'required',
                's_mobile'=> 'required|numeric',
                's_line'=> 'required',
                ]);
                $shipping = new Shipping();
                $shipping->order_id = $order->id;
                $shipping->firstname = $this->s_firstname;
                $shipping->lastname = $this->s_lastname;
                $shipping->email = $this->s_email;
                $shipping->mobile = $this->s_mobile;
                $shipping->line = $this->s_line;
                $shipping->save();
        }
        if($this->paymentmode =='cod'){
           $this->makeTransaction($order->id,'pending');
           $this->resetCart();
        }
        else if($this->paymentmode =='paypal'){
            $this->makeTransaction($order->id,'approved');
            $this->resetCart();
        }
        else if($this->paymentmode =='card'){
            $stripe = Stripe::make(env('STRIPE_KEY'));
            try{
                $token = $stripe->token()->create([
                    'card' =>[
                        'number' => $this->card_no,
                        'exp_month' => $this->exp_month,
                        'exp_year' => $this->exp_year,
                        'cvc' => $this->cvc
                    ]
                ]);
                if(!isset($token['id'])){
                    session()->flash('stripe_error','Mã số thẻ không dúng hoặc có lỗi xảy ra vui lòng thử lại!');
                    $this->thankyou=0;
                }
                $customer = $stripe->customer()->create([
                    'name'=>$this->firstname .' ' . $this->lastname,
                    'email' => $this->email,
                    'phone' => $this->mobile,
                    'address'=> $this->line,
                    'shipping' =>[
                        'name'=>$this->firstname .' ' . $this->lastname,
                        'address'=> $this->line
                    ],
                    'source' => $token['id']
                ]);
                $change = $stripe->changes()->create([
                    'customer' =>$customer['id'],
                    'currency' =>'VND',
                    'AMOUNT' => Session()->get('checkout')['total'],
                    'description'=> 'Thanh toán cho đơn hàng '. $order->id
                ]);
                if($change['status'] == 'succeeded'){
                    $this->makeTransaction($order->id,'approved');
                    $this->resetCart();
                }
                else{
                    session()->flash('stripe_error','Lỗi thanh toán! Vui lòng thử lại sau!');
                    $this->thankyou= 0;
                }
            } catch(Exception $e){
                session()->flash('stripe_error',$e->getMessage());
                $this->thankyou = 0;
            }
        }
        $this->sendOrderConfirmation($order);

   }
   public function resetCart(){
    $this->thankyou = 1;
    Cart::instance('cart')->destroy();
    session()->forget('checkout');
    session()->forget('coupon');
   }
   public function makeTransaction($order_id,$status){
    $transaction = new Transaction();
    $transaction->user_id = Auth::user()->id;
    $transaction->order_id = $order_id;
    $transaction->mode = $this->paymentmode;
    $transaction->status = $status;
    $transaction->save();
   }

   public function sendOrderConfirmation($order){
       Mail::to($order->email)->send(new OrderMail($order));
   }
    public function mount()
    {
        $this->city = City::all();
        $this->province = collect();
        $this->ward = collect();
        if(Session()->get('checkout')){
            $this->vnd_to_usd= Session()->get('checkout')['total']/23083;
        }

    }

    public function verifyforCheckout(){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        else if($this->thankyou){
            return redirect()->route('thankyou');
        }
        else if(!session()->get('checkout')){
            return redirect()->route('product.cart');
        }
    }
    public function render()
    {
        $this->verifyforCheckout();
        return view('livewire.checkout-component')->layout("layouts.base");
    }
    public function updatedSelectedCity($cities)
    {
        $this->province = Province::where('matp', $cities)->get();
        $this->selectedProvince = NULL;
    }

    public function updatedSelectedProvince($provinces)
    {
        if (!is_null($provinces)) {
            $this->ward = Ward::where('maqh', $provinces)->get();
            $this->selectedWard = NULL;
        }
    }

}
