<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Products;
use App\Models\Sale;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Cart;
class HomeComponent extends Component
{
    public function render()
    {
        $sliders = HomeSlider::where('status',1)->where('type',1)->get();
        $lproducts = Products::orderBy('created_at','DESC')->get()->take(8);
        $category = HomeCategory::find(1);
        $cats = explode(',',$category->sel_categories);
        $categories = Category::whereIn('id',$cats)->with('subCategory')->get();
        $no_of_products = $category->no_of_products;
        $sale_products = Products::where('sale_price','>',0)->inRandomOrder()->get()->take(8);
        foreach ($categories as $key=>$category){
            $c_products = Products::where('category_id',$category->id)->get()->take($no_of_products);
        }
        $sale = Sale::find(1);
        if(Auth::check()){
            Cart::instance('cart')->restore(Auth::user()->email);
            Cart::instance('wishlist')->restore(Auth::user()->email);
        }
        $banners = HomeSlider::inRandomOrder()->where('status',1)->where('type',0)->limit(2)->get();
        $new_product_banner = HomeSlider::where('status',1)->where('type',0)->orderBy('created_at','DESC')->first();
        $product_banner = HomeSlider::inRandomOrder()->where('status',1)->where('id','!=',$new_product_banner->id)->where('type',0)->first();
        return view('livewire.home-component',['product_banner'=>$product_banner,'new_product_banner'=>$new_product_banner,'banners'=>$banners,'sliders'=>$sliders,'lproducts'=>$lproducts,'categories'=>$categories,'no_of_products'=>$no_of_products,'sale_products'=>$sale_products,'sale'=>$sale])->ex('layouts.base');
    }
}
