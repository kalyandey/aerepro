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

Route::any('/',                                     array('as' => 'planroom',                         'uses'=>'PlanroomController@index' ));
Route::any('/reset-password',                       array('as' => 'reset-password',                   'uses'=>'ResetpwdController@index' ));
Route::any('/user-forgot-pwd',                      array('as'=>'user_forgotpwd_action',              'uses'=>'ResetpwdController@user_forgotpwd_action'));
Route::get('/reset/{token}',                        array('as' => 'user_reset_newpassword',               'uses'=> 'ResetpwdController@password_reset' ));
Route::post('/reset/{token}',                       array('as' => 'user_password_update',                 'uses'=> 'ResetpwdController@password_update' ));

Route::group(array('middleware' => 'user'), function (){
    Route::any('/dashboard',                    array('as' => 'dashboard',                  'uses'=>'UserController@dashboard' ));
    Route::any('/logout',                       array('as' => 'logout',                     'uses'=>'UserController@logout' ));
    Route::any('/edit_customer_profile',        array('as' => 'edit_customer_profile',      'uses'=>'UserController@edit_customer_profile' ));
    Route::any('/update_customer_profile',      array('as' => 'update_customer_profile',    'uses'=>'UserController@update_customer_profile' ));
    Route::any('/change_password',              array('as' => 'change_password',            'uses'=>'UserController@change_password' ));
    Route::any('/change_password_update',       array('as' => 'change_password_update',     'uses'=>'UserController@change_password_update' ));
    Route::any('/planroom-list',                array('as' => 'planroom_list',              'uses'=>'PlanroomController@lists' ));
    Route::any('/tracking',                     array('as' => 'tracking',                   'uses'=>'PlanroomController@tracking' ));
    Route::any('/details',                      array('as' => 'project_details',            'uses'=>'PlanroomController@details' ));
});

Route::any('/register',              array('as' => 'register',              'uses'=>'UserController@register' ));
Route::post('/register_post',        array('as' => 'register_post',         'uses'=>'UserController@register_post' ));
Route::any('/more-info',             array('as' => 'register_moreinfo',     'uses'=>'UserController@more_info' ));
Route::any('/thankyou',              array('as' => 'thankyou',              'uses'=>'UserController@thankyou' ));
Route::any('/active_user/{token}',  array('as' => 'active_user',            'uses'=>'UserController@active_user' ));
Route::any('/login',                 array('as' => 'login',                 'uses'=>'UserController@login' ));
Route::any('/free_consultant_action',                 array('as' => 'free_consultant_action',                 'uses'=>'UserController@free_consultant_action' ));

