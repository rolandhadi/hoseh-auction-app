<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

// env EDITOR=nano crontab -e;

// Production
// * * * * * curl http://hoseh.com/d/e
// * * * * * curl http://hoseh.com/b/e
// 30 2 * * * curl http://hoseh.com/backup

// Development
// * * * * * curl http://hoseh.sg.dev/d/e
// * * * * * curl http://hoseh.sg.dev/b/e
// 30 2 * * * curl http://hoseh.sg.dev/backup

Route::group(['middleware' => ['web']], function () {

  // Dashboard
  Route::get('/', 'DashboardController@index');
  Route::get('b', 'DashboardController@index_bid');
  Route::get('about', 'DashboardController@about');


  // Users
  Route::post('u/l', 'UserLoginController@login');
  Route::get('login', 'UserLoginController@index');
  Route::get('logout', 'UserLoginController@logout');
  Route::post('u/r', 'UserLoginController@register');
  Route::post('u/v', 'UserLoginController@verifiy_user');


  // Passwords
  Route::get('password/email', 'Auth\PasswordController@getEmail');
  Route::post('password/reset', 'Auth\PasswordController@postReset');
  Route::post('password/email', 'Auth\PasswordController@postEmail');
  Route::get('login/problems', 'UserLoginController@forgot_password');
  Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');


  // Draws
  Route::post('d/j', 'DrawUserController@join_draw');
  Route::get('d/e', 'DrawPlanController@evaluate_draws');
  Route::post('d/s/p', 'DrawPlanController@show_draw_participants');
  Route::post('d/at', 'DrawPlanController@get_active_draw_time_left');


  // Bids
  Route::post('b/j', 'BidUserController@join_bid');
  Route::get('b/e', 'BidPlanController@evaluate_bids');
  Route::post('b/s/p', 'BidPlanController@show_bid_participants');
  Route::post('b/at', 'BidPlanController@get_active_bid_time_left');


  // Products
  Route::get('p/d/s', 'ProductDetailController@show');


  // Backup
  Route::get('/backup', function()
  {
      $exitCode = Artisan::call('db:backup',  [
                                                '--database' => 'mysql',
                                                '--destination' => 'dropbox',
                                                '--destinationPath' => date('Y-m-d--H-i', time()),
                                                '--compression' => 'gzip'
                                              ]);
  });

});

