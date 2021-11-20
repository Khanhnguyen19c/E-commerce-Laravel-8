<?php
  namespace App\Services;

  use Illuminate\Support\Facades\Gate;

class PermissionsCheckAccess{

     public function setGatePolicyAccess(){
         $this->defineGateCategory();
         $this->defineGateOrder();
         $this->defineGateBrand();
         $this->defineGateProducts();
         $this->defineGateProductAtrribute();
         $this->defineGateSlider();
         $this->defineGateFooter();
         $this->defineGateHomeCategory();
         $this->defineGatePayment();
         $this->defineGatePosts();
         $this->defineGateCoupon();
         $this->defineGateFeedback();
         $this->defineGateSale();
     }

      //category permission
     public function defineGateCategory(){
        Gate::define('category-list', 'App\\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\\Policies\CategoryPolicy@delete');
       }

        //order permission
     public function defineGateOrder(){
        Gate::define('order-list', 'App\\Policies\OrderPolicy@view');
        Gate::define('order-confirm', 'App\\Policies\OrderPolicy@update');
        Gate::define('order-details', 'App\\Policies\OrderPolicy@viewDetails');
        Gate::define('order-delete', 'App\\Policies\OrderPolicy@delete');
       }

         //brand permission
     public function defineGateBrand(){
        Gate::define('brand-list', 'App\\Policies\BrandPolicy@view');
        Gate::define('brand-add', 'App\\Policies\BrandPolicy@create');
        Gate::define('brand-edit', 'App\\Policies\BrandPolicy@update');
        Gate::define('brand-delete', 'App\\Policies\BrandPolicy@delete');
       }

          //products permission
     public function defineGateProducts(){
        Gate::define('products-list', 'App\\Policies\ProductsPolicy@view');
        Gate::define('products-add', 'App\\Policies\ProductsPolicy@create');
        Gate::define('products-edit', 'App\\Policies\ProductsPolicy@update');
        Gate::define('products-delete', 'App\\Policies\ProductsPolicy@delete');
       }

         //productAtrribute permission
     public function defineGateProductAtrribute(){
        Gate::define('productAtrribute-list', 'App\\Policies\ProductAtrributePolicy@view');
        Gate::define('productAtrribute-add', 'App\\Policies\ProductsPolicy@create');
        Gate::define('productAtrribute-edit', 'App\\Policies\ProductsPolicy@update');
        Gate::define('productAtrribute-delete', 'App\\Policies\ProductsPolicy@delete');
       }

       //slider permission
     public function defineGateSlider(){
        Gate::define('slider-list', 'App\\Policies\SliderPolicy@view');
        Gate::define('slider-add', 'App\\Policies\SliderPolicy@create');
        Gate::define('slider-edit', 'App\\Policies\SliderPolicy@update');
        Gate::define('slider-delete', 'App\\Policies\SliderPolicy@delete');
       }

       //footer permission
     public function defineGateFooter(){
        Gate::define('footer-list', 'App\\Policies\FooterPolicy@view');
        Gate::define('footer-edit', 'App\\Policies\FooterPolicy@update');
       }

        //homeCategory permission
     public function defineGateHomeCategory(){
        Gate::define('homeCategory-list', 'App\\Policies\HomeCategoryPolicy@view');
        Gate::define('homeCategory-edit', 'App\\Policies\HomeCategoryPolicy@update');
       }

         //payment permission
     public function defineGatePayment(){
        Gate::define('payment-list', 'App\\Policies\PaymentPolicy@view');
        Gate::define('payment-add', 'App\\Policies\PaymentPolicy@create');
        Gate::define('payment-edit', 'App\\Policies\PaymentPolicy@update');
        Gate::define('payment-delete', 'App\\Policies\PaymentPolicy@delete');
       }

         //posts permission
     public function defineGatePosts(){
        Gate::define('posts-list', 'App\\Policies\PostPolicy@view');
        Gate::define('posts-add', 'App\\Policies\PostPolicy@create');
        Gate::define('posts-edit', 'App\\Policies\PostPolicy@update');
        Gate::define('posts-delete', 'App\\Policies\PostPolicy@delete');
       }
        //coupon permission
     public function defineGateCoupon(){
        Gate::define('coupon-list', 'App\\Policies\CouponPolicy@view');
        Gate::define('coupon-add', 'App\\Policies\CouponPolicy@create');
        Gate::define('coupon-edit', 'App\\Policies\CouponPolicy@update');
        Gate::define('coupon-delete', 'App\\Policies\CouponPolicy@delete');
       }

        //feedback permission
     public function defineGateFeedback(){
        Gate::define('feedback-list', 'App\\Policies\ContactsPolicy@view');
       }

       //time sale  permission
       public function defineGateSale(){
        Gate::define('sale-list', 'App\\Policies\SalePolicy@view');
        Gate::define('sale-edit', 'App\\Policies\SalePolicy@update');
       }
  }
?>
