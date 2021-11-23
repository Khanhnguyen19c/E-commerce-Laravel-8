<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Payment;
use App\Models\ProductAttribute;
use App\Models\Products;
use App\Models\Sale;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            view()->composer('*',function($view) {
                $Cproduct_attribute = ProductAttribute::where('name','Color')->join('attribute_values','attribute_values.product_attribute_id','=','product_attributes.id')->get();
                $Sproduct_attribute = ProductAttribute::where('name','=','Size')->join('attribute_values','attribute_values.product_attribute_id','=','product_attributes.id')->get();
                $popular_products = Products::inRandomOrder()->limit(4)->get();
                $new_product_banner = HomeSlider::where('status',1)->where('type',0)->orderBy('created_at','DESC')->first();
                $brands = Brand::all();
                $sale = Sale::find(1);
                $categories = Category::all();
                $payments = Payment::all();
                $setting = Setting::find(1);
                $view->with('brands',$brands)->with('payments',$payments)->with('setting',$setting)->with('categories',$categories)->with('sale',$sale)->with('Cproduct_attribute',$Cproduct_attribute)->with('Sproduct_attribute',$Sproduct_attribute)->with('new_product_banner',$new_product_banner)->with('popular_products',$popular_products);
            });
    }
}
