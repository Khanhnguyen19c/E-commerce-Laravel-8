<?php

use App\Http\Controllers\AdminPermissionsController;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Livewire\AboutComponent;
use App\Http\Livewire\Admin\AdmimeditRoleComponent;
use App\Http\Livewire\Admin\AdminAddAttributeComponent;
use App\Http\Livewire\Admin\AdminAddBrandComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminaddComponent;
use App\Http\Livewire\Admin\AdminAddCouponComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminaddPaymentComponent;
use App\Http\Livewire\Admin\AdminaddPostComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminaddRolesComponent;
use App\Http\Livewire\Admin\AdminAttributeComponent;
use App\Http\Livewire\Admin\AdminBrandComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Livewire\Admin\AdminCouponsComponent;
use App\Http\Livewire\Admin\AdminEditAttributeComponent;
use App\Http\Livewire\Admin\AdminEditBrandComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdmineditComponent;
use App\Http\Livewire\Admin\AdminEditCouponComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdmineditPaymentComponent;
use App\Http\Livewire\Admin\AdmineditPostComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminlistComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminPaymentComponent;
use App\Http\Livewire\Admin\AdminPermissonsConponent;
use App\Http\Livewire\Admin\AdminPostComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminRolesComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\Admin\AdminSettingComponent;
use App\Http\Livewire\BrandComponent;
use App\Http\Livewire\CategoriesPostComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\NotificationDemo;
use App\Http\Livewire\PostComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\TopProductOnSalesComponent;
use App\Http\Livewire\TopProductOnWeekComponent;
use App\Http\Livewire\TopProductsReviewComponent;
use App\Http\Livewire\TopSellingProductsComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;
use App\Http\Livewire\User\UsereditProfileComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserOrdersDetailsComponent;
use App\Http\Livewire\User\UserProfileComponent;
use App\Http\Livewire\User\UserReviewComponent;
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

//change langue
Route::get('lang/{loacale}', function ($locale) {
    if(! in_array($locale, ['vn','en'] )) {
        abort(404);
    }
    session()->put('locale',$locale);
    return Redirect()->back();
});
Route::get('/home', HomeComponent::class)->name('home');
Route::get('/', HomeComponent::class);

Route::get('/shop', ShopComponent::class)->name('shop');

Route::get('/cart', CartComponent::class)->name('product.cart');

Route::get('/checkout', CheckoutComponent::class)->name('checkout');

Route::get('/product-category/{category_slug}/{scategory_slug?}',CategoryComponent::class)->name('product.category');

Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');

route::get('/search',SearchComponent::class)->name('product.seach');

route::get('/wishlist',WishlistComponent::class)->name('product.wishlist');

route::get('thank-you',ThankyouComponent::class)->name('thankyou');

route::get('contact-us',ContactComponent::class)->name('contact');

route::get('about-us',AboutComponent::class)->name('about');

route::get('top-products-weekend',TopProductOnWeekComponent::class)->name('products.topOnweek');
route::get('top-products-sales',TopProductOnSalesComponent::class)->name('products.topOnsales');
route::get('top-products-selling',TopSellingProductsComponent::class)->name('products.topSelling');
route::get('top-products-review',TopProductsReviewComponent::class)->name('products.topReview');

route::get('category-post',CategoriesPostComponent::class)->name('categorypost');
route::get('post/{post_slug}',PostComponent::class)->name('post');

route::get('products/brand/{brand_slug}',BrandComponent::class)->name('product.brand');

    Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
    Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);
    Route::get('auth/facebook', [SocialController::class, 'redirectToFacebook']);
    Route::get('auth/facebook/callback', [SocialController::class, 'handleFacebookCallback']);

    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
