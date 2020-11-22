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
//front-end
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::post('/tim-kiem','HomeController@search');
Route::post('/autocomplete-ajax','HomeController@autocomplete_ajax');
//Thông tin cá nhân
Route::get('/information','HomeController@information');
Route::get('/update-information/{customer_id}','HomeController@update_information');
Route::post('/save-information/{customer_id}','HomeController@save_information');
//Liên hệ contact
Route::get('/lien-he','HomeController@lien_he');
Route::post('/insert-contact','HomeController@insert_contact');
//send Mail
Route::get('/send-mail','HomeController@send_mail');
//
//Login facebook
Route::get('/login-facebook','AdminController@login_facebook');
Route::get('/trang-chu/callback','AdminController@callback_facebook');
//Login Google
Route::get('/login-google','AdminController@login_google');
Route::get('/google/callback','AdminController@callback_google');

//Danh muc san pham trang chu
// Route::get('danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home');
Route::get('/danh-muc/{slug_category_product}','CategoryProduct@show_category_home');
Route::get('thuong-hieu-san-pham/{brand_id}','BrandProduct@show_brand_home');
Route::get('chi-tiet-san-pham/{product_id}','ProductController@details_product');
Route::get('tag/{product_tag}','ProductController@tag');

Route::post('/quickview','ProductController@quickview');
Route::post('/load-comment','ProductController@load_comment');
Route::post('/send-comment','ProductController@send_comment');
//backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/admin-logout','AdminController@logout');

//category-product
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');
Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');

//brand-product
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');

Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');
Route::post('/save-brand-product','BrandProduct@save_brand_product');

//category-post
Route::get('/add-category-post','CategoryPost@add_category_post');
Route::get('/edit-category-post/{category_post_id}','CategoryPost@edit_category_post');
Route::post('/save-category-post','CategoryPost@save_category_post');
Route::post('/update-category-post/{category_post_id}','CategoryPost@update_category_post');
Route::get('/delete-category-post/{category_post_id}','CategoryPost@delete_category_post');
Route::get('/all-category-post','CategoryPost@all_category_post');
// Route::get('/danh-muc-bai-viet/{cate_post_slug}','CategoryPost@danh_muc_bai_viet');
//post (back-end)
Route::get('/add-post','PostController@add_post');
Route::post('/save-post','PostController@save_post');
Route::get('/all-post','PostController@all_post');
Route::get('/delete-post/{post_id}','PostController@delete_post');
Route::get('/edit-post/{post_id}','PostController@edit_post');
Route::post('/update-post/{post_id}','PostController@update_post');

//post(front-end)
Route::get('/danh-muc-bai-viet/{post_slug}','PostController@danh_muc_bai_viet');
Route::get('/bai-viet/{post_slug}','PostController@bai_viet');


//product
Route::get('/add-product','ProductController@add_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/show-product','ProductController@all_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');

Route::post('/update-product/{product_id}','ProductController@update_product');
Route::post('/save-product','ProductController@save_product');

//user
Route::get('/add-user','AdminController@add_user');
Route::get('/all-user','AdminController@all_user');
Route::get('/edit-user/{admin_id}','AdminController@edit_user');
Route::post('/save-user','AdminController@save_user');
Route::post('/update-user/{admin_id}','AdminController@update_user');

//cart
Route::post('/save-cart','CartController@save_cart');
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/update-cart','CartController@update_cart');//ajax
Route::post('/add-cart-ajax','CartController@add_cart_ajax'); //ajax
Route::get('/show-cart','CartController@show_cart');
Route::get('/gio-hang','CartController@gio_hang'); //ajax
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::get('/del-product/{session_id}','CartController@delete_product');//ajax
Route::get('/del-all-product','CartController@delete_all_product');//ajax