Route::group(array('prefix'=>'admin','namespace' => 'admin'), function (){
     Route::any('/',                            array('as' => 'admin_login',              'uses'=>'LoginController@index' ));
     Route::get('/forgot-password',             array('as' => 'admin_forgot_password',      'uses'=>'LoginController@admin_forgot_password' ));
     Route::post('/forgot-password-action',     array('as' => 'admin_forgot_password_action',      'uses'=>'LoginController@admin_forgot_password_action' ));
});
Route::group(array('prefix'=>'admin','namespace' => 'admin','middleware' => 'admin'), function (){
     Route::any('/dashboard',                   array('as' => 'admin_dashboard',            'uses'=>'DashboardController@index' ));
     Route::get('/profile',                     array('as' => 'admin_profile',              'uses'=>'DashboardController@profile' ));
     Route::post('/profile-update',             array('as' => 'admin_profile_update',       'uses'=>'DashboardController@profile_update' ));
     Route::get('/change-password',             array('as' => 'admin_change_password',      'uses'=>'DashboardController@change_password' ));
     Route::post('/change-password-action',     array('as' => 'admin_change_password_action',      'uses'=>'DashboardController@change_password_action' ));
     Route::any('/logout',                      array('as' => 'admin_logout',               'uses'=>'DashboardController@logout' ));
     
     Route::any('/admin-users',                   array('as' => 'admin_users',              'uses'=>'UserController@admin_users_list' ));
     Route::get('/admin-users-add',               array('as' => 'admin_users_add',          'uses'=>'UserController@admin_users_add' ));
     Route::post('/admin-user-create',           array('as' => 'admin_user_create',        'uses'=>'UserController@admin_user_create' ));
     Route::any('/admin-users-edit/{id}',        array('as' => 'admin_users_edit',         'uses'=>'UserController@admin_users_edit' ));
     Route::any('/admin-users-update',           array('as' => 'admin_user_update',         'uses'=>'UserController@admin_user_update' ));
     Route::any('/admin-users-delete/{id}',       array('as' => 'admin_users_delete',       'uses'=>'UserController@admin_users_delete' ));
     
     
     Route::any('/front-users',                   array('as' => 'front_users',              'uses'=>'UserController@front_users_list' ));
     Route::get('/front-users-add',               array('as' => 'front_users_add',          'uses'=>'UserController@front_users_add' ));
     Route::post('/front-user-create',           array('as' => 'front_user_create',        'uses'=>'UserController@front_user_create' ));
     Route::any('/front-users-edit/{id}',        array('as' => 'front_users_edit',         'uses'=>'UserController@front_users_edit' ));
     Route::any('/front-users-update',           array('as' => 'front_user_update',         'uses'=>'UserController@front_user_update' ));
     Route::any('/front-users-delete/{id}',       array('as' => 'front_users_delete',       'uses'=>'UserController@front_users_delete' ));
     
     
     
     Route::any('/project',                      array('as' => 'admin_project',              'uses'=>'ProjectController@lists' ));
     Route::get('/project-create',               array('as' => 'admin_project_create',       'uses'=>'ProjectController@create' ));
     Route::post('/project-store',               array('as' => 'admin_project_post',         'uses'=>'ProjectController@store' ));
     Route::any('/project-awarded-to/{id}',      array('as' => 'admin_project_awarded_to',   'uses'=>'ProjectController@awarded_to' ));
     Route::any('/project-address/{id}',         array('as' => 'admin_project_address',      'uses'=>'ProjectController@address_update' ));
     Route::any('/project-principle/{id}',       array('as' => 'admin_project_principle',    'uses'=>'ProjectController@principle_update' ));
     Route::any('/project-contractor/{id}',      array('as' => 'admin_project_contractor',   'uses'=>'ProjectController@contractor_update' ));
     Route::any('/project-plans/{id}',           array('as' => 'admin_project_plans',        'uses'=>'ProjectController@plan_update' ));
     Route::any('/admin_project_plan_delete/{id}/{project_id}',array('as' => 'admin_project_plans_delete','uses'=>'ProjectController@plan_delete' ));
     Route::any('/project-speces/{id}',          array('as' => 'admin_project_speces',       'uses'=>'ProjectController@speces_update' ));
     Route::any('/project-speces-delete/{id}/{project_id}',   array('as' => 'admin_project_speces_delete','uses'=>'ProjectController@delete_speces' ));   
     Route::any('/project-edit/{id}',            array('as' => 'admin_project_edit',         'uses'=>'ProjectController@edit' ));
     Route::any('/project-delete/{id}',          array('as' => 'admin_project_delete',       'uses'=>'ProjectController@delete' ));
     
     Route::any('/project-details/{id}',         array('as' => 'admin_project_details',        'uses'=>'ProjectController@details' ));
     Route::any('/project-awarded-to-view/{id}', array('as' => 'admin_project_awarded_to_view','uses'=>'ProjectController@awarded_to_view' ));
     Route::any('/project-address-view/{id}',    array('as' => 'admin_project_address_view',   'uses'=>'ProjectController@address_view' ));
     Route::any('/project-principle-view/{id}',  array('as' => 'admin_project_principle_view', 'uses'=>'ProjectController@principle_view' ));
     Route::any('/project-contrctor-view/{id}',  array('as' => 'admin_project_contrctor_view', 'uses'=>'ProjectController@contrctor_view' ));
     Route::any('/project-speces-view/{id}',     array('as' => 'admin_project_speces_view',    'uses'=>'ProjectController@speces_view' ));
     Route::any('/project-plan-view/{id}',       array('as' => 'admin_project_plan_view',      'uses'=>'ProjectController@plan_view' ));
     
     Route::any('/category',                      array('as' => 'admin_category',              'uses'=>'CategoryController@index' ));
     Route::any('/category/edit/{id}',            array('as' => 'admin_category_edit',         'uses'=>'CategoryController@edit' ));
     Route::any('/category/update',               array('as' => 'admin_category_update',       'uses'=>'CategoryController@update' ));
     
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
     Route::any('/type/edit/{id}',                array('as' => 'admin_type_edit',              'uses'=>'TypeController@edit' ));
     Route::any('/type/update',                   array('as' => 'admin_type_update',            'uses'=>'TypeController@update' ));
     
     Route::any('/subscription',                  array('as' => 'admin_subscription',            'uses'=>'SubscriptionController@index' ));
     Route::any('/subscription/edit/{id}',        array('as' => 'admin_subscription_edit',       'uses'=>'SubscriptionController@edit' ));
     Route::any('/subscription/update',           array('as' => 'admin_subscription_update',      'uses'=>'SubscriptionController@update' ));
     
     Route::any('/specs',                   array('as' => 'admin_specs',              'uses'=>'SpecsController@index' ));
     Route::get('/specs-add',               array('as' => 'specs_add',                'uses'=>'SpecsController@create' ));
     Route::post('/specs-create',           array('as' => 'specs_create',             'uses'=>'SpecsController@create_action' ));
     Route::any('/specs/edit/{id}',         array('as' => 'admin_specs_edit',         'uses'=>'SpecsController@edit' ));
     Route::any('/specs/update',            array('as' => 'admin_specs_update',       'uses'=>'SpecsController@update' ));
     
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
            
});

