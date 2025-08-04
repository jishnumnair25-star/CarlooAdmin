<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FastoAdminController;
Route::get('/toggle-theme', function () {
    $current = session('theme', 'light');
    session(['theme' => $current === 'dark' ? 'light' : 'dark']);
    return back();
})->name('toggle.theme');
// Default route — show login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Dashboard route
Route::get('/index', [DashboardController::class, 'show'])->name('dashboard.index');
 Route::get('/projects',[DashboardController::class,'projects'])->name('projects.list');;
  Route::get('/ui-card',[DashboardController::class,'ui_card']);

  Route::get('/ui-card', [DashboardController::class, 'ui_card'])->name('ui_card');
    // Route::get('/table-bootstrap-basic',[FastoAdminController::class,'table_bootstrap_basic']);
  Route::get('/project_view/{id}', [DashboardController::class, 'view'])->name('project.view');
Route::get('/project_view/{id}/tab/{tab}', [DashboardController::class, 'loadTabContent']);
Route::post('/project/create', [DashboardController::class, 'createProject'])->name('project.create');
// routes/web.php
Route::get('/table-bootstrap-basic', [DashboardController::class, 'subscription'])
    ->name('fasto.table.bootstrap-basic');

  Route::get('/ui-alert',[DashboardController::class,'ui_alert']);
 Route::get('/table-datatable-basic',[DashboardController::class,'table_datatable_basic']);

// Route::controller(FastoAdminController::class)->group(function() {
//       Route::get('/','login');
//     Route::get('/index','dashboard');
    
//     Route::get('/index-2','dashboard_2');
    // Route::get('/projects','projects');
//     Route::get('/contacts','contacts');
//     Route::get('/kanban','kanban');
//     Route::get('/calendar','calendar');
//     Route::get('/messages','messages');
//     Route::get('/app-profile','app_profile');
//     Route::match(['get','post'],'/post-details','post_details');
//     Route::match(['get','post'],'/email-compose','email_compose');
//     Route::get('/email-inbox','email_inbox');
//     Route::get('/email-read','email_read');
//     Route::get('/app-calender','app_calender');
//     Route::get('/ecom-product-grid','ecom_product_grid');
//     Route::get('/ecom-product-list','ecom_product_list');
//     Route::get('/ecom-product-detail','ecom_product_detail');
//     Route::get('/ecom-product-order','ecom_product_order');
//     Route::get('/ecom-checkout','ecom_checkout');
//     Route::get('/ecom-invoice','ecom_invoice');
//     Route::get('/ecom-customers','ecom_customers');
//     Route::get('/chart-flot','chart_flot');
//     Route::get('/chart-morris','chart_morris');
//     Route::get('/chart-chartjs','chart_chartjs');
//     Route::get('/chart-chartist','chart_chartist');
//     Route::get('/chart-sparkline','chart_sparkline');
//     Route::get('/chart-peity','chart_peity');
//     Route::get('/ui-accordion','ui_accordion');
//     Route::get('/ui-alert','ui_alert');
//     Route::get('/ui-badge','ui_badge');
//     Route::get('/ui-button','ui_button');
//     Route::get('/ui-modal','ui_modal');
//     Route::get('/ui-button-group','ui_button_group');
//     Route::get('/ui-list-group','ui_list_group');
//     Route::get('/ui-media-object','ui_media_object');
//     Route::get('/ui-card','ui_card');
//     Route::get('/ui-carousel','ui_carousel');
//     Route::get('/ui-dropdown','ui_dropdown');
//     Route::get('/ui-popover','ui_popover');
//     Route::get('/ui-progressbar','ui_progressbar');
//     Route::get('/ui-tab','ui_tab');
//     Route::get('/ui-typography','ui_typography');
//     Route::get('/ui-pagination','ui_pagination');
//     Route::get('/ui-grid','ui_grid');
//     Route::get('/uc-select2','uc_select2');
//     Route::get('/uc-nestable','uc_nestable');
//     Route::get('/uc-noui-slider','uc_noui_slider');
//     Route::get('/uc-sweetalert','uc_sweetalert');
//     Route::get('/uc-toastr','uc_toastr');
//     Route::get('/map-jqvmap','map_jqvmap');
//     Route::get('/uc-lightgallery','uc_lightgallery');
//     Route::get('/widget-basic','widget_basic');
//     Route::get('/form-element','form_element');
//     Route::get('/form-wizard','form_wizard');
//     Route::get('/ckeditor','form_ckeditor');
//     Route::get('/form-pickers','form_pickers');
//     Route::get('/form-validation-jquery','form_validation_jquery');
//     Route::get('/table-bootstrap-basic','table_bootstrap_basic');
//     Route::get('/table-datatable-basic','table_datatable_basic');
//     Route::get('/page-register','page_register');
   
//     Route::get('/page-error-400','page_error_400');
//     Route::get('/page-error-403','page_error_403');
//     Route::get('/page-error-404','page_error_404');
//     Route::get('/page-error-500','page_error_500');
//     Route::get('/page-error-503','page_error_503');
//     Route::get('/page-lock-screen','page_lock_screen');
//     Route::get('/page-forgot-password','page_forgot_password');
//     Route::post('/ajax/contact-list','contact_list_ajax');
    
// });
// -----------------------------------------Api Connection-----------------------------------------------------------/



