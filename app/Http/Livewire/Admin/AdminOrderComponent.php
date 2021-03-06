<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
class AdminOrderComponent extends Component
{
    //update status orders
    public function updateOrderStatus($order_id,$status){
        $order = Order::find($order_id);
        $orderItems = OrderItem::where('order_id',$order_id)->get();
        if($status == "delivered"){
            $order->delivered_date = DB::raw('CURRENT_DATE');
            foreach($orderItems as $orderItem){
                    $products = Products::where('id',$orderItem->product_id)->get();
                    foreach($products as $product){
                        $product->quantity-= $orderItem->quantity;
                        $product->sold+= $orderItem->quantity;
                        $product->save();
                    }
            }
        }
        else if($status == "canceled"){
            if($order->status == "delivered"){
                foreach($orderItems as $orderItem){
                    $products = Products::where('id',$orderItem->product_id)->get();
                    foreach($products as $product){
                        $product->quantity+= $orderItem->quantity;
                        $product->sold-= $orderItem->quantity;
                        $product->save();
                    }
            }
            }
            $order->canceled_date = DB::raw('CURRENT_DATE');
        }
        $order->status = $status;
        $order->save();
        session()->flash('order_message','Cập nhật trạng thái đơn hàng thành công!');
    }
    public function render()
    {
        $orders = Order::orderBy('created_at','DESC')->paginate(12);
        return view('livewire.admin.admin-order-component',['orders'=>$orders])->layout('layouts.base');
    }
}
