<?php

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

Route::get('/', 'IndexController@index');

Route::get('/404','IndexController@PageError'); 


Route::match(['get','post'],'/admin','AdminController@login');
Route::match(['get','post'],'/admin_register','AdminController@register');
Route::get('/logout', 'AdminController@logout');

Route::group(['middleware' => ['adminlogin']],function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-pwd','AdminController@chkPassword');
    Route::match(['get','post'],'admin/update-pwd','AdminController@updatePassword');
    
    
    // Categories Routes (Admin)
    Route::match(['get','post'],'/admin/add-category','CategoryController@addcategory');
    Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editcategory');
    Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deletecategory');
    Route::get('/admin/view-categories','CategoryController@viewCategories');
    
    // Product Routes (Admin)
    Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
    Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
    Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');
    Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
    Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteAltImage');
    Route::get('/admin/view-products','ProductsController@viewProduct');

    // Product Attributes Routes (Admin)
    Route::match(['get','post'],'/admin/add-attributes/{id}','ProductsController@addAttributes');
    Route::match(['get','post'],'/admin/edit-attributes/{id}','ProductsController@editAttributes');
    Route::match(['get','post'],'/admin/add-images/{id}','ProductsController@addImages');
    Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttribute');

    // Coupon Route
    Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
    Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
    Route::get('admin/view-coupons','CouponsController@viewCoupons');
    Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');

    // Admin Banner Route
    Route::match(['get','post'],'/admin/add-banner','BannersController@addBanner');
    Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');
    Route::get('admin/view-banners','BannersController@viewBanners');
    Route::get('/admin/delete-banner/{id}','BannersController@deleteBanner');

    // Admin Order Route
    Route :: get ('/admin/view-orders', 'ProductsController@viewOrders');

    // Admin Order Details Route
    Route :: get ('/admin/view-orders/{id}', 'ProductsController@viewOrderDetails');
    // Order Invoice
    Route::get('/admin/view-order-invoice/{id}','ProductsController@viewOrderInvoice');  
    
    // Update Order Status
    Route::post('/admin/update-order-status','ProductsController@updateOrderStatus'); 

    // Admin Users Route
    Route::get('/admin/view-users','UsersController@viewUsers');

    // Add CMS Route
    Route::match(['get','post'],'/admin/add-cms-page','CmsController@addCmsPage');

    // View CMS Pages
    Route::get('/admin/view-cms-pages','CmsController@viewCmsPages'); 

    // Edit CMS Page
    Route::match(['get','post'],'/admin/edit-cms-page/{id}','CmsController@editCmsPage');

    // Delete CMS Route
    Route::get('/admin/delete-cms-page/{id}','CmsController@deleteCmsPage'); 


});
Auth::routes();



// Category Detail Page
Route::get('/products/{url}', 'ProductsController@products');

// product Detail Page
Route::get('/product/{id}', 'ProductsController@product');

// Add to Cart Route
Route::match(['get','post'],'/add-cart','ProductsController@addtocart');

// Add to Cart Route
Route::match(['get','post'],'/cart','ProductsController@cartPage');

// Get Product Attribute Price
Route::get('/get_product_price', 'ProductsController@getProductPrice');

// Delete Product from Cart page;

Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct');

// Update  Product Quantity in  Cart;

Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');

// Search Products
Route::post('/search-products','ProductsController@searchProducts');
// Apple Coupon 
Route::post('/cart/apply-coupon','ProductsController@applyCoupon');

// Admin Users Route
Route::get('/admin/view-users','UsersController@viewUsers');

// Route Login / Register
Route::get('/login-register','UsersController@UserLoginRegister');

// Forgot Password
Route :: match (['get', 'post'], '/forgot-password', 'UsersController@forgot_password');


// User  Rigister From Submit
Route::post('/user-register','UsersController@register');

// User  Login From Submit
Route::post('/user-login','UsersController@login');

// All Routes After Login
Route::group(['middleware' => ['frontlogin']],function(){

    // user Acount Page
    Route::match(['get','post'],'account','UsersController@account');

    // Check User Cuurent Password
    Route::post('/check-user-pwd','UsersController@chkUserPassword');

    // Update User Password
    Route::post('/update-user-pwd','UsersController@updatePassword');

    // check Out Page
    Route::match(['get','post'],'checkout','ProductsController@checkout');

    // Order Review page
    Route::match(['get','post'],'order-review','ProductsController@orderReview');
    
    //Place Order
    Route::match(['get','post'],'/place-order','ProductsController@placeOrder');

    // Thanks Page
    Route::get('/thanks','ProductsController@thanks');

    // Thanks Page
    Route::get('/paypal','ProductsController@paypal');
    
    // Users Orders Page
    Route::get('/orders','ProductsController@userOrders');

    // Users Ordered Product Page
    Route::get('/orders/{id}','ProductsController@userOrderDetails');

    // Paypal Thanks Page
    Route::get('/paypal/thanks','ProductsController@thanksPaypal');

   // Paypal Cancel Page
    Route::get('/paypal/cancel','ProductsController@cancelPaypal');

}); 


// Check if User Already exists
Route::match(['GET','POST'],'/check-email','UsersController@CheckEmail');
 
// User logout

Route::get('/user-logout','UsersController@logout'); 

// Confirm Account
Route::match(['GET','POST'],'/confirm/{code}','UsersController@confirmAccount');



// Display Contact Page
Route::match(['GET','POST'],'/page/contact','CmsController@contact');
// Display CMS Page
Route::match(['get','post'],'/page/{url}','CmsController@cmsPage');
