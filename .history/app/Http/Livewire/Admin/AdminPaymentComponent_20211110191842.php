<?php

namespace App\Http\Livewire\Admin;

use App\Models\Payment;
use Livewire\Component;

class AdminPaymentComponent extends Component
{
    public $showEditModal = False;

    //delete payment
    public function deletePayment($id){
        $payment = Payment::find($id);
            $images = explode(",",$payment->images);
            foreach($images as $pay){
                if($pay){
                    unlink('assets/images/payments'.'/'.$pay);
                }
            }
        $payment->delete();
        session()->flash('message','Xoá đối tác thành công');
    }

    //refesh page
    public function refesh(){
        $this->emitTo('admin.admin.admin-brand-component','refreshComponent');
        $this->dispatchBrowserEvent('hide-form');
    }
    public function render()
    {
        $payments = Payment::all();
        return view('livewire.admin.admin-payment-component',['payments'=>$payments])->layout('layouts.base');
    }
}