//checkout

Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');
Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');
Route::post('/calculate-fee','CheckoutController@calculate_fee');
Route::get('/del-fee','CheckoutController@del_fee');
Route::post('/confirm-order','CheckoutController@confirm_order');
Route::get('/infor-order','CheckoutController@infor_order');

//coupon
Route::post('/check-coupon','CartController@check_coupon');
//coupon admin
Route::get('/unset-coupon','CouponController@unset_coupon'); //layout gio hang 
Route::get('/insert-coupon','CouponController@insert_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::post('/insert-coupon-code','CouponController@insert_coupon_code');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
//

//Order
Route::get('/manage-order','OrderController@manage_order');
Route::get('/list-order-cancel','OrderController@list_order_cancel');
Route::get('/cancel-order/{order_code}','OrderController@cancel_order');
Route::post('/update-cancel-order/{order_id}','OrderController@update_cancel_order');
Route::get('/order-date','OrderController@order_date');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::get('/print-order/{checkout_code}','OrderController@print_order');
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-qty','OrderController@update_qty');
Route::post('/update-sales-order/{order_id}','OrderController@update_sales_order');

Route::get('/print-cancel-order/{pro_id}','DeliveryController@print_cancel_order');


//Delivery
Route::get('/delivery','DeliveryController@delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');

//Banner
Route::get('/manage-banner','BannerController@manage_banner');
Route::get('/add-banner','BannerController@add_banner');
Route::post('/insert-banner','BannerController@insert_banner');
Route::get('/unactive-banner/{banner_id}','BannerController@unactive_banner');
Route::get('/delete-banner/{banner_id}','BannerController@delete_banner');
Route::get('/active-banner/{banner_id}','BannerController@active_banner');

//Authentication
Route::get('/register-auth','AuthController@register_auth');
Route::post('/register','AuthController@register');
Route::get('/login-auth','AuthController@login_auth');
Route::get('/logout-auth','AuthController@logout_auth');
Route::post('/login','AuthController@login');

//User Authencation
Route::get('/users','UserController@users');
Route::get('/add-users','UserController@add_users');
Route::get('/delete-user-roles/{admin_id}','UserController@delete_user_roles');
Route::post('/store-users','UserController@store_users');
Route::post('/assign-roles','UserController@assign_roles');


//Gallery
Route::get('add-gallery/{product_id}','GalleryController@add_gallery');
Route::post('select-gallery','GalleryController@select_gallery');
Route::post('insert-gallery/{product_id}','GalleryController@insert_gallery');
Route::post('update-gallery-name','GalleryController@update_gallery_name');
Route::post('delete-gallery','GalleryController@delete_gallery');
Route::post('update-gallery','GalleryController@update_gallery');

//Video
Route::get('video','VideoController@video');
Route::post('select-video','VideoController@select_video');
Route::post('insert-video','VideoController@insert_video');

//Depot
Route::get('/view-depot','ProductController@view_depot');
Route::get('/import-depot/{product_id}','ProductController@import_depot');
Route::post('/update-depot/{product_id}','ProductController@update_depot');
Route::post('/select-depot','ProductController@select_depot');
Route::get('/print-depot/{product_id}','ProductController@print_depot');

//Comment and Rating
Route::get('/comment','ProductController@list_comment');
Route::post('/allow-comment','ProductController@allow_comment');
Route::post('/reply-comment','ProductController@reply_comment');
Route::get('/delete-admin-comment/{comment_id}','ProductController@delete_admin_comment');
Route::post('/insert-rating','ProductController@insert_rating');


//Tabs Product
Route::post('/product-tabs','CategoryProduct@product_tabs');


// Report
Route::get('/overall-report','ReportController@overall_report');
Route::get('/product-report','ReportController@product_report');
Route::get('/order-report','ReportController@order_report');
Route::get('/income-report','ReportController@income_report');

Route::post('/filter-by-date','ReportController@filter_by_date');
Route::post('/filter-for','ReportController@filter_for');
Route::post('/days-order','ReportController@days_order');