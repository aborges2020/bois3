<?php

use Illuminate\Support\Facades\Route;

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

// Route to switch between languages
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->namespace('Admin')->group(function() 
{
    // Admin login and logout
    Route::get('/','LoginController@showLoginForm')->name('admin');
    Route::post('/login', 'LoginController@login')->name('admin.login');
    Route::post('/logout', 'LoginController@logout')->name('admin.logout');	
       
    // Categories
    Route::post('categories/upload', 'Categories\CategoriesController@uploadImage')->name('admin.categories.upload');
    Route::post('categories/update-active', 'Categories\CategoriesController@updateActive')->name('admin.categories.update.active');
    Route::post('categories/update-seo', 'Categories\CategoriesController@updateSeo')->name('admin.categories.update.seo');
    Route::post('categories/update-details', 'Categories\CategoriesController@updateDetails')->name('admin.categories.updateDetails');
    Route::get('categories/destroy/{id}', 'Categories\CategoriesController@destroy')->name('admin.categories.destroy');
    Route::resource('/categories', 'Categories\CategoriesController');
    
   	// Clients
    Route::post('clients/update', 'Clients\ClientsController@update')->name('admin.clients.update');
    Route::get('clients/destroy/{id}', 'Clients\ClientsController@destroy');
    Route::resource('/clients', 'Clients\ClientsController');

    // Config
    Route::resource('/config', 'Config\ConfigController');

    // Coupons
    Route::post('/coupons/update', 'Coupons\CouponsController@update');
    Route::get('/coupons/destroy/{id}', 'Coupons\CouponsController@destroy');
    Route::resource('/coupons', 'Coupons\CouponsController');

    // Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

    // Employees
    Route::post('employees/update', 'Employees\EmployeesController@update');
    Route::get('employees/destroy/{id}', 'Employees\EmployeesController@destroy');
    Route::resource('/employees', 'Employees\EmployeesController');
    
    // Employee Positions (Functions)
    Route::get('/employee-positions/list', 'Employees\EmployeePositionsController@list');
    Route::post('employee-positions/update', 'Employees\EmployeePositionsController@update');
    Route::get('employee-positions/destroy/{id}', 'Employees\EmployeePositionsController@destroy');
    Route::resource('/employee-positions', 'Employees\EmployeePositionsController');
    
    // Installment status
    Route::post('/installment-status/update', 'InstallmentStatus\InstallmentStatusController@update');
    Route::get('/installment-status/destroy/{id}', 'InstallmentStatus\InstallmentStatusController@destroy');
    Route::resource('/installment-status', 'InstallmentStatus\InstallmentStatusController');

    // MyProfile
    // Route::get('/my-profile', 'MyProfileController@index')->name('my-profile');

    // Orders
    Route::resource('/orders', 'Orders\OrdersController');
        
    // Payment Methods
    Route::post('/payment-methods/update', 'PaymentMethods\PaymentMethodsController@update');
    Route::get('/payment-methods/destroy/{id}', 'PaymentMethods\PaymentMethodsController@destroy');
    Route::resource('/payment-methods', 'PaymentMethods\PaymentMethodsController');

    // Payment Status
    Route::post('/payment-status/update', 'PaymentStatus\PaymentStatusController@update');
    Route::get('/payment-status/destroy/{id}', 'PaymentStatus\PaymentStatusController@destroy');
    Route::resource('/payment-status', 'PaymentStatus\PaymentStatusController');

    // Point of sales
    Route::post('/pos', 'PointOfSales\PointOfSalesController@update');
    Route::get('/pos/destroy/{id}', 'PointOfSales\PointOfSalesController@destroy');
    Route::resource('/pos', 'PointOfSales\PointOfSalesController');

    // Products
    // Route::post('products/update', 'Products\ProductsController@update');
    Route::post('products/upload', 'Products\ProductsController@uploadImage');
    Route::post('products/upload-pi', 'Products\ProductsController@uploadProductImage');
    Route::post('products/update-active', 'Products\ProductsController@updateActive');
    Route::post('products/update-details', 'Products\ProductsController@updateDetails');
    Route::post('products/update-seo', 'Products\ProductsController@updateSeo');
    Route::get('products/destroy/{id}', 'Products\ProductsController@destroy');
    Route::delete('products/delete/{id}', 'Products\ProductsController@deleteImg');
   
    Route::resource('/products', 'Products\ProductsController');

    // Roles
    Route::get('/roles/list', 'Roles\RolesController@list');
    Route::post('roles/update', 'Roles\RolesController@update');
    Route::get('roles/destroy/{id}', 'Roles\RolesController@destroy');
    Route::resource('/roles', 'Roles\RolesController');
    
    // Shipping Methods
    Route::post('/shipping-methods/update', 'ShippingMethods\ShippingMethodsController@update');
    Route::get('/shipping-methods/destroy/{id}', 'ShippingMethods\ShippingMethodsController@destroy');
    Route::resource('/shipping-methods', 'ShippingMethods\ShippingMethodsController');

    // Stores
    Route::post('/stores/update', 'Stores\StoresController@update');
    Route::get('/stores/destroy/{id}', 'Stores\StoresController@destroy');
    Route::resource('/stores', 'Stores\StoresController');
    
    // Suppliers
    Route::post('/suppliers/update', 'Suppliers\SuppliersController@update');
    Route::get('/suppliers/destroy/{id}', 'Suppliers\SuppliersController@destroy');
    Route::resource('/suppliers', 'Suppliers\SuppliersController');

    // Wish List
    Route::post('/wish-list/update', 'WishList\WishListController@update');
    Route::get('/wish-list/destroy/{id}', 'WishList\WishListController@destroy');
    Route::resource('/wish-list', 'WishList\WishListController');
       
    //...
});

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
*/
Route::namespace('Site')->group(function()
{   
    // Home
    //Route::get('/', 'Home\HomeController@index')->name('index');

    // FAQ
    Route::get('/faq', 'Faq\FaqController@index')->name('faq');
    // About
    Route::get('/about', 'About\AboutController@index')->name('about');
    // Contact
    Route::get('/contact', 'Contact\ContactController@index')->name('contact');
    // Auth routes
    Auth::routes();
    // My Account
    Route::prefix('my-account')->namespace('MyAccount')->group(function() 
    {
        Route::get('/', 'MyAccountController@index')->name('my.account');    
        // MyProfile
        Route::get ('/my-profile', 'MyProfileController@index')->name('my.profile');
        Route::resource('/profile', 'ClientController')->only(['index', 'password']);
        Route::put('/profile', 'ClientController@update')->name('profile.update');
        Route::put('/password', 'ClientController@password')->name('myAccount.password');
        Route::resource('/address', 'AddressController')->only(['index', 'show', 'store', 'update', 'destroy']);
        Route::resource('/telephone', 'TelephoneController')->only(['index', 'show', 'store', 'update', 'destroy']);    
    });

    // My Orders
    Route::get('/my-orders', 'MyOrders\MyOrdersController@index')->name('my.orders');
    Route::get('/my-orders/{id}/details', 'MyOrders\MyOrdersController@details')->name('my.orders.details');
    
    // Cart
    Route::get('cart/', 'Cart\CartController@index')->name('cart');
    Route::patch('cart/update', 'Cart\CartController@updateCart');
    Route::delete('cart/remove', 'Cart\CartController@removeProduct');
    Route::get('cart/clear', 'Cart\CartController@clearCart');
    Route::get('cart/add/{id}', 'Cart\CartController@addProduct');
    Route::get('cart/total', 'Cart\CartController@getCartTotal');

    // Checkout
    Route::get('/checkout', 'Checkout\CheckoutController@index')->name('checkout'); //
    Route::post('/checkout', 'Checkout\CheckoutController@checkout')->name('checkout'); //
    
    // Coupom
    //Route::get ('shop/coupom', 'Coupom\CoupomController@index')->name('cart.coupom'); //
    Route::get('/coupom', 'Coupom\CoupomController@verifiy')->name('cart.coupom.verifiy'); //

    //Menu
    Route::get('/menuCategories', 'Menu\MenuController@getCategories')->name('menu.categories');
   
    // Ajax Routes Menu Buy Here ???
    Route::get('shop/categories', 'Categories\CategoriesController@index')->name('shop.allCategories');
    Route::get('shop/products', 'Products\ProductsController@index')->name('shop.allProducts');
    
    // Menu Buy Here
    Route::get('categories', 'Shop\ShopController@allCategories')->name('allCategories');
    Route::get('products', 'Shop\ShopController@allProducts')->name('allProducts');
    Route::get('/', 'Shop\ShopController@allProducts')->name('allProducts');   

    // Category and CategoryProduct
    Route::get('{category}/', 'Shop\ShopController@productsByCategory')->name('category.allProducts');
    Route::get('{category}/{product}', 'Shop\ShopController@product')->name('category.product');
});

