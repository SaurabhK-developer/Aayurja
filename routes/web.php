<?php

namespace App\Http\Controllers\CartController;
namespace App\Http\Controllers\WishlistController;
// namespace App\Http\Controllers\Admin\RatingsControlle;
use App\Http\Controllers\Admin\RatingsController;
use App\Http\Controllers\PayuController;
use Route;
use Auth;
//forget password




Route::post('/check-pin-code', 'PinCodeController@checkServiceability');
Route::get('/pincode', 'WebsiteController@pincode');
Route::post('/forwardOrder', 'delhiveryController@forwardOrder');


Route::get('/shipment-track', 'WebsiteController@shipmentTrack');
Route::post('/track', 'DelhiveryController@track')->name('shipment.track');



Route::get('/forwar', 'WebsiteController@forwar');
//login
Route::post('/otp-login', 'LoginController@register_login_otp')->name('otp.login');
Route::post('/generate-otp', 'LoginController@generateOtp')->name('generateOtp');
Route::get('/contact-us', 'WebsiteController@contact_us');
Route::post('/contact-save', 'WebsiteController@contact_save')->name('contact-save');
Route::post('send-news', 'WebsiteController@news_letter')->name('send-news');
Route::get('/product/{slug}', 'WebsiteController@product_detail');
Route::get('/about-us', 'WebsiteController@about_us');
Route::get('/survey', 'WebsiteController@survey');
Route::post('/survey-save', 'WebsiteController@surveySave');
Route::get('/survey-thankyou', 'WebsiteController@survey_thankyou');
Route::get('/new-invoice', 'WebsiteController@new_invoice');

//30/Aug/2024

Route::get('/shop', 'WebsiteController@product_listing');
Route::get('/shop/{category}', 'WebsiteController@productListingSlugWise');
Route::get('/shop/shop-by-concern/{concern}', 'WebsiteController@productListingByConcern');


Route::get('sitemap.xml', 'WebsiteController@showSitemap')->name('sitemap.xml');
Route::get('robots.txt', 'WebsiteController@showRobots')->name('robots.txt');
Route::get('ror.xml', 'WebsiteController@showRor')->name('ror.xml');
Route::get('urllist.txt', 'WebsiteController@showUrllist')->name('urllist.txt');

Route::get('/blog', 'WebsiteController@blogs');
Route::get('/blog/popular', 'WebsiteController@popularblog');
Route::get('/blog/{slug}', 'WebsiteController@blog_details');
Route::get('/blog/category/{slug}', 'WebsiteController@blogcategory');
Route::get('/terms-of-service', 'WebsiteController@termsCondition');

Route::post('get-product-by-category', 'Admin\ProductController@getproduct');
Route::post('getProductprice', 'WebsiteController@getproductprice');
Route::get('get-product', 'ProductController@get_data');
Route::get('get-productsidesearch', 'ProductController@get_datasidesearch');
Route::post('get-discount', 'ProductController@get_discount');
Route::get('/privacy-policy', 'WebsiteController@privacy_policy');
// Route::get('/old-home', 'WebsiteController@new_index');
Route::get('/terms-and-conditions', 'WebsiteController@terms_and_conditions');
// Route::get('/referal-page', 'WebsiteController@referal_page');
Route::get('/referal-with-login', 'WebsiteController@referal_with_login');

Route::get('/shipping-policy', 'WebsiteController@shipping_policy');
Route::get('/refund-policy', 'WebsiteController@refund_policy');
// Route::get('/otp-login', 'WebsiteController@otp_login');
Route::post('/add-to-cart', 'CartController@store')->name('add-to-cart');
Route::post('/cart-To-wish', 'CartController@cart_To_wish');
Route::get('get-cart-count', 'CartController@getCartCount')->name('getCartCount');

//REFER AND EARN REDEEM POINTS
Route::post('/redeem-points-by-user', 'WebsiteController@redeemPointsByUser')->name('redeemPointsByUser');

//price according to size

Route::post('/remove-to-wish', 'WishlistController@delete_wish')->name('wishlist.remove');
Route::post('/remove_wish', 'WishlistController@wish_product');
Route::post('/wish-products', 'WishlistController@delete_wish_product');
Route::post('/move-to-cart', 'WishlistController@backToCart');

