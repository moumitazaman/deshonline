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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'FrontController@index')->name('index');
 
Auth::routes();
/*Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');*/





//Route::get('/admin/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/all/products', 'CartController@shop')->name('shop.index');
Route::get('/clear', 'CheckoutController@Cartclear');

Route::get('/cart', 'CartController@cart')->name('cart.index');
Route::post('/add', 'CartController@add')->name('cart.add');
Route::post('/compare', 'FrontController@compare')->name('cart.compare');
Route::get('/getcompare', 'FrontController@display')->name('front.display');
Route::post('/details', 'FrontController@details')->name('cart.details');
Route::get('/category/{id}', 'FrontController@show')->name('category.show');
Route::get('/brand/{id}', 'FrontController@showBrand')->name('brand.showBrand');
Route::get('/single_product/{id}', 'FrontProductController@singleProduct')->name('single.singleProduct');

Route::get('/subcategory/{id}', 'FrontController@showSub')->name('subcategory.show');
Route::post('/search', 'FrontController@searchPro')->name('show.search');
Route::post('/pricefilter', 'FrontProductController@priceFilter')->name('price.filter');






Route::post('/update', 'CartController@update')->name('cart.update');
Route::post('/remove', 'CartController@removeItem')->name('cart.remove');
Route::post('/clear', 'CartController@clear')->name('cart.clear');
//Route::get('/add-to-cart/{id}', 'CartController@addToCart');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('/checkout/order', 'CheckoutController@placeOrder')->name('checkout.place.order');
});


Route::get('/admin', 'Backend\Admin\LoginController@showLoginForm')->name('adminlogin');
Route::get('/adminregisterform', 'Backend\Admin\RegisterController@showRegisterForm')->name('admin.registerform');
Route::post('/adminregister', 'Backend\Admin\RegisterController@create')->name('admin.register');


Route::post('/adminlogin', 'Backend\Admin\LoginController@login')->name('adminlogin.post');
Route::get('/adminlogout', 'Backend\Admin\LoginController@logout')->name('adminlogout');



    

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as'=>'backend.', 'prefix'=>'admin', 'namespace'=>'Backend', 'middleware'=>['auth']], function(){

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/create', 'AdminController@adminCreate')->name('admin.create');
    Route::post('/add', 'AdminController@adminAdd')->name('add.admin');
    Route::get('/approve{id}','OrderController@approve')->name('order.approve');


    Route::get('/roles', 'DashboardController@index')->name('roles');
    Route::post('/device', 'DashboardController@deviceview')->name('backend.device');
    Route::get('/getdevice', 'DashboardtController@devicedisplay');
    Route::get('/stock', 'DashboardController@stockDisplay')->name('stock');
    Route::get('/customer', 'DashboardController@customerDisplay')->name('customer');
    Route::get('/customer/view/{id}', 'DashboardController@customerView')->name('customer.view');
    Route::get('/seller', 'AdminController@sellerDisplay')->name('seller.index');
    Route::get('/seller/create', 'AdminController@sellerCreate')->name('seller.create');
    Route::post('/seller/create', 'AdminController@sellerUpdate')->name('seller.update');

    Route::get('/seller/addproduct', 'OrderController@create')->name('sellerproduct.show');

    Route::post('/sellerproduct', 'OrderController@store')->name('sellerproduct.store');

    Route::get('/seller/view/{id}', 'AdminController@sellerView')->name('seller.view');
    Route::get('/adminlist', 'AdminController@index')->name('adminlist');
    Route::get('/adminlist/view/{id}', 'AdminController@adminView')->name('admin.view');
    Route::get('/seller/permission/{id}', 'AdminController@adminPermission')->name('admin.permission');
    Route::post('/seller/permission/{id}', 'AdminController@adminUpdate')->name('permission.update');
    Route::get('/team', 'DashboardController@teamDisplay')->name('team.index');
    Route::post('/team/delete/{id}', 'DashboardController@destroyTeam')->name('team.destroy');
        Route::get('/customer/permission/{id}', 'AdminController@customerPermissionView')->name('customer.permission');
    Route::post('/customer/permission/{id}', 'AdminController@customerPermission')->name('customer.perm');


    Route::get('/password', 'DashboardController@passwordShow')->name('password.show');


    Route::post('/password/{id}', 'DashboardController@passwordUpdate')->name('password.update');


    Route::get('/tree/{id}', 'TreeController@treeDisplay')->name('tree.index');
    Route::get('/profile/{id}', 'AdminController@showProfile')->name('profile.view');
    Route::post('/updateprofile/{id}', 'AdminController@updateProfile')->name('profile.update');
    Route::get('/team/view/{id}', 'AdminController@teamView')->name('team.view');
        Route::get('/pcnlist', 'AdminController@pcnList')->name('pcn.list');

    Route::get('/pcn/view/{id}', 'AdminController@pcnView')->name('pcn.view');

//Route::get('/treeview-test', 'DashboardController@treeViewTest')->name('tree.view.test');
    Route::get('/treeview', 'TreeController@treeView')->name('tree.view');
        Route::get('/treelist', 'DashboardController@treeList')->name('tree.list');
        Route::get('/treelistview', 'DashboardController@treeListzero')->name('tree.listv');
 Route::get('/treelevel/{count}/{no?}', 'DashboardController@treeLevel')->name('tree.level');
 
    Route::get('/myorder/{id}', 'DashboardController@orderDisplay')->name('order.myorder');

 Route::get('/royality_distribute', 'FundController@royalDistribute')->name('royality.distribute');
 
  Route::get('/msp_distribute', 'FundController@mspDistribute')->name('msp.distribute');


    Route::get('/apply/msp', 'MSPController@applyMSP')->name('apply.msp');

    Route::get('/cashoutview', 'CashOutController@cashView')->name('cash.view');


    Route::get('product/getsubcategory/{id}', 'SubcategoryController@show');


    Route::resource('cashout', 'CashOutController');

    Route::resource('product', 'ProductController');
    Route::resource('category', 'CategoryController');
    Route::resource('subcategory', 'SubcategoryController');

    Route::resource('brand', 'BrandController');
   Route::resource('attributes', 'AttributesController');
   Route::resource('attributesvalues', 'AttributeValuesController');

   Route::resource('order', 'OrderController');
   Route::resource('role', 'RoleController');
   Route::resource('settings', 'SettingsController');
   Route::resource('sales', 'SalesController');
    Route::resource('funds', 'FundController');
   Route::resource('msp', 'MSPController');



Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
    

});
