<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::any('/',                                 array('as' => 'planroom',               'uses'=>'PlanroomController@index' ));
Route::any('/reset-password',                   array('as' => 'reset-password',         'uses'=>'ResetpwdController@index' ));
Route::any('/user-forgot-pwd',                  array('as'=>'user_forgotpwd_action',    'uses'=>'ResetpwdController@user_forgotpwd_action'));
Route::get('/reset/{token}',                    array('as' => 'user_reset_newpassword', 'uses'=> 'ResetpwdController@password_reset' ));
Route::post('/reset/{token}',                   array('as' => 'user_password_update',   'uses'=> 'ResetpwdController@password_update' ));
Route::any('/register',                         array('as' => 'register',               'uses'=>'UserController@register' ));
Route::post('/register_post',                   array('as' => 'register_post',          'uses'=>'UserController@register_post' ));
Route::any('/more-info',                        array('as' => 'register_moreinfo',      'uses'=>'UserController@more_info' ));
Route::any('/thankyou',                         array('as' => 'thankyou',               'uses'=>'UserController@thankyou' ));
Route::any('/active_user/{token}',              array('as' => 'active_user',            'uses'=>'UserController@active_user' ));
Route::any('/login',                            array('as' => 'login',                  'uses'=>'UserController@login' ));
Route::any('/free_consultant_action',           array('as' => 'free_consultant_action', 'uses'=>'UserController@free_consultant_action' ));
Route::any('/resend-mail/{token}',              array('as' => 'resendMail',             'uses'=>'UserController@resendMail' ));
Route::any('/subscription_action',              array('as' => 'subscription_action',    'uses'=>'UserController@subscription' ));
Route::any('/payment-process/{token}',          array('as' => 'payment_process',        'uses'=>'UserController@payment_process' ));
Route::any('/silent-post-url',                  array('as' => 'silent_post_url',        'uses'=>'UserController@silent_post_url' ));
Route::any('/transaction-history',              array('as' => 'front_transaction_history',  'uses'=>'UserController@front_transaction_history' ));
Route::any('/print-invoice/{invoice}',          array('as' => 'print_details',              'uses'=>'UserController@print_details' ));
Route::any('/new-subscription-payment',         array('as' => 'after_subscription_payment', 'uses'=>'UserController@after_subscription_payment' ));
Route::any('/new-subscription-payment1',        array('as' => 'new_subscription_payment',   'uses'=>'UserController@new_subscription_payment' ));
Route::any('/reminder',                         array('as' => 'reminder',                   'uses'=>'CronController@reminder' ));
Route::any('/disablereminder',                  array('as' => 'disablereminder',            'uses'=>'CronController@disablereminder' ));
Route::any('/auto_payment',                     array('as' => 'auto_payment',               'uses'=>'CronController@auto_payment' ));

Route::any('/test',                             array('as' => 'test',                       'uses'=>'TestController@index' ));

Route::any('/{company_slug}/forgot-password',           array('as' => 'private_forgot_password','uses'=>'PrivatePlanroomController@forgot_password' ));
Route::any('/{company_slug}/reset-password/{token}',    array('as' => 'private_reset_password', 'uses'=>'PrivatePlanroomController@reset_password' ));

Route::group(array('middleware' => 'user'), function (){
    Route::any('/dashboard',                    array('as' => 'dashboard',                  'uses'=>'UserController@dashboard' ));
    Route::any('/cancel_payment',               array('as' => 'cancel_payment',             'uses'=>'UserController@cancel_payment' ));
    Route::any('/logout',                       array('as' => 'logout',                     'uses'=>'UserController@logout' ));
    Route::any('/edit_customer_profile',        array('as' => 'edit_customer_profile',      'uses'=>'UserController@edit_customer_profile' ));
    Route::any('/update_customer_profile',      array('as' => 'update_customer_profile',    'uses'=>'UserController@update_customer_profile' ));
    Route::any('/change_password',              array('as' => 'change_password',            'uses'=>'UserController@change_password' ));
    Route::any('/change_password_update',       array('as' => 'change_password_update',     'uses'=>'UserController@change_password_update' ));
    Route::any('/planroom-list',                array('as' => 'planroom_list',              'uses'=>'PlanroomController@lists' ));
    Route::any('/project-print',                array('as' => 'project-print',              'uses'=>'PlanroomController@project_print' ));
    Route::any('/tracking',                     array('as' => 'tracking',                   'uses'=>'PlanroomController@tracking' ));
    Route::any('/details',                      array('as' => 'project_details',            'uses'=>'PlanroomController@details' ));
    Route::any('/view-plan-details',            array('as' => 'view_plan_details',          'uses'=>'PlanroomController@view_plan_details' ));
    Route::any('/saved-tracking-list',          array('as' => 'saved_tracking_list',        'uses'=>'SaveTrackController@lists' ));
    Route::any('/removeFromSaveTrack',          array('as' => 'removeFromSaveTrack',        'uses'=>'SaveTrackController@removeFromSaveTrack' ));
    Route::any('/markAsUnread',                 array('as' => 'markAsUnread',               'uses'=>'SaveTrackController@markAsUnread' ));
    Route::any('/addToCart',                    array('as' => 'plan_add_to_cart',           'uses'=>'PlanroomController@addToCart' ));
    Route::any('/cartView',                     array('as' => 'cartView',                   'uses'=>'PlanroomController@cartView' ));
    Route::any('/getContractor',                array('as' => 'getContractor',              'uses'=>'PlanroomController@getContractor' ));
    Route::get('/my-cart',                      array('as' => 'my_cart',                    'uses'=>'CartController@index' ));
    Route::get('/remove-cart/{rowId}',          array('as' => 'remove_cart',                'uses'=>'CartController@cart_remove' ));
    Route::get('/remove-full-cart/{projectId}', array('as' => 'remove_full_cart',           'uses'=>'CartController@remove_full_cart' ));
    Route::get('/clear-cart',                   array('as' => 'clear_cart',                 'uses'=>'CartController@cart_clear' ));
    Route::post('/update-cart',                 array('as' => 'update_cart',                'uses'=>'CartController@updateCart' ));
    Route::any('/checkout',                     array('as' => 'checkout',                   'uses'=>'CartController@checkout' ));
    Route::any('/payment',                      array('as' => 'payment',                    'uses'=>'CartController@payment' ));
    Route::any('/payment-success',              array('as' => 'payment_success',            'uses'=>'CartController@payment_success' ));
    Route::any('/renew-subscribe/{id}',         array('as' => 'renewSubscribe',             'uses'=>'UserController@renewSubscribe' ));
    Route::any('/updateSubscription',           array('as' => 'updateSubscription',         'uses'=>'UserController@updateSubscription' ));
    Route::any('/disable-subscription',         array('as' => 'disableSubscription',        'uses'=>'UserController@disableSubscription' ));
    Route::any('/enable-subscription',          array('as' => 'enableSubscription',         'uses'=>'UserController@enableSubscription' ));
    
    Route::any('/building-report',              array('as' => 'building_report',            'uses'=>'BuildingreportController@index' ));
    Route::any('/building_details',             array('as' => 'building_details',           'uses'=>'BuildingreportController@details' ));
    Route::any('/building-report-print',        array('as' => 'building_report_print',      'uses'=>'BuildingreportController@building_report_print' ));
    Route::any('/building-report-print-last',   array('as' => 'building_report_print_last', 'uses'=>'BuildingreportController@building_report_print_last' ));
    Route::any('/update-customer-moreinfo',     array('as' => 'update_customer_moreinfo',   'uses'=>'UserController@update_customer_moreinfo' ));
    Route::any('/update-card-info',             array('as' => 'update_card_info',           'uses'=>'UserController@update_card_info' ));
    
    
    Route::any('/order',                        array('as' => 'order_report',              'uses'=>'OrderController@index' ));
    Route::any('/order-details/{id}',           array('as' => 'order_details',             'uses'=>'OrderController@details' ));
    Route::any('/download-zip/{id}',            array('as' => 'download_zip',              'uses'=>'OrderController@download_zip' ));
    Route::any('/calendar',                     array('as' => 'calendar',                  'uses'=>'UserController@getcalendar' ));
    
});