//29/Aug/2024
Route::post('/add-to-wishlist', 'CartController@addToWishlist')->name('addToWishlist');
Route::post('/remove-from-cart', 'CartController@removeFromCart')->name('removeFromCart');
Route::post('/move-to-wishlist', 'CartController@moveToWishlist')->name('moveToWishlist');




Route::get('/wishlist', 'WebsiteController@wishlist');
Route::get('/password-reset', 'WebsiteController@password_reset');
Route::redirect('/admin/login', '/admin/home');
Route::get('/', 'WebsiteController@index');

Route::get('/website-login', 'WebsiteController@signIn');
Route::get('/signup', 'WebsiteController@signup');
Route::get('/remove-cart-product/{id?}', 'WebsiteController@removeProductToCart');
Route::get('/update_qty/{id?}/{type?}', 'WebsiteController@change_quantity');
Route::get('/update-cart-quantity/{id}/{quantity}', [CartController::class, 'updateProductQtyToCart'])->name('update-cart-quantity');
Route::get('/move-to-wishlist/{id}', [CartController::class, 'moveToWishlist'])->name('move-to-wishlist');

//product search

Route::get('get-product', 'ProductController@get_data');
Route::get('searchresults', 'ProductController@searchresults');

//rating
Route::post('save-review', 'RatingController@save_review')->name('save-review');
Route::post('/get-title-wise-reviews','RatingController@getTitleWiseReviews');
Route::post('/like-review', 'RatingController@likeReview')->name('likeReview');

//rating & review
Route::post('getprice_usingsize', 'WebsiteController@getprice_usingsize');

//ajex search
Route::get('/ajax_search', 'ProductController@ajaxSearch');
Route::post('ajaxsearch', 'ProductController@ajaxSearch');


Route::get('/run-wati', 'WebsiteController@runWati');
Route::get('/run-wati-order-failed', 'WebsiteController@runWatiOrderFailed');
//userpanel


//GET WEIGHT WISE IMAGES AJAX

Route::get('get-weight-wise-images', 'WebsiteController@getWeightWiseImages');




















//ADMIN PRODUCT START
Route::get('/admin/product/updateslug', 'Admin\ProductController@updateslug')->name('admin.product.updateslug');


Route::get('/admin/product', 'Admin\ProductController@index')->name('admin.product');

Route::get('/admin/product/create', 'Admin\ProductController@create')->name('admin.product.create');

Route::post('/admin/product/store', 'Admin\ProductController@store')->name('admin.product.store');

Route::get('/admin/product/edit/{id}', 'Admin\ProductController@edit')->name('admin.product.edit');



//GST ADMIN CONTROLLER
Route::get('/admin/gst/index', 'Admin\GstController@index')->name('admin.gst.index');
Route::get('/admin/gst/create', 'Admin\GstController@create')->name('admin.gst.create');
Route::post('/admin/gst/store', 'Admin\GstController@store')->name('admin.gst.store');
Route::get('/admin/gst/edit/{gst_id}', 'Admin\GstController@edit')->name('admin.gst.edit');
Route::post('/admin/gst/update', 'Admin\GstController@update')->name('admin.gst.update');





// Route::post('/admin/product/edit/update/{id}', 'Admin\ProductController@update')->name('admin.product.edit.update');
Route::post('/admin/product/edit/update/{id}', 'Admin\ProductController@updateNew')->name('admin.product.edit.update');


Route::get('/admin/product/destroy/{id}', 'Admin\ProductController@destroy')->name('admin.product.destroy');

Route::get('/admin/product/show/{id}', 'Admin\ProductController@show')->name('admin.product.show');






//ADMIN PRODUCT END



//Size 
Route::get('/admin/size/destroy/{id}', 'Admin\sizeController@destroy')->name('admin.size.destroy');












//CART START

Route::get('cart/store/{productid}/{quantity}/{size}/{color}', 'CartController@store');





Route::get('/cart/destroy/{productid}/{size}/{color}', 'CartController@destroy');

