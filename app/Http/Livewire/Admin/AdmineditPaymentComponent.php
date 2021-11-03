<?php

namespace App\Http\Livewire\Admin;

use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
class AdmineditPaymentComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $images;
    public $newImages;
    public $payment_id;
    public function undated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
            'images'=>'required|max:10000',
        ]);
        if ($this->newImage) {
            $this->validateOnly($fields, [
                'newImages' => 'required|max:10000'
            ]);
        }
    }
    public function mount($id){
        $payment = Payment::find($id);
        $this->name = $payment->name;
        $this->images = explode(",",$payment->images);
        $this->payment_id = $payment->id;
    }
    public function updatePayment(){
        $this->validate([
            'name'=>'required',
            'images'=>'required|max:10000',
        ]);
        if ($this->newImages) {
            $this->validate([
                'newImages' => 'required|max:10000'
            ]);
        }
        $payment = Payment::find($this->payment_id);
        $payment->name = $this->name;
        if ($this->newImages) {
            if ($payment->images) {
                $images = explode(",", $payment->images);
                foreach ($images as $image) {
                    if ($image) {
                        unlink('assets/images/payments' . '/' . $image);
                    }
                }
            }
            $imagesName = '';
            foreach ($this->newImages as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('payments', $imgName);
                $imagesName = $imagesName . ',' . $imgName;
            }
            $payment->images= $imagesName;
        }

            $payment->save();
            session()->flash('message','Cập nhật đối tác thành công!');
    }
    public function render()
    {
        return view('livewire.admin.adminedit-payment-component')->layout('layouts.base');
    }
}