Route::group(array('middleware' => 'privateuser'), function (){
    
Route::any('/{company_slug}/project-lists',          array('as' => 'public_planroom_list_for_user',  'uses'=>'PrivatePlanroomUserController@lists' ));
Route::any('/{company_slug}/private-project-lists',  array('as' => 'private_planroom_list_for_user', 'uses'=>'PrivatePlanroomUserController@private_lists' ));
Route::any('/{company_slug}/edit-user-profile',      array('as' => 'profile_edit_for_user',          'uses'=>'PrivatePlanroomUserController@editProfile' ));

Route::any('/{company_slug}/project-list',              array('as' => 'public_planroom_list_for_company',  'uses'=>'PrivatePlanroomCompanyController@lists' ));
Route::any('/{company_slug}/private-project-list',      array('as' => 'private_planroom_list_for_company', 'uses'=>'PrivatePlanroomCompanyController@private_lists' ));
Route::any('/{company_slug}/edit-company-profile',      array('as' => 'profile_edit_for_company',          'uses'=>'PrivatePlanroomCompanyController@editProfile' ));

Route::any('/{company_slug}/email-campaign',            array('as' => 'email_campaign_list_for_company',        'uses'=>'EmailCampaignController@campaignlist' ));
Route::any('/{company_slug}/add-email-campaign/{id}',   array('as' => 'add_email_campaign_list_for_company',    'uses'=>'EmailCampaignController@createcampaign' ));
Route::any('/{company_slug}/post-email-campaign',       array('as' => 'post_email_campaign_list_for_company',   'uses'=>'EmailCampaignController@postcampaign' ));

Route::any('/{company_slug}/edit-campaign/{id}',    array('as' => 'edit_email_campaign_list_for_company',   'uses'=>'EmailCampaignController@edit' ));
Route::any('/{company_slug}/update-campaign',       array('as' => 'update_email_campaign_list_for_company', 'uses'=>'EmailCampaignController@update' ));
Route::any('/{company_slug}/send-mail/{id}',        array('as' => 'send_mail_for_company',                  'uses'=>'EmailCampaignController@sendmail' ));

Route::any('/{company_slug}/change-password',                           array('as' => 'private_change_password',    'uses'=>'PrivatePlanroomController@change_password' ));
Route::any('/addToCartPrivatePlan',                                     array('as' => 'private_plan_add_to_cart',   'uses'=>'PrivatePlanroomController@addToCart' ));
Route::any('/privateCartView',                                          array('as' => 'privateCartView',            'uses'=>'PrivatePlanroomController@cartView' ));
Route::get('/{company_slug}/private-planroom-cart',                     array('as' => 'private_planroom_cart',      'uses'=>'PrivateCartController@index' ));
Route::get('/private-remove-cart/{rowId}',                              array('as' => 'remove_private_cart',        'uses'=>'PrivateCartController@cart_remove' ));
Route::get('/clear-private-cart',                                       array('as' => 'clear_private_cart',         'uses'=>'PrivateCartController@cart_clear' ));
Route::post('update-private-cart',                                      array('as' => 'update_private_cart',        'uses'=>'PrivateCartController@updateCart' ));
Route::any('/{company_slug}/private-checkout',                          array('as' => 'private_checkout',           'uses'=>'PrivateCartController@checkout' ));
Route::any('/private-payment',                                          array('as' => 'private_payment',            'uses'=>'PrivateCartController@payment' ));
Route::any('/{company_slug}/private-payment-success',                   array('as' => 'private_payment_success',    'uses'=>'PrivateCartController@payment_success' ));
Route::any('/{company_slug}/private-order',                             array('as' => 'private_order_report',       'uses'=>'PrivatePlanroomController@order' ));
Route::any('/{company_slug}/private-order-details/{id}',                array('as' => 'private_order_details',      'uses'=>'PrivatePlanroomController@order_details' ));
    
Route::any('/privateplanroomdetails',                   array('as' => 'privateplanroomdetails',    'uses'=>'PrivatePlanroomController@details' ));
Route::any('/privateplanroomlogout/{company_slug}',     array('as' => 'privateplanroomlogout',     'uses'=>'PrivatePlanroomController@logout' ));

Route::any('/private-project-print/{id}',              array('as' => 'private_project_print',     'uses'=>'PrivatePlanroomController@private_project_print' ));
Route::any('/normal-site',                             array('as' => 'normal_site',               'uses'=>'PrivatePlanroomController@normal_site' ));
});
Route::group(array('prefix'=>'admin','namespace' => 'admin'), function (){
     Route::any('/',                            array('as' => 'admin_login',                    'uses'=>'LoginController@index' ));
     Route::get('/forgot-password',             array('as' => 'admin_forgot_password',          'uses'=>'LoginController@admin_forgot_password' ));
     Route::post('/forgot-password-action',     array('as' => 'admin_forgot_password_action',   'uses'=>'LoginController@admin_forgot_password_action' ));
});
Route::group(array('prefix'=>'admin','namespace' => 'admin','middleware' => 'admin'), function (){
     Route::any('/dashboard',                   array('as' => 'admin_dashboard',            'uses'=>'DashboardController@index' ));
     Route::get('/profile',                     array('as' => 'admin_profile',              'uses'=>'DashboardController@profile' ));
     Route::post('/profile-update',             array('as' => 'admin_profile_update',       'uses'=>'DashboardController@profile_update' ));
     Route::get('/password-change',             array('as' => 'admin_change_password',      'uses'=>'DashboardController@change_password' ));
     Route::post('/change-password-action',     array('as' => 'admin_change_password_action',      'uses'=>'DashboardController@change_password_action' ));
     Route::any('/logout',                      array('as' => 'admin_logout',               'uses'=>'DashboardController@logout' ));
     
     Route::any('/admin-users',                   array('as' => 'admin_users',              'uses'=>'UserController@admin_users_list' ));
     Route::get('/admin-users-add',               array('as' => 'admin_users_add',          'uses'=>'UserController@admin_users_add' ));
     Route::post('/admin-user-create',           array('as' => 'admin_user_create',        'uses'=>'UserController@admin_user_create' ));
     Route::any('/admin-users-edit/{id}',        array('as' => 'admin_users_edit',         'uses'=>'UserController@admin_users_edit' ));
     Route::any('/admin-users-update',           array('as' => 'admin_user_update',         'uses'=>'UserController@admin_user_update' ));
     Route::any('/admin-users-delete/{id}',       array('as' => 'admin_users_delete',       'uses'=>'UserController@admin_users_delete' ));
     
     
     Route::any('/front-users',                  array('as' => 'front_users',              'uses'=>'UserController@front_users_list' ));
     Route::get('/front-users-add',              array('as' => 'front_users_add',          'uses'=>'UserController@front_users_add' ));
     Route::post('/front-user-create',           array('as' => 'front_user_create',        'uses'=>'UserController@front_user_create' ));
     Route::any('/front-users-edit/{id}',        array('as' => 'front_users_edit',         'uses'=>'UserController@front_users_edit' ));
     Route::any('/front-users-update',           array('as' => 'front_user_update',        'uses'=>'UserController@front_user_update' ));
     Route::any('/front-users-delete/{id}',      array('as' => 'front_users_delete',       'uses'=>'UserController@front_users_delete' ));
     Route::any('/front_user_moreinfo/{id}',     array('as' => 'front_user_moreinfo',      'uses'=>'UserController@front_user_moreinfo' ));
     Route::any('/subscriptions/{id}',           array('as' => 'front_user_subscriptions', 'uses'=>'UserController@subscriptions' ));
     Route::any('/disable-subscriptions/{id}',   array('as' => 'front_user_disable_subscriptions',  'uses'=>'UserController@disable_subscriptions' ));
     Route::any('/enable-subscriptions/{id}',    array('as' => 'front_user_enable_subscriptions',   'uses'=>'UserController@enable_subscriptions' ));
     Route::any('/transaction-history/{id}',     array('as' => 'front_transaction_history',         'uses'=>'UserController@front_transaction_history' ));
     
     
     Route::any('/project',                      array('as' => 'admin_project',              'uses'=>'ProjectController@lists' ));
     Route::get('/project-create',               array('as' => 'admin_project_create',       'uses'=>'ProjectController@create' ));
     Route::post('/project-store',               array('as' => 'admin_project_post',         'uses'=>'ProjectController@store' ));
     Route::any('/project-awarded-to/{id}',      array('as' => 'admin_project_awarded_to',   'uses'=>'ProjectController@awarded_to' ));
     Route::any('/project-address/{id}',         array('as' => 'admin_project_address',      'uses'=>'ProjectController@address_update' ));
     Route::any('/project-principle/{id}',       array('as' => 'admin_project_principle',    'uses'=>'ProjectController@principle_update' ));
     Route::any('/project-contractor/{id}',      array('as' => 'admin_project_contractor',   'uses'=>'ProjectController@contractor_update' ));
     Route::any('/project-plans/{id}',           array('as' => 'admin_project_plans',        'uses'=>'ProjectController@plan_update' ));
     Route::any('/admin_project_plan_delete/{id}/{project_id}',array('as' => 'admin_project_plans_delete','uses'=>'ProjectController@plan_delete' ));
     Route::any('/admin_cat_plans_delete/{cat_id}/{project_id}',array('as' => 'admin_cat_plans_delete','uses'=>'ProjectController@plan_cat_delete' ));
     
     Route::any('/project-speces/{id}',                             array('as' => 'admin_project_speces',           'uses'=>'ProjectController@speces_update' ));
     Route::any('/project-speces-delete/{id}/{project_id}',         array('as' => 'admin_project_speces_delete',    'uses'=>'ProjectController@delete_speces' ));
     Route::any('/admin_speces_cat_delete/{cat_id}/{project_id}',   array('as' => 'admin_speces_cat_delete',        'uses'=>'ProjectController@speces_cat_delete' ));
     Route::any('/project-edit/{id}',                               array('as' => 'admin_project_edit',             'uses'=>'ProjectController@edit' ));
     Route::any('/project-delete/{id}',                             array('as' => 'admin_project_delete',           'uses'=>'ProjectController@delete' ));
     Route::any('/assign-contractor-delete/{id}',                   array('as' => 'admin_assign_contractor_delete', 'uses'=>'ProjectController@deleteAssignContractor' ));
     
     Route::any('/project-upload-pdf',                             array('as' => 'admin_project_upload_pdf', 'uses'=>'ProjectController@project_upload_pdf' ));
     Route::any('/project-plan-lists',                             array('as' => 'admin_project_plan_lists', 'uses'=>'ProjectController@plan_lists' ));
     Route::any('/project-plans-remove',                           array('as' => 'admin_project_plan_remove', 'uses'=>'ProjectController@plan_remove' ));
     Route::any('/project-plan-delete',                            array('as' => 'admin_project_plan_delete_individual', 'uses'=>'ProjectController@plan_delete_individual' ));
     
     
     Route::any('/project-details/{id}',         array('as' => 'admin_project_details',        'uses'=>'ProjectController@details' ));
     Route::any('/project-awarded-to-view/{id}', array('as' => 'admin_project_awarded_to_view','uses'=>'ProjectController@awarded_to_view' ));
     Route::any('/project-address-view/{id}',    array('as' => 'admin_project_address_view',   'uses'=>'ProjectController@address_view' ));
     Route::any('/project-principle-view/{id}',  array('as' => 'admin_project_principle_view', 'uses'=>'ProjectController@principle_view' ));
     Route::any('/project-contrctor-view/{id}',  array('as' => 'admin_project_contrctor_view', 'uses'=>'ProjectController@contrctor_view' ));
     Route::any('/project-speces-view/{id}',     array('as' => 'admin_project_speces_view',    'uses'=>'ProjectController@speces_view' ));
     Route::any('/project-plan-view/{id}',       array('as' => 'admin_project_plan_view',      'uses'=>'ProjectController@plan_view' ));
     Route::any('/bidder/{project_id}',              array('as' => 'admin_bidder_list',         'uses'=>'BidderController@index' ));
     Route::get('/bidder-create/{project_id}',       array('as' => 'admin_bidder_create',       'uses'=>'BidderController@create' ));
     Route::post('/bidder-store/{project_id}',       array('as' => 'admin_bidder_add',          'uses'=>'BidderController@store' ));
     Route::any('/bidder-edit/{project_id}/{id}',    array('as' => 'admin_bidder_edit',         'uses'=>'BidderController@edit' ));
     Route::post('/bidder-update/{project_id}/{id}', array('as' => 'admin_bidder_update',       'uses'=>'BidderController@update' ));
     Route::any('/bidder-delete/{project_id}/{id}',  array('as' => 'admin_bidder_delete',       'uses'=>'BidderController@delete' ));
     Route::any('/getprojectBidder',               array('as' => 'getprojectBidder',            'uses'=>'BidderController@getBidder' ));
     Route::any('/getadminContractor',               array('as' => 'getadminContractor',        'uses'=>'ProjectController@getContractor' ));
     Route::any('/getOnlyContractor',                array('as' => 'getOnlyContractor',         'uses'=>'ProjectController@getOnlyContractor' ));
     
     Route::any('/specs-project-upload-pdf',        array('as' => 'admin_specs_upload_pdf',          'uses'=>'ProjectController@spece_upload_pdf' ));
    Route::any('/project-specs-lists',              array('as' => 'admin_specs_lists',               'uses'=>'ProjectController@spece_lists' ));
    Route::any('/project-specs-remove',             array('as' => 'admin_specs_remove',              'uses'=>'ProjectController@spece_remove' ));
    Route::any('/project-specs-delete',             array('as' => 'admin_specs_delete_individual',   'uses'=>'ProjectController@spece_delete_individual' ));
     
     
     Route::any('/category',                      array('as' => 'admin_category',              'uses'=>'CategoryController@index' ));
     Route::any('/category/edit/{id}',            array('as' => 'admin_category_edit',         'uses'=>'CategoryController@edit' ));
     Route::any('/category/update',               array('as' => 'admin_category_update',       'uses'=>'CategoryController@update' ));
     Route::get('/category/delete/{id}',         array('as' =>'admin_category_delete',        'uses'=> 'CategoryController@delete'));
     
     Route::any('/plan-category',                 array('as' => 'admin_plan_category',              'uses'=>'PlancategoryController@index' ));
     Route::get('/plan-category-create',          array('as' => 'admin_plan_category_create',       'uses'=>'PlancategoryController@create' ));
     Route::post('/plan-category-store',          array('as' => 'admin_plan_category_add',          'uses'=>'PlancategoryController@store' ));
     Route::any('/plan-category/edit/{id}',       array('as' => 'admin_plan_category_edit',         'uses'=>'PlancategoryController@edit' ));
     Route::post('/plan-category/update/{id}',    array('as' => 'admin_plan_category_update',       'uses'=>'PlancategoryController@update' ));
     Route::any('/plan_category-delete/{id}',     array('as' => 'admin_plan_category_delete',       'uses'=>'PlancategoryController@delete' ));
     
     Route::any('/jurisdiction',                  array('as' => 'admin_city',                   'uses'=>'CityController@index' ));
     Route::get('/jurisdiction-create',           array('as' => 'admin_city_create',            'uses'=>'CityController@create' ));
     Route::post('/jurisdiction-store',           array('as' => 'admin_city_add',               'uses'=>'CityController@store' ));
     Route::any('/jurisdiction/edit/{id}',        array('as' => 'admin_city_edit',              'uses'=>'CityController@edit' ));
     Route::any('/jurisdiction/update',           array('as' => 'admin_city_update',            'uses'=>'CityController@update' ));
     
     Route::any('/county',                        array('as' => 'admin_county',                   'uses'=>'CountyController@index' ));
     Route::get('/county-create',                 array('as' => 'admin_county_create',            'uses'=>'CountyController@create' ));
     Route::post('/county-store',                 array('as' => 'admin_county_add',               'uses'=>'CountyController@store' ));
     Route::any('/county/edit/{id}',              array('as' => 'admin_county_edit',              'uses'=>'CountyController@edit' ));
     Route::any('/county/update',                 array('as' => 'admin_county_update',            'uses'=>'CountyController@update' ));
     
     Route::any('/state',                         array('as' => 'admin_state',                   'uses'=>'StateController@index' ));
     Route::get('/state-create',                  array('as' => 'admin_state_create',            'uses'=>'StateController@create' ));
     Route::post('/state-store',                  array('as' => 'admin_state_add',               'uses'=>'StateController@store' ));
     Route::any('/state/edit/{id}',               array('as' => 'admin_state_edit',              'uses'=>'StateController@edit' ));
     Route::any('/state/update',                  array('as' => 'admin_state_update',            'uses'=>'StateController@update' ));
     
     Route::any('/type',                          array('as' => 'admin_type',                   'uses'=>'TypeController@index' ));
     Route::get('/type-create',                   array('as' => 'admin_type_create',            'uses'=>'TypeController@create' ));
     Route::post('/type-store',                   array('as' => 'admin_type_add',               'uses'=>'TypeController@store' ));
     Route::any('/type/edit/{id}',                array('as' => 'admin_type_edit',              'uses'=>'TypeController@edit' ));
     Route::any('/type/update',                   array('as' => 'admin_type_update',            'uses'=>'TypeController@update' ));
     Route::get('/type/delete/{id}',              array('as' =>'admin_type_delete',             'uses'=> 'TypeController@delete'));
     
     Route::any('/subscription',                  array('as' => 'admin_subscription',            'uses'=>'SubscriptionController@index' ));
     Route::any('/subscription/edit/{id}',        array('as' => 'admin_subscription_edit',       'uses'=>'SubscriptionController@edit' ));
     Route::any('/subscription/update',           array('as' => 'admin_subscription_update',      'uses'=>'SubscriptionController@update' ));
     
     Route::any('/emailcampaign',                 array('as' => 'admin_emailcampaign',            'uses'=>'EmailCampaignController@index' ));
     Route::any('/emailcampaign/edit/{id}',       array('as' => 'admin_edit_emailcampaign',       'uses'=>'EmailCampaignController@edit' ));
     Route::any('/emailcampaign/update',          array('as' => 'admin_update_emailcampaign',     'uses'=>'EmailCampaignController@update' ));
     
     Route::any('/specs',                         array('as' => 'admin_specs',              'uses'=>'SpecsController@index' ));
     Route::get('/specs-add',                     array('as' => 'specs_add',                'uses'=>'SpecsController@create' ));
     Route::post('/specs-create',                 array('as' => 'specs_create',             'uses'=>'SpecsController@create_action' ));
     Route::any('/specs/edit/{id}',               array('as' => 'admin_specs_edit',         'uses'=>'SpecsController@edit' ));
     Route::any('/specs/update',                  array('as' => 'admin_specs_update',       'uses'=>'SpecsController@update' ));
     Route::get('/specs/delete/{id}',             array('as' =>'admin_specs_delete',             'uses'=> 'SpecsController@delete'));
     
     Route::any('/contractor',                   array('as' => 'admin_contractor',              'uses'=>'ContractorController@index' ));
     Route::get('/contractor-add',               array('as' => 'contractor_add',                'uses'=>'ContractorController@create' ));
     Route::post('/contractor-create',           array('as' => 'contractor_create',             'uses'=>'ContractorController@create_action' ));
     Route::any('/contractor/edit/{id}',         array('as' => 'admin_contractor_edit',         'uses'=>'ContractorController@edit' ));
     Route::any('/contractor/update',            array('as' => 'admin_contractor_update',       'uses'=>'ContractorController@update' ));
     Route::any('/admin_contractor_delete/{id}', array('as' => 'admin_contractor_delete',  'uses'=>'ContractorController@delete' ));
     
     Route::any('/profession',                  array('as' => 'admin_profession',                   'uses'=>'ProfessionController@index' ));
     Route::get('/profession-create',           array('as' => 'admin_profession_create',            'uses'=>'ProfessionController@create' ));
     Route::post('/profession-store',           array('as' => 'admin_profession_add',               'uses'=>'ProfessionController@store' ));
     Route::any('/profession/edit/{id}',        array('as' => 'admin_profession_edit',              'uses'=>'ProfessionController@edit' ));
     Route::any('/profession/update',           array('as' => 'admin_profession_update',            'uses'=>'ProfessionController@update' ));
     
     Route::any('/csidivision',                  array('as' => 'admin_csidivision',                   'uses'=>'CsidivisionController@index' ));
     Route::get('/csidivision-create',           array('as' => 'admin_csidivision_create',            'uses'=>'CsidivisionController@create' ));
     Route::post('/csidivision-store',           array('as' => 'admin_csidivision_add',               'uses'=>'CsidivisionController@store' ));
     Route::any('/csidivision/edit/{id}',        array('as' => 'admin_csidivision_edit',              'uses'=>'CsidivisionController@edit' ));
     Route::any('/csidivision/update',           array('as' => 'admin_csidivision_update',            'uses'=>'CsidivisionController@update' ));
     
     Route::any('/trade',                       array('as' => 'admin_trade',                   'uses'=>'TradeController@index' ));
     Route::get('/trade-create',                array('as' => 'admin_trade_create',            'uses'=>'TradeController@create' ));
     Route::post('/trade-store',                array('as' => 'admin_trade_add',               'uses'=>'TradeController@store' ));
     Route::any('/trade/edit/{id}',             array('as' => 'admin_trade_edit',              'uses'=>'TradeController@edit' ));
     Route::any('/trade/update',                array('as' => 'admin_trade_update',            'uses'=>'TradeController@update' ));
     
     Route::any('/price',                       array('as' => 'admin_price',                   'uses'=>'PriceController@index' ));
     Route::get('/price-create',                array('as' => 'admin_price_create',            'uses'=>'PriceController@create' ));
     Route::post('/price-store',                array('as' => 'admin_price_add',               'uses'=>'PriceController@store' ));
     Route::any('/price/edit/{id}',             array('as' => 'admin_price_edit',              'uses'=>'PriceController@edit' ));
     Route::any('/price/update',                array('as' => 'admin_price_update',            'uses'=>'PriceController@update' ));
     
     Route::get('/sitesettings',                           array('as' => 'admin_sitesettings', 'uses'=>'SitesettingController@index' ));
     Route::get('/sitesettings/edit/{id}',                 array('as' => 'admin_sitesettings_edit', 'uses'=>'SitesettingController@edit'));
     Route::post('/sitesettings/update-action/{id}',       array('as' => 'admin_sitesettings_update_action', 'uses'=>'SitesettingController@update' ));
     
     
    Route::any( '/cms', array('as' => 'admin_cms', 'uses' => 'CmsController@index') );
    Route::any( '/cms_add', array('as' => 'admin_cms_add', 'uses' => 'CmsController@create') );
    Route::any( '/cms_store', array('as' => 'admin_cms_store', 'uses' => 'CmsController@store') );
    Route::any( '/cms_edit/{id}', array('as' => 'admin_cms_edit', 'uses' => 'CmsController@edit') );
    Route::any( '/cms_update/{id}', array('as' => 'admin_cms_update_action', 'uses' => 'CmsController@update') );
     
     
     
    Route::any('/role',                               array('as' => 'admin_role',        'uses'=>'RolemanagentController@index' ));
    Route::get('/role/create',                        array('as' => 'admin_role_create', 'uses'=>'RolemanagentController@create' ));
    Route::post('/role/store',                        array('as' => 'admin_role_store',  'uses'=>'RolemanagentController@store' ));
    Route::get('/role/edit/{id}',                     array('as' => 'admin_role_edit',   'uses'=>'RolemanagentController@edit' ));
    Route::post('/role/update',                       array('as' => 'admin_role_update', 'uses'=>'RolemanagentController@update' ));
    Route::any('/role/delete/{id}',                   array('as' => 'admin_role_delete', 'uses'=>'RolemanagentController@delete' ));
    Route::get('/role/permission_role_assign',        array('as' => 'permission_role_assign', 'uses'=>'RolemanagentController@permission_role_assign' ));
    Route::post('/role/permission_user_assign_store', array('as' => 'permission_user_assign_store', 'uses'=>'RolemanagentController@permission_user_assign_store' ));
     
    Route::any('/permit-type',                     array('as' => 'admin_permittype',        'uses'=>'PermittypeController@index' ));
    Route::get('/permit-type-create',              array('as' => 'admin_permittype_create', 'uses'=>'PermittypeController@create' ));
    Route::post('/permit-type-store',              array('as' => 'admin_permittype_add',    'uses'=>'PermittypeController@store' ));
    Route::any('/permit-type/edit/{id}',           array('as' => 'admin_permittype_edit',   'uses'=>'PermittypeController@edit' ));
    Route::post('/permit-type/update/{id}',        array('as' => 'admin_permittype_update', 'uses'=>'PermittypeController@update' ));
    Route::any('/permit-type-delete/{id}',         array('as' => 'admin_permittype_delete', 'uses'=>'PermittypeController@delete' ));
    
    Route::any('/permit-owner',                     array('as' => 'admin_permitowner',       'uses'=>'PermitownerController@index' ));
    Route::get('/permit-owner-create',              array('as' => 'admin_permitowner_create','uses'=>'PermitownerController@create' ));
    Route::post('/permit-owner-store',              array('as' => 'admin_permitowner_add',   'uses'=>'PermitownerController@store' ));
    Route::any('/permit-owner/edit/{id}',           array('as' => 'admin_permitowner_edit',  'uses'=>'PermitownerController@edit' ));
    Route::post('/permit-owner/update/{id}',        array('as' => 'admin_permitowner_update','uses'=>'PermitownerController@update' ));
    Route::any('/permit-owner-delete/{id}',         array('as' => 'admin_permitowner_delete','uses'=>'PermitownerController@delete' ));
     
    Route::any('/building-report',                     array('as' => 'admin_buildingreport',               'uses'=>'BuildingreportController@index' ));
    Route::get('/building-report-create',              array('as' => 'admin_buildingreport_create',        'uses'=>'BuildingreportController@create' ));
    Route::post('/building-report-store',              array('as' => 'admin_buildingreport_add',           'uses'=>'BuildingreportController@store' ));
    Route::any('/building-report-contractor/{id}',     array('as' => 'admin_buildingreport_contractor',    'uses'=>'BuildingreportController@contractor' ));
    Route::any('/building-report-owner/{id}',          array('as' => 'admin_buildingreport_owner',         'uses'=>'BuildingreportController@permit_owner' ));
    Route::any('/building-report-permit/{id}',         array('as' => 'admin_buildingreport_permit',        'uses'=>'BuildingreportController@permit' ));
    Route::any('/building-report/edit/{id}',           array('as' => 'admin_buildingreport_edit',          'uses'=>'BuildingreportController@edit' ));
    Route::post('/building-report/update/{id}',        array('as' => 'admin_buildingreport_update',        'uses'=>'BuildingreportController@update' ));
    Route::any('/building-report-delete/{id}',         array('as' => 'admin_buildingreport_delete',        'uses'=>'BuildingreportController@delete' ));
    
     Route::any('/building-report-details/{id}',         array('as' => 'admin_buildingreport_details',        'uses'=>'ProjectController@details' ));
     Route::any('/building-report-contractors-view/{id}', array('as' => 'admin_buildingreport_contractors_view','uses'=>'ProjectController@contractors_view' ));
     Route::any('/building-report-owner-view/{id}',    array('as' => 'admin_buildingreport_owner_view',   'uses'=>'ProjectController@owner_view' ));
     Route::any('/building-report-permit-view/{id}',    array('as' => 'admin_buildingreport_permit_view',   'uses'=>'ProjectController@permit_view' ));
     
     Route::any('/planroom-trade',                     array('as' => 'admin_planroom_trade',       'uses'=>'PlanroomtradeController@index' ));
     Route::get('/planroom-trade-create',              array('as' => 'admin_planroom_trade_create','uses'=>'PlanroomtradeController@create' ));
     Route::post('/planroom-trade-store',              array('as' => 'admin_planroom_trade_add',   'uses'=>'PlanroomtradeController@store' ));
     Route::any('/planroom-trade/edit/{id}',           array('as' => 'admin_planroom_trade_edit',  'uses'=>'PlanroomtradeController@edit' ));
     Route::post('/planroom-trade/update/{id}',        array('as' => 'admin_planroom_trade_update','uses'=>'PlanroomtradeController@update' ));
     Route::any('/planroom-trade-delete/{id}',         array('as' => 'admin_planroom_trade_delete','uses'=>'PlanroomtradeController@delete' ));
     
     Route::any('/jurisdictions',                     array('as' => 'admin_jurisdictions',        'uses'=>'JurisdictionController@index' ));
     Route::get('/jurisdictions-create',              array('as' => 'admin_jurisdictions_create', 'uses'=>'JurisdictionController@create' ));
     Route::post('/jurisdictions-store',              array('as' => 'admin_jurisdictions_add',    'uses'=>'JurisdictionController@store' ));
     Route::any('/jurisdictions/edit/{id}',           array('as' => 'admin_jurisdictions_edit',   'uses'=>'JurisdictionController@edit' ));
     Route::post('/jurisdictions/update/{id}',        array('as' => 'admin_jurisdictions_update', 'uses'=>'JurisdictionController@update' ));
     Route::any('/jurisdictions-delete/{id}',         array('as' => 'admin_jurisdictions_delete', 'uses'=>'JurisdictionController@delete' ));
     
     
     Route::any('/order-list',                           array('as' => 'admin_order_list',              'uses'=>'OrderController@index' ));
     Route::any('/order/view/{id}',                      array('as' => 'admin_order_view',              'uses'=>'OrderController@view' ));
     
     
     Route::any('/private-plan-category',                 array('as' => 'admin_private_plan_category',              'uses'=>'PrivateplancategoryController@index' ));
     Route::get('/private-plan-category-create',          array('as' => 'admin_private_plan_category_create',       'uses'=>'PrivateplancategoryController@create' ));
     Route::post('/private-plan-category-store',          array('as' => 'admin_private_plan_category_add',          'uses'=>'PrivateplancategoryController@store' ));
     Route::any('/private-plan-category/edit/{id}',       array('as' => 'admin_private_plan_category_edit',         'uses'=>'PrivateplancategoryController@edit' ));
     Route::post('/private-plan-category/update/{id}',    array('as' => 'admin_private_plan_category_update',       'uses'=>'PrivateplancategoryController@update' ));
     Route::any('/private-plan_category-delete/{id}',     array('as' => 'admin_private_plan_category_delete',       'uses'=>'PrivateplancategoryController@delete' ));
     
     
     Route::any('/private-specs-category',                 array('as' => 'admin_private_specs_category',              'uses'=>'PrivatespecscategoryController@index' ));
     Route::get('/private-specs-category-create',          array('as' => 'admin_private_specs_category_create',       'uses'=>'PrivatespecscategoryController@create' ));
     Route::post('/private-specs-category-store',          array('as' => 'admin_private_specs_category_add',          'uses'=>'PrivatespecscategoryController@store' ));
     Route::any('/private-specs-category/edit/{id}',       array('as' => 'admin_private_specs_category_edit',         'uses'=>'PrivatespecscategoryController@edit' ));
     Route::post('/private-specs-category/update/{id}',    array('as' => 'admin_private_specs_category_update',       'uses'=>'PrivatespecscategoryController@update' ));
     Route::any('/private-specs_category-delete/{id}',     array('as' => 'admin_private_specs_category_delete',       'uses'=>'PrivatespecscategoryController@delete' ));
     
     Route::any('/private-project',                        array('as' => 'admin_private_project',                     'uses'=>'PrivateprojectController@index' ));
     Route::any('/private-company',                        array('as' => 'admin_private_company',                     'uses'=>'PrivateprojectController@company' ));
     Route::any('/private-company-edit/{id}',              array('as' => 'admin_private_company_edit',                'uses'=>'PrivateprojectController@company_edit' ));
     Route::any('/private-project-details/{id}',           array('as' => 'admin_private_project_details',             'uses'=>'PrivateprojectController@details' ));
     Route::any('/private-project-plans/{id}',                              array('as' => 'admin_private_project_plans',            'uses'=>'PrivateprojectController@plan_update' ));
     Route::any('/admin_private-project_plan_delete/{id}/{project_id}',     array('as' => 'admin_private_project_plans_delete',     'uses'=>'PrivateprojectController@plan_delete' ));
     Route::any('/admin_private_cat_plans_delete/{cat_id}/{project_id}',    array('as' => 'admin_private_cat_plans_delete',         'uses'=>'PrivateprojectController@plan_cat_delete' ));
     Route::any('/private-project-speces/{id}',                             array('as' => 'admin_private_project_speces',           'uses'=>'PrivateprojectController@speces_update' ));
     Route::any('/private-project-speces-delete/{id}/{project_id}',         array('as' => 'admin_private_project_speces_delete',    'uses'=>'PrivateprojectController@delete_speces' ));
     Route::any('/admin_private_speces_cat_delete/{cat_id}/{project_id}',   array('as' => 'admin_private_speces_cat_delete',        'uses'=>'PrivateprojectController@speces_cat_delete' ));
     Route::any('/admin-assign-private-project/{id}',                       array('as' => 'admin_assign_private_project',           'uses'=>'PrivateprojectController@assign_project' ));
     Route::any('/private-project-delete/{id}',                             array('as' => 'admin_private_project_delete',           'uses'=>'PrivateprojectController@delete' ));
    
    Route::any('/private-project-upload-pdf',                               array('as' => 'admin_project_upload_pdf',               'uses'=>'PrivateprojectController@project_upload_pdf' ));
    Route::any('/private-project-plan-lists',                               array('as' => 'admin_project_plan_lists',               'uses'=>'PrivateprojectController@plan_lists' ));
    Route::any('/private-project-plans-remove',                             array('as' => 'admin_project_plan_remove',              'uses'=>'PrivateprojectController@plan_remove' ));
    Route::any('/private-project-plan-delete',                              array('as' => 'admin_project_plan_delete_individual',   'uses'=>'PrivateprojectController@plan_delete_individual' ));
    
    Route::any('/private-specs-project-upload-pdf',                         array('as' => 'admin_specs_project_upload_pdf',          'uses'=>'PrivateprojectController@spece_upload_pdf' ));
    Route::any('/private-project-specs-lists',                              array('as' => 'admin_project_specs_lists',               'uses'=>'PrivateprojectController@spece_lists' ));
    Route::any('/private-project-specs-remove',                             array('as' => 'admin_project_specs_remove',              'uses'=>'PrivateprojectController@spece_remove' ));
    Route::any('/private-project-specs-delete',                             array('as' => 'admin_project_specs_delete_individual',   'uses'=>'PrivateprojectController@spece_delete_individual' ));
     
     
     
    Route::any('/private-project-details-view/{id}',    array('as' => 'admin_private_project_details_view',   'uses'=>'PrivateprojectController@details_view' ));
    Route::any('/private-project-company-view/{id}',    array('as' => 'admin_private_project_company_view',   'uses'=>'PrivateprojectController@company_view' ));
    Route::any('/private-project-speces-view/{id}',     array('as' => 'admin_private_project_speces_view',    'uses'=>'PrivateprojectController@speces_view' ));
    Route::any('/private-project-plan-view/{id}',       array('as' => 'admin_private_project_plan_view',      'uses'=>'PrivateprojectController@plan_view' ));
    
    Route::any('/private-users',             array('as' => 'private_users',       'uses'=>'PrivateuserController@lists' ));
    Route::get('/private-users-add',         array('as' => 'private_users_add',   'uses'=>'PrivateuserController@add' ));
    Route::get('/private-users-add/{id}',    array('as' => 'private_users_add_from_project',   'uses'=>'PrivateuserController@add' ));
    Route::post('/private-user-create',      array('as' => 'private_user_create', 'uses'=>'PrivateuserController@create' ));
    Route::any('/private-users-edit/{id}',   array('as' => 'private_users_edit',  'uses'=>'PrivateuserController@edit' ));
    Route::any('/private-users-update/{id}', array('as' => 'private_user_update', 'uses'=>'PrivateuserController@update' ));
    Route::any('/private-users-delete/{id}', array('as' => 'private_users_delete','uses'=>'PrivateuserController@delete' ));

    Route::any('/private-company-list',            array('as' => 'admin_private_company_list',           'uses'=>'PrivatecompanyController@index' ));
    Route::any('/private-company/edit/{id}',       array('as' => 'admin_privatecompany_edit',       'uses'=>'PrivatecompanyController@edit' ));
    Route::any('/private-company-delete/{id}',     array('as' => 'admin_private_company_delete',    'uses'=>'PrivatecompanyController@delete' ));
    
    Route::any('/private-order-list',                           array('as' => 'private_admin_order_list',              'uses'=>'PrivateOrderController@index' ));
    Route::any('/private-order/view/{id}',                      array('as' => 'private_admin_order_view',              'uses'=>'PrivateOrderController@view' ));

    Route::any('/bidder-database-list',             array('as' => 'admin_bidder_database_list',     'uses'=>'BidderDatabaseController@index' ));
    Route::any('/bidder-database-edit/{id}',        array('as' => 'admin_bidder_database_edit',     'uses'=>'BidderDatabaseController@edit' ));
    Route::post('/bidder-database-update/{id}',     array('as' => 'admin_bidder_database_update',   'uses'=>'BidderDatabaseController@update' ));
    Route::any('/bidder-database-delete/{id}',      array('as' => 'admin_bidder_database_delete',   'uses'=>'BidderDatabaseController@delete' ));
    Route::any('/getProjectId',                     array('as' => 'getprojectid',                   'uses'=>'BidderDatabaseController@getprojectid' ));
});


Route::any('/{company_slug}',                   array('as' => 'private_planroom_login',  'uses'=>'PrivatePlanroomController@login' ));