Route::get('/increase_qty/{ssid}/{productid}/{size}/{color}', 'CartController@increase_qty');

Route::get('/decrease_qty/{ssid}/{productid}/{size}/{color}', 'CartController@decrease_qty');


//CART END



//ADMIN DESIGNER START



//ADMIN DESIGNER END



//FOR ADMIN ORDERS END



//JUST LANDED, BEST SELLERS, ON SALE START

Route::post('admin/landed_on_home', 'Admin\ProductController@landed_on_home_store')->name('landed_on_home.store');

//JUST LANDED, BEST SELLERS, ON SALE END

//TRANDING PRODUCTS START
Route::get('/admin/tranding', 'Admin\ProductController@tranding_products')->name('admin.tranding');
Route::post('admin/tranding/store', 'Admin\ProductController@tranding_store')->name('admin.tranding.store');
//TRANDING PRODUCTS END




Route::post('/buynow/checkout-info', 'BuynowController@checkout_info_buynow')->name('checkout-info-buynow');
// Route::get('/buynow/checkout-info', 'BuynowController@checkout_info_buynow')->name('checkout-info-buynow');
// Route::post('/buynow/checkout-info/store', 'BuynowController@checkout_info_store_buynow')->name('checkout.info.store.buynow');
Route::post('/buynow/checkout-shipping', 'BuynowController@checkout_info_store_buynow')->name('checkout.shipping.buynow');
// Route::get('/buynow/checkout-shipping', 'BuynowController@checkout_info_store_buynow')->name('checkout.shipping.buynow');
// Route::post('/buynow/checkout-shipping/store', 'BuynowController@checkout_shipping_store_buynow')->name('checkout.shipping.store.buynow');
Route::post('/buynow/checkout-payment', 'BuynowController@checkout_shipping_store_buynow')->name('checkout.payment.buynow');
// Route::get('/buynow/checkout-payment', 'BuynowController@checkout_shipping_store_buynow')->name('checkout.payment.buynow');




//FOR DIRECT BUYNOW BUTTON START

// FOR ADMIN PANEL PRODUCTS CREATE FILTER CATEGORY AND PRODUCT TYPE
//Route::post('get-subcategory-by-category', 'Admin\ProductController@getSubcategory');
Route::post('get-ocassion', 'Admin\ProductController@getocassion');




Route::post('get-subcategory-by-category', 'Admin\DropdownController@getSubcategory');



//flavours

//COUPONS SECTION START
Route::get('/admin/coupon', 'Admin\CouponController@index')->name('admin.coupon.index');
Route::get('/admin/coupon/create', 'Admin\CouponController@create')->name('admin.coupon.create');
Route::post('/admin/coupon/store', 'Admin\CouponController@store')->name('admin.coupon.store');
Route::get('/admin/coupon/edit/{id}', 'Admin\CouponController@edit')->name('admin.coupon.edit');
Route::post('/admin/coupon/edit/{id}/update', 'Admin\CouponController@update')->name('admin.coupon.edit.update');
//COUPONS SECTION END

//APPLY COUPON AJAX START
Route::post('apply/coupon', 'CartController@applyCoupon')->name('apply.coupon');
//APPLY COUPON AJAX END

//REMOVE COUPON AJAX START
Route::post('remove/coupon', 'CartController@removeCoupon')->name('remove.coupon');
//REMOVE COUPON AJAX END

//CART UPDATE WHILE LOADING CART PAGE START

Route::post('cart/update', 'CartController@cartUpdateWhileLoadingPage')->name('cart.update');
//CART UPDATE WHILE LOADING CART PAGE END


//SUPER USER APPROVAL START
Route::get('/admin/approval', 'Admin\SuperuserController@approvalIndex')->name('admin.approval.index');

Route::get('/admin/product/approved', 'Admin\SuperuserController@productsApproval')->name('admin.product.approved');
Route::get('/admin/subcategory/approved', 'Admin\SuperuserController@subcategoriesApproval')->name('admin.subcategory.approved');
Route::get('/admin/designer/approved', 'Admin\SuperuserController@designersApproval')->name('admin.designer.approved');
Route::get('/admin/occasion/approved', 'Admin\SuperuserController@occasionsApproval')->name('admin.occasion.approved');
//SUPER USER APPROVAL END