Route::group(['middleware' => ['admin-auth']], function () {

  // Reports
  Route::get('r/b', 'BidUserController@bid_histories');
  Route::get('r/e/a', 'BidUserController@export_bid_histories');
  Route::get('r/d', 'DrawUserController@draw_histories');
  Route::get('r/e/ld', 'DrawUserController@export_draw_histories');
  Route::get('r', 'UserPaymentController@payment_histories');
  Route::get('r/e/up', 'UserPaymentController@export_payment_histories');
  Route::get('r/b/w', 'BidUserController@bid_winner_histories');
  Route::get('r/e/aw', 'BidUserController@export_bid_winner_histories');
  Route::get('r/ad', 'DrawUserController@active_draw_histories');
  Route::get('r/e/ald', 'DrawUserController@export_active_draw_histories');
  Route::get('r/d/w', 'DrawUserController@draw_winner_histories');
  Route::get('r/e/ldw', 'DrawUserController@export_draw_winner_histories');
  Route::get('r/p/p/d', 'ProductDetailController@product_draw_purchase_histories');
  Route::get('r/e/ldp', 'ProductDetailController@export_product_draw_purchase_histories');
  Route::get('r/p/p/b', 'ProductDetailController@product_bid_purchase_histories');
  Route::get('r/e/ap', 'ProductDetailController@export_product_bid_purchase_histories');
  Route::post('r/ad/u', 'DrawPlanController@update_active_draw_winner');
  Route::post('r/b/w/a/d', 'BidUserController@bid_winner_action_delivered');
  Route::post('r/d/w/a/d', 'DrawUserController@draw_winner_action_delivered');
  Route::post('r/p/p/d/a/d', 'ProductDetailController@product_draw_purchase_action_delivered');
  Route::post('r/p/p/b/a/d', 'ProductDetailController@product_bid_purchase_action_delivered');


  // Products
  Route::get('p/m', 'ProductManagementController@index');
  Route::post('p/m/at', 'ProductDetailController@add_tag');
  Route::post('d/m/sp', 'DrawPlanController@show_products');
  Route::post('p/d/ai', 'ProductDetailController@add_image');
  Route::post('p/m/st', 'ProductDetailController@show_tags');
  Route::post('p/m/dt', 'ProductDetailController@delete_tag');
  Route::post('p/d/di', 'ProductDetailController@delete_image');
  Route::post('p/m/dp', 'ProductDetailController@delete_product');
  Route::post('p/m/up', 'ProductDetailController@update_product');
  Route::post('p/m/ap', 'ProductManagementController@add_product');
  Route::post('p/m/sp', 'ProductManagementController@show_products');


  // Draws
  Route::get('d/m', 'DrawPlanController@index');
  Route::get('d/m/d', 'DrawPlanController@show_draw');
  Route::post('d/m/sd', 'DrawPlanController@save_draw');
  Route::post('d/m/dd', 'DrawPlanController@delete_draw');


  // Bids
  Route::get('b/m', 'BidPlanController@index');
  Route::get('b/m/d', 'BidPlanController@show_bid');
  Route::post('b/m/sd', 'BidPlanController@save_bid');
  Route::post('b/m/dd', 'BidPlanController@delete_bid');
  Route::post('b/m/sp', 'BidPlanController@show_products');


  // Admin
  Route::get('c', 'AdminConfigController@index');
  Route::post('u/p/u/u/t', 'UserPaymentController@update_user_token');
  Route::post('c/u', 'AdminConfigController@update');
  Route::post('c/u/b', 'AdminConfigController@update_banner');
  Route::post('a/u', 'AboutController@update_about');
  Route::post('f/u', 'AboutController@update_footer');
  Route::post('u/p/u', 'UserPaymentController@updateCredit');
  Route::get('u/t', 'UserTestimonialController@show_testimonials');
  Route::post('u/t/a', 'UserTestimonialController@add_testimonial');
  Route::post('u/t/u', 'UserTestimonialController@update_testimonial');
  Route::post('u/t/d', 'UserTestimonialController@delete_testimonial');
  Route::post('u/t/ai', 'UserTestimonialController@add_image');
  Route::post('c/b/i', 'AdminConfigController@update_banner_image');

});

Route::group(['middleware' => ['web-auth']], function () {

  // Users
  Route::get('u/u', 'UserLoginController@update_user');
  Route::get('u/p/s', 'UserPaymentController@selectCredit');
  Route::get('u/p/h', 'UserPaymentController@payment_history');
  Route::post('u/u/a', 'UserLoginController@update_user_address');
  Route::post('u/u/s', 'UserLoginController@update_user_password');
  Route::get('u/p/d/t', 'UserPaymentController@get_buy_token_done');
  Route::get('u/p/t', 'UserPaymentController@get_buy_token_checkout');
  Route::get('u/p/c/t', 'UserPaymentController@get_buy_token_cancel');


 // Payments
  Route::get('u/p/p/b', 'UserPaymentController@get_claim_buy_done');
  Route::get('u/p/p', 'UserPaymentController@get_claim_buy_checkout');
  Route::get('u/p/c/p', 'UserPaymentController@get_claim_buy_cancel');
  Route::get('u/p/d/d', 'UserPaymentController@get_claim_draw_done');
  Route::get('u/p/d', 'UserPaymentController@get_claim_draw_checkout');
  Route::get('u/p/c/d', 'UserPaymentController@get_claim_draw_cancel');
  Route::get('u/p/d/b', 'UserPaymentController@get_claim_auction_done');
  Route::get('u/p/b', 'UserPaymentController@get_claim_auction_checkout');
  Route::get('u/p/c/b', 'UserPaymentController@get_claim_auction_cancel');


  // Draws
  Route::post('r/d/w/a', 'DrawUserController@draw_winner_action');
  Route::get('u/d/w', 'DrawUserController@draw_winner_history');
  Route::get('u/r/p/p/d', 'ProductDetailController@product_draw_purchase_history');


  // Bids
  Route::post('r/b/w/a', 'BidUserController@bid_winner_action');
  Route::get('u/b/w', 'BidUserController@bid_winner_history');
  Route::get('u/r/p/p/b', 'ProductDetailController@product_bid_purchase_history');

  // Products
  Route::post('r/p/p/d/a', 'ProductDetailController@product_draw_purchase_action');
  Route::post('r/p/p/b/a', 'ProductDetailController@product_bid_purchase_action');

});
