<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCouponComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminCouponsComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCouponComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\NotificationDemo;
use App\Http\Livewire\WishlistComponent;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/home', HomeComponent::class)->name('home');
Route::get('/', HomeComponent::class);

Route::get('/shop', ShopComponent::class)->name('shop');

Route::get('/cart', CartComponent::class)->name('product.cart');

Route::get('/checkout', CheckoutComponent::class)->name('checkout');

Route::get('/product-category/{category_slug}',CategoryComponent::class)->name('product.category');

Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');

route::get('/search',SearchComponent::class)->name('product.seach');

route::get('/wishlist',WishlistComponent::class)->name('product.wishlist');

    Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
    Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);
    Route::get('auth/facebook', [SocialController::class, 'redirectToFacebook']);
    Route::get('auth/facebook/callback', [SocialController::class, 'handleFacebookCallback']);
// for user or customer
    Route::middleware(['auth:sanctum','verified'])->group(function(){
    route::get('user/dashboard',UserDashboardComponent::class)->name('user.dashboard');

    });

 //for admin
Route::middleware(['auth:sanctum','verified','authAdmin'])->group(function(){
    route::get('admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');

    //category
    route::get('/admin/categories',AdminCategoryComponent::class)->name('admin.categories');
    route::get('/admin/categories/add',AdminAddCategoryComponent::class)->name('admin.addcategories');
    route::get('/admin/categories/edit/{category_slug}',AdminEditCategoryComponent::class)->name('admin.editcategories');

    //product
    route::get('/admin/products',AdminProductComponent::class)->name('admin.products');
    route::get('/admin/products/add',AdminAddProductComponent::class)->name('admin.addproduct');
    route::get('/admin/products/edit/{product_slug}',AdminEditProductComponent::class)->name('admin.editproduct');

    //HomeSliders
    route::get('/admin/slider',AdminHomeSliderComponent::class)->name('admin.homeslider');
    route::get('/admin/slider/add',AdminAddHomeSliderComponent::class)->name('admin.addhomeslider');
    route::get('/admin/slider/edit/{slider_id}',AdminEditHomeSliderComponent::class)->name('admin.edithomeslider');

    //HomeCategory
    route::get('adin/home-categories',AdminHomeCategoryComponent::class)->name('admin.homecategories');

    //Sale
    route::get('/admin/sale',AdminSaleComponent::class)->name('admin.sale');

    //Coupons
    route::get('/admin/coupons',AdminCouponsComponent::class)->name('admin.coupons');
    route::get('admin/coupon/add',AdminAddCouponComponent::class)->name('admin.addcoupon');
    route::get('admin/coupon/edit/{coupon_id}',AdminEditCouponComponent::class)->name('admin.editcoupon');
});
