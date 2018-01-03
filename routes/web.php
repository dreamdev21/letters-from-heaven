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
App::register('Darryldecode\Cart\CartServiceProvider');

Route::get('/', function () {
    return view('site.index');
});
Route::get('/voice', function () {
    return view('site.voice');
});
Route::get('/shop', function () {
    return view('site.shop');
});
Route::get('/backend', function () {
    return redirect('admin/dashboard');
});


Route::get('/shop/email', 'site\ShopEmailController@index')->name('shop/email');
Route::post('/shop/email/{id}', 'site\ShopEmailController@edit')->name('shop/email/edit');
Route::post('/shop/email_detail/{id}', 'site\ShopEmailController@orderdelivery')->name('/shop/email_detail');
Route::get('/shop/email_detail/savedata', 'site\ShopEmailController@savedata');
Route::get('/shop/email/delivery', 'site\ShopEmailController@delivery');
Route::get('/shop/email/review', 'site\ShopEmailController@addcart')->name('/shop/email/addcart');
Route::get('/shop/email/saveemail', 'site\ShopEmailController@saveemail')->name('/shop/email/saveemail');
Route::get('/shop/email/updatetext', 'site\ShopEmailController@updatetext')->name('/shop/email/updatetext');
Route::get('/shop/orderedemail/updatetext', 'site\ShopEmailController@updateorderedtext')->name('/shop/email/updateorderedtext');
Route::get('/shop/email/edit/{id}', 'site\ShopEmailController@editcart')->name('/shop/email/editcart');

Route::get('/shop/flower', 'site\ShopFlowerController@index')->name('shop/flower');
Route::get('/shop/flower/{id}', 'site\ShopFlowerController@flower')->name('shop/flower/detail');

Route::get('/contact', 'site\ContactController@index')->name('contact');
Route::post('contact/save', 'site\ContactController@save')->name('contact/save');

Route::get('/tailorcontact', 'site\ContactController@tailorcontactindex')->name('tailorcontact');
Route::post('tailorcontact/save', 'site\ContactController@tailorcontactsave')->name('tailorcontact/save');


Route::resource('cart', 'site\CartController');
Route::delete('cart{id}', 'site\CartController@destroy');
Route::delete('emptyCart', 'site\CartController@emptyCart');

//email function //
Route::get('/emailconfirm', 'site\EmailConfirmController@index')->name('emailconfirm');
Route::get('/emailconfirm/month/{id}', 'site\EmailConfirmController@month')->name('emailconfirm/month');
Route::get('/emailconfirm/month6/{id}', 'site\EmailConfirmController@month6')->name('emailconfirm/month6');
Route::get('/emailconfirm/year/{id}', 'site\EmailConfirmController@year')->name('emailconfirm/year');
Route::get('/emailconfirm/orderchangedadminconfirm/{id}', 'site\EmailConfirmController@orderchangedadminconfirm')->name('emailconfirm/orderchangedadminconfirm');

