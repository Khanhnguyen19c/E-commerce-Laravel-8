<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Products;
use App\Models\Sale;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $sliders = HomeSlider::where('status',1)->get();
        $lproducts = Products::orderBy('created_at','DESC')->get()->take(8);
        $category = HomeCategory::find(1);
        $cats = explode(',',$category->sel_categories);
        $categories = Category::whereIn('id',$cats)->get();
        $no_of_products = $category->no_of_products;
        $sale_products = Products::where('sale_price','>',0)->inRandomOrder()->get()->take(8);
        foreach ($categories as $key=>$category){
            $c_products = Products::where('category_id',$category->id)->get()->take($no_of_products);
        }
        $sale = Sale::find(1);
        return view('livewire.home-component',['sliders'=>$sliders,'lproducts'=>$lproducts,'categories'=>$categories,'no_of_products'=>$no_of_products,'sale_products'=>$sale_products,'sale'=>$sale])->layout('layouts.base');
    }
}