// Registered/Verified Users Controller ADMIN PANEL
Route::get('/admin/registeredusers', 'Admin\RegisteredUsersController@index')->name('admin.registeredusers.index');
Route::get('/admin/unregisteredusers', 'Admin\RegisteredUsersController@unRegisteredIndex')->name('admin.unregisteredusers.index');



//RATINGS ADD THROUGH ADMIN PANEL START
Route::get('admin/ratings/create', 'Admin\RatingsController@create')->name('ratings.create');
Route::post('admin/ratings/store', 'Admin\RatingsController@store')->name('ratings.store');
//RATINGS ADD THROUGH ADMIN PANEL END



Auth::routes();

//Route::redirect("register","login");



Route::post('/singin', 'WebsiteController@login');

Route::post('sign-up', 'SignController@register');



Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');


Route::get('/login-otp', 'WebsiteController@loginotp')->name('loginotp');
Route::get('/shipping-delivery', 'WebsiteController@faqs');
Route::get('/thank-you', 'WebsiteController@thankyou')->name('thankyou');
Route::get('/subscribe-thank-you', 'WebsiteController@subscribeThankyou');


Route::get('get-blog', 'ProductController@get_blog');



Route::post('infuencer-redeem-approved', 'Admin\influencer_redeemController@infuencerRedeemApproved')->name('infuencer.redeem.approved');
Route::post('infuencer-redeem-rejected', 'Admin\influencer_redeemController@infuencerRedeemRejected')->name('infuencer.redeem.rejected');
Route::post('infuencer-redeem-status-change', 'Admin\influencer_redeemController@infuencerRedeemStatusChange')->name('infuencer.redeem.statuschange');



//addmission



Auth::routes(['register' => false]);



// Change Password Routes...




Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');

Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::get('/otp-signup', 'WebsiteController@otp_signup')->name('otp-signup');

Route::get('/invoice', 'WebsiteController@Invoice')->name('invoice');

//After login user then access

Route::group(['middleware' => ['auth']], function () {
  Route::get('/wishlist', 'WebsiteController@wishlist');
  Route::get('/add-to-cart', 'WebsiteController@add_to_cart');
  Route::get('/checkout', 'CheckoutController@checkout');
  Route::get('/checkout-2', 'CheckoutController@checkout_2');
  Route::post('/checkout-2', 'CheckoutController@checkout_2post');
  Route::post('find_coupon_type', 'OfferController@find_coupon_type');
  Route::post('apply_coupon_amount_code', 'OfferController@apply_coupon_amount_code');
  Route::post('apply_cupon_code_on_product', 'OfferController@apply_cupon_code_on_product');
  Route::post('apply_cupon_code_for_free_product', 'OfferController@apply_cupon_code_for_free_product');
  Route::post('add-offer-product-on-cart', 'WebsiteController@getProductInfoForCart');
  Route::post('apply_cupon_code', 'OfferController@apply_cupon_code');
  Route::get('forget_session_offer_id', 'OfferController@forgetSessionOfferId');
  
  Route::post('/pay_now/payu', 'PayuController@paynow');
  Route::post('/pay_now/cashfree', 'CashfreeController@paynow');
  Route::post('cod', 'CashOnDeliveryController@paynow');

//userpanel
  Route::get('/user/profile', 'UserController@index');
  Route::get('/user/myorder', 'UserController@myorder');
  Route::get('/user/address', 'UserController@address');
  Route::get('/user/recent-view', 'UserController@recent_view');
  Route::post('/update-profiles', 'UserController@updateProfiles');
  Route::post('/upload-profile-images', 'UserController@updateProfileImage');
  Route::get('/remove-profiles', 'UserController@removeProfileImage');
  Route::get('newAddresss', 'UserController@newAddresss');
  Route::post('/save-address', 'UserController@save_address');
  Route::get('/address-delete/{addressid}', 'UserController@deleteaddress');
  Route::get('/address-edit/{addressid}', 'UserController@editaddress');
  Route::post('/user/address-update/edit/update/{id}', 'UserController@updateaddress')->name('user.address-update.edit.update');  

  Route::get('/user/refer-and-earn', 'UserController@referAndEarn');
  Route::post('/redeem-referral-save', 'WebsiteController@redeemReferralSave')->name('redeem-referral-save');


});



