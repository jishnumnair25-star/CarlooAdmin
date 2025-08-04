<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class FastoAdminController extends Controller{

    // DASHBOARD
    public function dashboard(){
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        return view('fasto.dashboard.index', compact('page_title', 'page_description'));
    }
    
    // DASHBOARD 2 
    public function dashboard_2(){
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        return view('fasto.dashboard.index_2', compact('page_title', 'page_description'));
    }
    
    // PROJECTS
    public function projects(){
        $page_title = 'Projects';
        $page_description = 'Some description for the page';
        return view('fasto.dashboard.projects', compact('page_title', 'page_description'));
    }
    
    // CONTACTS
    public function contacts(){
        $page_title = 'Contacts';
        $page_description = 'Some description for the page';
        return view('fasto.dashboard.contacts', compact('page_title', 'page_description'));
    }
    
    // KANBAN
    public function kanban(){
        $page_title = 'Kanban';
        $page_description = 'Some description for the page';
        return view('fasto.dashboard.kanban', compact('page_title', 'page_description'));
    }

    // CALENDAR
    public function calendar(){
        $page_title = 'Calendar';
        $page_description = 'Some description for the page';
		return view('fasto.dashboard.calendar', compact('page_title', 'page_description'));
    }

    // MESSAGES
    public function messages(){
        $page_title = 'Messages';
        $page_description = 'Some description for the page';
        return view('fasto.dashboard.messages', compact('page_title', 'page_description'));
    }
    
    // APP PROFILE
    public function app_profile(){
        $page_title = 'App Profile';
        $page_description = 'Some description for the page';
        return view('fasto.app.profile', compact('page_title', 'page_description'));
    }

    // POST DETAILS
    public function post_details(){
        $page_title = 'Post Details';
        $page_description = 'Some description for the page';
        return view('fasto.app.post_details', compact('page_title', 'page_description'));
    }

    // EMAIL COMPOSE
    public function email_compose(){
        $page_title = 'Compose';
        $page_description = 'Some description for the page';
        return view('fasto.message.compose', compact('page_title', 'page_description'));
    }
	
    // EMAIL INBOX
    public function email_inbox(){
        $page_title = 'Inbox';
        $page_description = 'Some description for the page';
        return view('fasto.message.inbox', compact('page_title', 'page_description'));
    }
	
    // EMAIL READ
    public function email_read(){
        $page_title = 'Read';
        $page_description = 'Some description for the page';
        return view('fasto.message.read', compact('page_title', 'page_description'));
    }

    // CALENDAR
    public function app_calender(){
        $page_title = 'Calendar';
        $page_description = 'Some description for the page';
        return view('fasto.app.calender', compact('page_title', 'page_description'));
    }
    
    // ECOMMERCE CHECKOUT
    public function ecom_checkout(){
        $page_title = 'Checkout';
        $page_description = 'Some description for the page';
        return view('fasto.ecom.checkout', compact('page_title', 'page_description'));
    }
	
    // ECOMMERCE CUSTOMERS
    public function ecom_customers(){
        $page_title = 'Customers';
        $page_description = 'Some description for the page';
        return view('fasto.ecom.customers', compact('page_title', 'page_description'));
    }
	
    // ECOMMERCE INVOICE
    public function ecom_invoice(){
        $page_title = 'Invoice';
        $page_description = 'Some description for the page';
        return view('fasto.ecom.invoice', compact('page_title', 'page_description'));
    }
	
    // ECOMMERCE PRODUCT DETAIL
    public function ecom_product_detail(){
        $page_title = 'Product Details';
        $page_description = 'Some description for the page';
        return view('fasto.ecom.product_detail', compact('page_title', 'page_description'));
    }
	
    // ECOMMERCE PRODUCT GRID
    public function ecom_product_grid(){
        $page_title = 'Product Grid';
        $page_description = 'Some description for the page';
        return view('fasto.ecom.product_grid', compact('page_title', 'page_description'));
    }
	
    // ECOMMERCE PRODUCT LIST
    public function ecom_product_list(){
        $page_title = 'Product List';
        $page_description = 'Some description for the page';
        return view('fasto.ecom.product_list', compact('page_title', 'page_description'));
    }
	
    // ECOMMERCE PRODUCT ORDER
    public function ecom_product_order(){
        $page_title = 'Product Order';
        $page_description = 'Some description for the page';
        return view('fasto.ecom.product_order', compact('page_title', 'page_description'));
    }
	
    // CHART CHARTIST
    public function chart_chartist(){
        $page_title = 'Chart Chartist';
     $page_description = 'Some description for the page';
        return view('fasto.chart.chartist', compact('page_title', 'page_description'));
    }
	
    // CHART CHARTJS
    public function chart_chartjs(){
        $page_title = 'Chart Chartjs';
        $page_description = 'Some description for the page';
        return view('fasto.chart.chartjs', compact('page_title', 'page_description'));
    }
	
    // CHART FLOT
    public function chart_flot(){
        $page_title = 'Chart Flot';
        $page_description = 'Some description for the page';
        return view('fasto.chart.flot', compact('page_title', 'page_description'));
    }
	
    // CHART MORRIS
    public function chart_morris(){
        $page_title = 'Chart Morris';
        $page_description = 'Some description for the page';
        return view('fasto.chart.morris', compact('page_title', 'page_description'));
    }
	
    // CHART PEITY
    public function chart_peity(){
        $page_title = 'Chart Peity';
        $page_description = 'Some description for the page';
        return view('fasto.chart.peity', compact('page_title', 'page_description'));
    }
	
    // CHART SPARKLINE
    public function chart_sparkline(){
        $page_title = 'Chart Sparkline';
        $page_description = 'Some description for the page';
        return view('fasto.chart.sparkline', compact('page_title', 'page_description'));
    }
	
    // FORM EDITOR SUMMERNOTE
    public function form_ckeditor(){
        $page_title = 'Form Ckeditor';
        $page_description = 'Some description for the page';
        return view('fasto.form.ckeditor', compact('page_title', 'page_description'));
	}
	
    // FORM ELEMENT
    public function form_element(){
        $page_title = 'Form Element';
        $page_description = 'Some description for the page';
        return view('fasto.form.element', compact('page_title', 'page_description'));
    }
	
    // FORM PICKERS
    public function form_pickers(){
        $page_title = 'Form Pickers';
        $page_description = 'Some description for the page';
        return view('fasto.form.pickers', compact('page_title', 'page_description'));
    }
	
    // FORM VALIDATION JQUERY
    public function form_validation_jquery(){
        $page_title = 'Form Validation';
        $page_description = 'Some description for the page';
        return view('fasto.form.validation_jquery', compact('page_title', 'page_description'));
    }
	
    // FORM WIZARD
    public function form_wizard(){
        $page_title = 'Form Wizard';
        $page_description = 'Some description for the page';
        return view('fasto.form.wizard', compact('page_title', 'page_description'));
    }
    
    	
    // MAP JQVMAP
    public function map_jqvmap(){
        $page_title = 'Jqv Map';
        $page_description = 'Some description for the page';
        return view('fasto.map.jqvmap', compact('page_title', 'page_description'));
    }
	
    // PAGE ERROR 400
    public function page_error_400(){
        $page_title = 'Page Error 400';
        $page_description = 'Some description for the page';
        return view('fasto.page.error_400', compact('page_title', 'page_description'));
    }
	
    // PAGE ERROR 403
    public function page_error_403(){
        $page_title = 'Page Error 403';
        $page_description = 'Some description for the page';
        return view('fasto.page.error_403', compact('page_title', 'page_description'));
    }
	
    // PAGE ERROR 404
    public function page_error_404(){
        $page_title = 'Page Error 404';
        $page_description = 'Some description for the page';
        return view('fasto.page.error_404', compact('page_title', 'page_description'));
    }
	
    // PAGE ERROR 500
    public function page_error_500(){
        $page_title = 'Page Error 500';
        $page_description = 'Some description for the page';
        return view('fasto.page.error_500', compact('page_title', 'page_description'));
    }
	
    // PAGE ERROR 503
    public function page_error_503(){
        $page_title = 'Page Error 503';
        $page_description = 'Some description for the page';
        return view('fasto.page.error_503', compact('page_title', 'page_description'));
    }
	
    // PAGE FORGOT PASSWORD
    public function page_forgot_password(){
        $page_title = 'Page Forgot Password';
        $page_description = 'Some description for the page';
        return view('fasto.page.forgot_password', compact('page_title', 'page_description'));
    }
	
    // PAGE LOCK SCREEN
    public function page_lock_screen(){
        $page_title = 'Page Lock Screen';
        $page_description = 'Some description for the page';
        return view('fasto.page.lock_screen', compact('page_title', 'page_description'));
    }
	
    // PAGE LOGIN
    public function login(){
        $page_title = 'Page Login';
        $page_description = 'Some description for the page';
        return view('auth.login', compact('page_title', 'page_description'));
    }
	
    // PAGE REGISTER
    public function page_register(){
        $page_title = 'Page Register';
        $page_description = 'Some description for the page';
        return view('fasto.page.register', compact('page_title', 'page_description'));
    }
    
    // TABLE BOOTSTRAP BASIC
    public function table_bootstrap_basic(){
        $page_title = 'Table Basic';
     $page_description = 'Some description for the page';
        return view('fasto.table.bootstrap_basic', compact('page_title', 'page_description'));
    }
	
    // TABLE DATATABLE BASIC
    public function table_datatable_basic(){
        $page_title = 'Table Datatable';
        $page_description = 'Some description for the page';
        return view('fasto.table.databasic', compact('page_title', 'page_description'));
    }
    // UC NESTABLE.
    public function uc_nestable(){
        $page_title = 'Nestable';
        $page_description = 'Some description for the page';
        return view('fasto.uc.nestable', compact('page_title', 'page_description'));
    }
    // UC LIGHTGALLERY.
    public function uc_lightgallery(){
        $page_title = 'Light Gallery';
        $page_description = 'Some description for the page';
        return view('fasto.uc.lightgallery', compact('page_title', 'page_description'));
    }
	
    // UC NOUI SLIDER
    public function uc_noui_slider(){
        $page_title = 'Noui Slider';
        $page_description = 'Some description for the page';
        return view('fasto.uc.noui_slider', compact('page_title', 'page_description'));
    }
	
    // UC SELECT2
    public function uc_select2(){
        $page_title = 'Select2';
        $page_description = 'Some description for the page';
        return view('fasto.uc.select2', compact('page_title', 'page_description'));
    }
	
    // UC SWEETALERT
    public function uc_sweetalert(){
        $page_title = 'Sweet Alert';
        $page_description = 'Some description for the page';
        return view('fasto.uc.sweetalert', compact('page_title', 'page_description'));
    }
	
    // UC TOASTR
    public function uc_toastr(){
        $page_title = 'Toastr';
        $page_description = 'Some description for the page';
        return view('fasto.uc.toastr', compact('page_title', 'page_description'));
    }
	
    // UI ACCORDION
    public function ui_accordion(){
        $page_title = 'Accordion';
        $page_description = 'Some description for the page';
        return view('fasto.ui.accordion', compact('page_title', 'page_description'));
    }
	
    // UI ALERT
    public function ui_alert(){
        $page_title = 'Alert';
        $page_description = 'Some description for the page';
        return view('fasto.ui.alert', compact('page_title', 'page_description'));
    }
	
    // UI BADGE
    public function ui_badge(){
        $page_title = 'Badge';
        $page_description = 'Some description for the page';
        return view('fasto.ui.badge', compact('page_title', 'page_description'));
    }
	
    // UI BUTTON
    public function ui_button(){
        $page_title = 'Button';
        $page_description = 'Some description for the page';
        return view('fasto.ui.button', compact('page_title', 'page_description'));
    }
	
    // UI BUTTON GROUP
    public function ui_button_group(){
        $page_title = 'Button Group';
        $page_description = 'Some description for the page';
        return view('fasto.ui.button_group', compact('page_title', 'page_description'));
    }
	
    // UI CARD
    public function ui_card(){
        $page_title = 'Card';
        $page_description = 'Some description for the page';
        return view('fasto.ui.card', compact('page_title', 'page_description'));
    }
	
    // UI CAROUSEL
    public function ui_carousel(){
        $page_title = 'Carousel';
        $page_description = 'Some description for the page';
        return view('fasto.ui.carousel', compact('page_title', 'page_description'));
    }
	
    // UI DROPDOWN
    public function ui_dropdown(){
        $page_title = 'Dropdown';
        $page_description = 'Some description for the page';
        return view('fasto.ui.dropdown', compact('page_title', 'page_description'));
    }
	
    // UI GRID
    public function ui_grid(){
        $page_title = 'Grid';
        $page_description = 'Some description for the page';
        return view('fasto.ui.grid', compact('page_title', 'page_description'));
    }
	
    // UI LIST GROUP
    public function ui_list_group(){
        $page_title = 'List Group';
        $page_description = 'Some description for the page';
        return view('fasto.ui.list_group', compact('page_title', 'page_description'));
    }

    // PAGE Media Object
    public function ui_media_object(){
        $page_title = 'Media Object';
        $page_description = 'Some description for the page';
        return view('fasto.ui.media_object', compact('page_title', 'page_description'));
    }
	
    // UI MODAL
    public function ui_modal(){
        $page_title = 'Modal';
        $page_description = 'Some description for the page';
        return view('fasto.ui.modal', compact('page_title', 'page_description'));
    }
	
    // UI PAGINATION
    public function ui_pagination(){
        $page_title = 'Pagination';
        $page_description = 'Some description for the page';
        return view('fasto.ui.pagination', compact('page_title', 'page_description'));
    }
	
    // UI POPOVER
    public function ui_popover(){
        $page_title = 'Popover';
        $page_description = 'Some description for the page';
        return view('fasto.ui.popover', compact('page_title', 'page_description'));
    }
	
    // UI PROGRESSBAR
    public function ui_progressbar(){
        $page_title = 'Progressbar';
        $page_description = 'Some description for the page';
        return view('fasto.ui.progressbar', compact('page_title', 'page_description'));
    }
	
    // UI TAB
    public function ui_tab(){
        $page_title = 'Tab';
        $page_description = 'Some description for the page';
        return view('fasto.ui.tab', compact('page_title', 'page_description'));
    }
	

    // UI TYPOGRAPHY
    public function ui_typography(){
        $page_title = 'Typography.';
        $page_description = 'Some description for the page';
        return view('fasto.ui.typography', compact('page_title', 'page_description'));
    }
	
    // WIDGET BASIC
    public function widget_basic(){
        $page_title = 'Widget';
        $page_description = 'Some description for the page';
        return view('fasto.widget.widget_basic', compact('page_title', 'page_description'));
    }

    // CONTACT_LIST_AJAX
    public function contact_list_ajax(){
        return view('fasto.ajax.contact_list');
    }
}
