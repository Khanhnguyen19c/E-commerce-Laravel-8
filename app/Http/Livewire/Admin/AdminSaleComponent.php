<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sale;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class AdminSaleComponent extends Component
{
    use AuthorizesRequests;
    public $sale_date;
    public $status;

    public function mount(){
        $sale= Sale::find(1);
        $this->sale_date = $sale->sale_date;
        $this->status = $sale->status;
    }

    public function updateSale(){
        $this->authorize('sale-edit');
        $sale= Sale::find(1);
        $sale -> sale_date = $this->sale_date;
        $sale -> status = $this->status;
        $sale->save();
        session()->flash('message','Cập nhật thời gian Sale thành công!');
    }
    public function render()
    {
        return view('livewire.admin.admin-sale-component')->layout('layouts.base');
    }
}