#after payment
Route::post('/confirm', 'PayuController@confirmPayment')->name('confirm');
Route::get('/cashfree-confirm/{orderId}', 'CashfreeController@confirmPayment')->name('cashfree-confirm');

Route::get('payment/success', 'PayuController@success');
Route::get('payment/failed', 'PayuController@failed');



// Razorpayment routes
Route::post('/payment', 'RazorpayController@paynow')->name('payment.success');
Route::get('/payment-page','RazorpayController@paynow');

Route::post('/pay_now/rozorpay',  'RazorpayController@paynow')->name('payment.pay');
Route::post('/payment/success', 'RazorpayController@success')->name('payment.success');
Route::get('/payment/failed', 'RazorpayController@failed')->name('payment.failed');




Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
Route::get('/home', 'HomeController@index')->name('home');

Route::get('invoice_generate', 'Admin\OrderController@Genrate_invoice')->name('admin.invoice_generate');
Route::post('generate-invoice', 'PayuController@invoice_Genrate');


  //offers
  Route::resource('offers', 'Admin\OffersController');
  Route::delete('offers_mass_destroy', 'Admin\OffersController@massDestroy')->name('offers.mass_destroy');
  Route::patch('deactivate_offer/{id}', 'Admin\OffersController@deactivate_offer')->name('offers.deactivate_offer');
  Route::patch('activate_offer/{id}', 'Admin\OffersController@activate_offer')->name('offers.activate_offer');

  //rating
  Route::resource('ratings', 'Admin\RatingsController');
  Route::DELETE('ratings/destroy/{id}', 'Admin\RatingsController@destroy')->name('ratings.destroy');

//FOR ADMIN ORDERS START
Route::resource('orders', 'Admin\OrderController');
Route::get('orders/details/{orderid}', 'Admin\OrderController@admin_order_details')->name('admin.order.details');

  //category

  Route::resource('categories', 'Admin\CategoriesController');
  Route::delete('categories_mass_destroy', 'Admin\CategoriesController@massDestroy')->name('categories.mass_destroy');

  //falavor