// for user or customer
Route::middleware(['auth:sanctum','verified'])->group(function(){
    route::get('user/dashboard',UserDashboardComponent::class)->name('user.dashboard');

    //user Orders
    route::get('/user/orders',UserOrdersComponent::class)->name('user.orders');
    route::get('/user/orders/{order_id}',UserOrdersDetailsComponent::class)->name('user.orderdetails');

    //user reviews
    route::get('/user/review/{order_item_id}',UserReviewComponent::class)->name('user.review');

    //user change password
    route::get('/user/change-password',UserChangePasswordComponent::class)->name('user.changepassword');

    //user profile
    route::get('/user/profile',UserProfileComponent::class)->name('user.profile');

    //user update profile
    route::get('/user/profile/edit',UsereditProfileComponent::class)->name('user.editprofile');

});
//for admin
Route::middleware(['auth:sanctum','verified','authAdmin'])->group(function(){
    route::get('admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');

     //category
    route::get('/admin/categories',AdminCategoryComponent::class)->name('admin.categories')->middleware('can:category-list');

    route::get('/admin/categories/add',AdminAddCategoryComponent::class)->name('admin.addcategories')->middleware('can:category-add');
    route::get('/admin/categories/edit/{category_slug}/{scategory_slug?}',AdminEditCategoryComponent::class)->name('admin.editcategories')->middleware('can:category-edit');

    //product
    route::get('/admin/products',AdminProductComponent::class)->name('admin.products')->middleware('can:products-list');
    route::get('/admin/products/add',AdminAddProductComponent::class)->name('admin.addproduct')->middleware('can:products-add');
    route::get('/admin/products/edit/{product_slug}',AdminEditProductComponent::class)->name('admin.editproduct');

    //excel
    route::post('/admin/products/Import',[AdminProductComponent::class,'import_csv'])->name('admin.import-product');
    route::post('/admin/products/EXport',[AdminProductComponent::class,'export_csv'])->name('admin.export-product');

    //HomeSliders
    route::get('/admin/slider',AdminHomeSliderComponent::class)->name('admin.homeslider')->middleware('can:slider-list');
    route::get('/admin/slider/add',AdminAddHomeSliderComponent::class)->name('admin.addhomeslider')->middleware('can:slider-add');
    route::get('/admin/slider/edit/{slider_id}',AdminEditHomeSliderComponent::class)->name('admin.edithomeslider');

    //HomeCategory
    route::get('adin/home-categories',AdminHomeCategoryComponent::class)->name('admin.homecategories')->middleware('can:homeCategory-list');

    //Sale
    route::get('/admin/sale',AdminSaleComponent::class)->name('admin.sale')->middleware('can:sale-list');

    //Coupons
    route::get('/admin/coupons',AdminCouponsComponent::class)->name('admin.coupons')->middleware('can:coupon-list');
    route::get('admin/coupon/add',AdminAddCouponComponent::class)->name('admin.addcoupon')->middleware('can:coupon-add');
    route::get('admin/coupon/edit/{coupon_id}',AdminEditCouponComponent::class)->name('admin.editcoupon');

    //Oders
    route::get('admin/orders',AdminOrderComponent::class)->name('admin.orders')->middleware('can:order-list');
    route::get('admin/orders/{order_id}',AdminOrderDetailsComponent::class)->name('admin.orderdetails')->middleware('can:order-details');

    //contact
    route::get('admin/contact-us',AdminContactComponent::class)->name('admin.contact')->middleware('can:feedback-list');

    //Setting
    route::get('admin/settings',AdminSettingComponent::class)->name('admin.settings')->middleware('can:footer-list');

    //product attribute
    route::get('admin/attributes',AdminAttributeComponent::class)->name('admin.attributes')->middleware('can:productAtrribute-list');
    route::get('admin/attributes/add',AdminAddAttributeComponent::class)->name('admin.add_attribute')->middleware('can:productAtrribute-add');
    route::get('admin/attributes/edit/{attribute_id}',AdminEditAttributeComponent::class)->name('admin.edit_attribute')->middleware('can:productAtrribute-edit');

    //icon payments
    route::get('admin/payments',AdminPaymentComponent::class)->name('admin.payments')->middleware('can:payment-list');
    route::get('admin/payment/add',AdminaddPaymentComponent::class)->name('admin.addpayment')->middleware('can:payment-add');
    route::get('admin/payment/edit/{id}',AdmineditPaymentComponent::class)->name('admin.editpayment')->middleware('can:payment-edit');

    //brand product
    route::get('/admin/brands',AdminBrandComponent::class)->name('admin.brands')->middleware('can:brand-list');
    route::get('/admin/brand/add',AdminAddBrandComponent::class)->name('admin.addbrand')->middleware('can:brand-add');
    route::get('/admin/brand/edit/{brand_id}',AdminEditBrandComponent::class)->name('admin.editbrand')->middleware('can:brand-edit');

    //Post
    route::get('/admin/posts',AdminPostComponent::class)->name('admin.posts')->middleware('can:posts-list');
    route::get('/admin/post/add',AdminaddPostComponent::class)->name('admin.addpost')->middleware('can:posts-add');
    route::get('/admin/post/edit/{post_id}',AdmineditPostComponent::class)->name('admin.editpost')->middleware('can:posts-edit');

    Route::middleware(['auth:sanctum','verified','AuthSAdmin'])->group(function(){
    //list admin
    route::get('admin/list',AdminlistComponent::class)->name('admin.list');
    route::get('admin/list/add',AdminaddComponent::class)->name('admin.add');
    route::get('admin/list/edit/{id}',AdmineditComponent::class)->name('admin.edit');

    //roles
    route::get('admin/roles',AdminRolesComponent::class)->name('admin.roles');
    route::get('admin/role/add',AdminaddRolesComponent::class)->name('admin.addrole');
    route::post('admin/role/store',[AdminaddRolesComponent::class,'addRole'])->name('admin.addroles');
    route::get('admin/role/edit/{role_id}',AdmimeditRoleComponent::class)->name('admin.editrole');
    route::post('admin/role/update',[AdmimeditRoleComponent::class,'updateRole'])->name('admin.updateRole');

    //permissions
    route::get('admin/permissions',AdminPermissonsConponent::class)->name('admin.permissions');
    route::post('admin/permissions/add',[AdminPermissionsController::class,'store'])->name('admin.store');
});
    });

