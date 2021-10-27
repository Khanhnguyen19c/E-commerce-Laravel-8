<?php

namespace App\Http\Livewire\Admin;

use App\Models\Products;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
class AdminProductComponent extends Component
{
    use WithPagination;
    public $searchProduct;

    public function deleteProduct($id){
        $product = Products::find($id);
        if($product->image){
              unlink('assets/images/products'.'/'.$product->image);
        }
        if($product->images){
            $images = explode(",",$product->images);
            foreach($images as $image){
                if($image){
                    unlink('assets/images/products'.'/'.$image);
                }
            }
        }
        $product->delete();
        session()->flash('message','Xoá sản phẩm thành công');
    }
    public function render()
    {
        $search = '%' . $this->searchProduct . '%';
        $products = Products::where('name','LIKE',$search)->orWhere('stock_status','LIKE',$search)->orWhere('regular_price','LIKE',$search)->orWhere('sale_price','LIKE',$search)->OrderBy('id','DESC')->paginate(10);
        return view('livewire.admin.admin-product-component',['products'=>$products])->layout('layouts.base');;
    }
}