//product cate
  // Route::resource('product-category', 'Admin\ProductCategoryController');
  // Route::delete('productcategory_mass_destroy', 'Admin\ProductCategoryController@massDestroy')->name('productcategory.mass_destroy');

  Route::resource('type', 'Admin\TypeController');
  Route::delete('type_mass_destroy', 'Admin\TypeController@massDestroy')->name('type.mass_destroy');


  //style


  Route::resource('style', 'Admin\StyleController');
  Route::delete('style_mass_destroy', 'Admin\StyleController@massDestroy')->name('style.mass_destroy');


  Route::resource('material', 'Admin\MaterialController');
  Route::delete('material_mass_destroy', 'Admin\MaterialController@massDestroy')->name('material.mass_destroy');

  Route::resource('metalpurity', 'Admin\MetalpurityController');
  Route::delete('metalpurity_mass_destroy', 'Admin\MetalpurityController@massDestroy')->name('metalpurity.mass_destroy');

  Route::resource('metalcolor', 'Admin\MetalcolorController');
  Route::delete('metalcolor_mass_destroy', 'Admin\MetalcolorController@massDestroy')->name('metalcolor.mass_destroy');


 
  //abandonedcart
  Route::resource('abandonedcart', 'Admin\AbandonedCartController');
  Route::delete('abandonedcart_mass_destroy', 'Admin\AbandonedCartController@massDestroy')->name('abandonedcart.mass_destroy');
  Route::get('details/{user_id}', 'Admin\AbandonedCartController@abandonedCartProductDetails')->name('abandonedcart.details');


  

  


  //subcategory

  Route::resource('seos', 'Admin\SeoController');

  Route::delete('seos_mass_destroy', 'Admin\SeoController@massDestroy')->name('seos.mass_destroy');


  Route::resource('altimage', 'Admin\AltimageController');

  Route::delete('altimage_mass_destroy', 'Admin\AltimageController@massDestroy')->name('altimage.mass_destroy');

  //occasion

  Route::resource('occasion', 'Admin\OccasionController');
  Route::resource('occasioncategory', 'Admin\OccasionCategoryController');


  Route::delete('occasion_mass_destroy', 'Admin\OccasionController@massDestroy')->name('occasion.mass_destroy');

  //subcategory



  Route::resource('subcategories', 'Admin\SubcategoriesController');
  Route::delete('subcategories_mass_destroy', 'Admin\SubcategoriesController@massDestroy')->name('subcategories.mass_destroy');



  //blog


  Route::resource('sitemap', 'Admin\SitemapController');

  Route::delete('sitemap_mass_destroy', 'Admin\SitemapController@massDestroy')->name('sitemap.mass_destroy');

  Route::resource('robot', 'Admin\RobotController');

  Route::delete('robot_mass_destroy', 'Admin\RobotController@massDestroy')->name('robot.mass_destroy');



  Route::resource('blog', 'Admin\blogController');

  Route::delete('blog_mass_destroy', 'Admin\blogController@massDestroy')->name('blog.mass_destroy');




  Route::resource('author', 'Admin\AuthorController');

  Route::delete('author_mass_destroy', 'Admin\AuthorController@massDestroy')->name('author.mass_destroy');

  Route::resource('referinfluencer', 'Admin\ReferInfluencerController');
  Route::get('referinfluencer-history/{influencer_id}', 'Admin\ReferInfluencerController@influencerHistory');


  Route::delete('referinfluencer_mass_destroy', 'Admin\ReferInfluencerController@massDestroy')->name('referinfluencer.mass_destroy');



  // Tracking Code Routes
  Route::resource('tracking', 'Admin\TrackingController');
  Route::delete('tracking_mass_destroy', 'Admin\TrackingController@trackingDestroy')->name('tracking.mass_destroy');
  // tracking code end


   // Sitemap Code Routes
 Route::resource('sitemap', 'Admin\SitemapController');
 Route::delete('sitemap_mass_destroy', 'Admin\SitemapController@sitemapDestroy')->name('sitemap.mass_destroy');
 // Sitemap code end


 // Robots Code Routes
 Route::resource('robots', 'Admin\RobotsController');
 Route::delete('robots_mass_destroy', 'Admin\RobotsController@robotsDestroy')->name('robots.mass_destroy');
 // Robots code end


  // Ror Code Routes
  Route::resource('ror', 'Admin\RorController');
  Route::delete('ror_mass_destroy', 'Admin\RorController@rorDestroy')->name('robots.mass_destroy');
  // Ror code end


  // Urllist Code Routes
  Route::resource('urllist', 'Admin\UrllistController');
  Route::delete('urllist_mass_destroy', 'Admin\UrllistController@urllistDestroy')->name('urllist.mass_destroy');
  // Urllist code end


  //imageAlt-count
   Route::resource('imagealt', 'Admin\ImageAltController');
   Route::delete('imagealt_mass_destroy', 'Admin\ImageAltController@massDestroy')->name('imagealt.mass_destroy');

 //FormType
   Route::resource('formtype', 'Admin\FormtypeController');
   Route::delete('formtype_mass_destroy', 'Admin\FormtypeController@massDestroy')->name('formtype.mass_destroy');

 //DynamicEmail
   Route::resource('dynamic-email', 'Admin\DynamicEmailController');
   Route::delete('dynamic-email_mass_destroy', 'Admin\DynamicEmailController@massDestroy')->name('dynamic-email.mass_destroy');


  Route::resource('influencer_redeem', 'Admin\influencer_redeemController');
  Route::delete('influencer_redeem_mass_destroy', 'Admin\influencer_redeemController@massDestroy')->name('influencer_redeem.mass_destroy');


  //product catogry
  //ADMIN PRODUCT CATEGORY START

  

  Route::resource('product_categories', 'Admin\ProductCategoryController');
  Route::delete('product_categories_mass_destroy', 'Admin\ProductCategoryController@massDestroy')->name('product_categories.mass_destroy');

  // Shop by Concern
  Route::resource('shop-by-concern', 'Admin\ShopbyConcernController');
  Route::delete('shop-by-concern_mass_destroy', 'Admin\ShopbyConcernController@massDestroy')->name('shop-by-concern.mass_destroy');
  // End Shop by Concern

  // news
  Route::resource('news', 'Admin\NewsController');
  Route::delete('news_mass_destroy', 'Admin\NewsController@massDestroy')->name('news.mass_destroy');
  // news


  Route::resource('product-sub-category', 'Admin\ProductsubCategoryController');
  Route::delete('productsubcategory_mass_destroy', 'Admin\ProductsubCategoryController@massDestroy')->name('productsubcategory.mass_destroy');

  Route::resource('flavours', 'Admin\FlavourController');
  Route::post('get-product-image', 'Admin\FlavourController@getProductImageById')->name('getProductImageById');

  //Size

  Route::resource('size', 'Admin\sizeController');
  Route::delete('size_mass_destroy', 'Admin\sizeController@massDestroy')->name('size.mass_destroy');


  //designer


  Route::resource('designer', 'Admin\DesignerController');
  Route::delete('designer_mass_destroy', 'Admin\DesignerController@massDestroy')->name('designer.mass_destroy');