Route::group(['middleware' => 'auth'], function(){

//    Route::get('/checkout{id}', 'site\CheckoutController@index')->name('/checkout');
    Route::any('/checkout{id}', 'site\CheckoutController@index')->name('/checkout');
    Route::post('/paywithpaypal', 'site\CheckoutController@paywithpaypal')->name('/paywithpaypal');
    Route::post('/paywithcreditcard', 'site\CheckoutController@paywithcreditcard')->name('/paywithcreditcard');
    Route::get('/paywithcreditcardprocess', 'site\CheckoutController@paywithcreditcardprocess')->name('/paywithcreditcardprocess');
    Route::get('/paypal/success', 'site\CheckoutController@success');
    Route::get('/paypal/cancel', 'site\CheckoutController@cancel');
    Route::get('/orderreview', 'site\CheckoutController@orderreview');
    Route::get('/savedraft', 'site\CheckoutController@savedraft');

    Route::post('/orderreviewwrite/{id}', 'HomeController@orderreviewwrite')->name('/orderreviewwrite');
    Route::get('/home/order/cancel/{id}', 'HomeController@cancelorder')->name('/home/order/cancel');
    Route::get('/home/orderededit/{id}', 'HomeController@editorder')->name('/home/order/edit');
    Route::get('/home/orderedrecedit/{id}', 'HomeController@editrecorder')->name('/home/orderrec/edit');
    Route::get('/home/editemail/reorder/{id}', 'HomeController@reordercreate')->name('/home/editemail/reorder');
    Route::get('/home/editemail/save/{id}', 'HomeController@editedemailsave')->name('/home/editemail/save');
    Route::get('/home/order/view/{id}', 'HomeController@vieworder')->name('/home/order/view');
    Route::get('/home/reorder/{id}', 'HomeController@reorder')->name('/home/reorder');
    Route::get('/home/email/edit/receipinfo/{id}', 'HomeController@updatereceipinfo')->name('/home/email/edit/receipinfo');
    Route::post('/home/paywithpaypalordered/{id}', 'site\CheckoutController@paywithpaypalordered')->name('/home/paywithpaypalordered');
    Route::post('/home/paywithcreditcardordered/{id}', 'site\CheckoutController@paywithcreditcardordered')->name('/home/paywithcreditcardordered');
    Route::get('/home/paywithcreditcardorderedprocess', 'site\CheckoutController@paywithcreditcardorderedprocess')->name('/home/paywithcreditcardorderedprocess');
    Route::get('/home/invoice/{id}', 'HomeController@invoice')->name('/home/invoice');
    Route::get('/home/invoice/pdf/{id}', 'HomeController@invoicepdf')->name('/home/invoice/pdf');
//    Route::get('/home/email/edit/orderreview/{id}', 'HomeController@createorder')->name('/home/email/edit/order');


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
{

    Route::get('/dashboard', 'admin\DashboardController@index')->name('dashboard');

    Route::get('/users', 'admin\UsersController@index')->name('users');
    Route::post('/users/update{id}', 'admin\UsersController@update')->name('users/update');
    Route::post('/users/delete/{id}', 'admin\UsersController@destroy')->name('users/delete');
    Route::post('/users/save', 'admin\UsersController@save')->name('users/save');

    Route::get('email/template', 'admin\EmailController@template')->name('email/template');
    Route::post('email/template/save', 'admin\EmailController@save')->name('email/template/save');
    Route::post('email/template/update{id}', 'admin\EmailController@update')->name('email/template/update');
    Route::post('email/template/delete/{id}', 'admin\EmailController@destroy')->name('email/template/delete');

    Route::get('email/deletebox', 'admin\EmailController@deletebox')->name('email/deletebox');
    Route::get('email/draft', 'admin\EmailController@draft')->name('email/draft');

    Route::get('order/email/inbox', 'admin\OrdersController@emailinbox')->name('order/email/inbox');
    Route::get('order/email/sent', 'admin\OrdersController@emailsent')->name('order/email/sent');
    Route::get('order/email/draft', 'admin\OrdersController@emaildraft')->name('order/email/draft');
    Route::get('order/email/goprint/{id}', 'admin\OrdersController@emailgoprint')->name('order/email/goprint');


    Route::get('flower/template', 'admin\FlowerTemplateController@template')->name('flower/template');
    Route::post('flower/template/save', 'admin\FlowerTemplateController@save')->name('flower/template/save');
    Route::post('flower/template/update{id}', 'admin\FlowerTemplateController@update')->name('flower/template/update');
    Route::post('flower/template/delete/{id}', 'admin\FlowerTemplateController@destroy')->name('flower/template/delete');
    Route::get('flower/deletebox', 'admin\FlowerTemplateController@deletebox')->name('flower/deletebox');

    Route::get('order/flower/sent', 'admin\OrdersController@flowersent')->name('order/flower/sent');
    Route::get('order/flower/standby', 'admin\OrdersController@flowerstandby')->name('order/flower/standby');
    Route::get('order/flower/draft', 'admin\OrdersController@flowerdraft')->name('order/flower/draft');

    Route::post('order/flower/update/{id}', 'admin\OrdersController@flowerupdate')->name('order/flower/update');
    Route::post('order/flower/delete/{id}', 'admin\OrdersController@delete')->name('order/flower/delete');

    Route::get('flower/sent', 'admin\FlowerController@sent')->name('flower/sent');
    Route::get('flower/standby', 'admin\FlowerController@standby')->name('flower/standby');
    Route::get('flower/draft', 'admin\FlowerTemplateController@draft')->name('flower/draft');

    Route::get('/contact', 'admin\ContactController@index')->name('contact');
    Route::post('/contact/update{id}', 'admin\ContactController@update')->name('contact/update');
    Route::post('/contact/delete/{id}', 'admin\ContactController@destroy')->name('contact/delete');



    Route::get('/logout', 'Auth\AdminController@logout')->name('admin/logout');
});