//



  Route::resource('falavor', 'Admin\FalavorController');
  Route::delete('falavor_mass_destroy', 'Admin\FalavorController@massDestroy')->name('falavor.mass_destroy');

  //testimonials

  Route::resource('testimonials', 'Admin\testimonialsController');

  Route::delete('testimonials_mass_destroy', 'Admin\testimonialsController@massDestroy')->name('testimonials.mass_destroy');



  //slider

  Route::resource('slider', 'Admin\sliderController');

  Route::delete('slider_mass_destroy', 'Admin\sliderController@massDestroy')->name('slider.mass_destroy');

  //slider

  //deal

  Route::resource('deal', 'Admin\DealController');

  Route::delete('deal_mass_destroy', 'Admin\DealController@massDestroy')->name('deal.mass_destroy');


  // Route::delete('slider_mass_destroy', 'Admin\sliderController@massDestroy')->name('slider.mass_destroy');

  Route::resource('galleries', 'Admin\GalleriesController');

  Route::delete('galleries_mass_destroy', 'Admin\GalleriesController@massDestroy')->name('galleries.mass_destroy');


//CONTACTS
Route::resource('contact', 'Admin\ContactController');
    Route::delete('contact_mass_destroy', 'Admin\ContactController@massDestroy')->name('contact.mass_destroy');


  //SURVEY
  Route::resource('survey', 'Admin\SurveyController');
  Route::delete('survey_mass_destroy', 'Admin\SurveyController@massDestroy')->name('survey.mass_destroy');

  //currentprice

  Route::resource('currentprice', 'Admin\currentpriceController');
  Route::delete('currentprice_mass_destroy', 'Admin\currentpriceController@massDestroy')->name('currentprice.mass_destroy');


  //tags

  Route::resource('tags', 'Admin\TagsController');
  Route::delete('tags_mass_destroy', 'Admin\TagsController@massDestroy')->name('tags.mass_destroy');

  //goal
  Route::resource('goals', 'Admin\GoalsController');
  Route::delete('goals_mass_destroy', 'Admin\GoalsController@massDestroy')->name('goals.mass_destroy');

  //Media
  Route::resource('media', 'Admin\MediaController');
  Route::delete('medias_mass_destroy', 'Admin\MediaController@massDestroy')->name('medias.mass_destroy');



  Route::resource('permissions', 'Admin\PermissionsController');

  Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');

  Route::resource('roles', 'Admin\RolesController');

  Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');

  Route::resource('users', 'Admin\UsersController');

  Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');






  Route::delete('product_mass_destroy', 'Admin\ProductController@massDestroy')->name('product.mass_destroy');



  Route::post('fetch-price', 'Admin\DropdownController@fetchprice');

  Route::post('fetch-purity', 'Admin\DropdownController@fetchpurity');
});

// Route::get('{param1}', 'WebsiteController@product_listing_test');
// Route::get('{param1}/{param2}', 'WebsiteController@product_listing_tests');