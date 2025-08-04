<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Application Name
	|--------------------------------------------------------------------------
	|
	| This value is the name of your application. This value is used when the
	| framework needs to place the application's name in a notification or
	| any other location as required by the application or its packages.
	|
	*/

	'name' => env('APP_NAME', 'Fasto Laravel'),


	'public' => [
		'global' => [
			'css' => [
				'vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				'css/style.css',
			],
			'js' => [
				'top'=> [
					'vendor/global/global.min.js',
					'vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
				],
				'bottom'=> [
					'js/custom.min.js',
					'js/deznav-init.js',
				],
			],
		],
		'pagelevel' => [
			'css' => [
				'FastoAdminController_dashboard' => [
					'vendor/chartist/css/chartist.min.css'
				],
				'FastoAdminController_dashboard_2' => [
					'vendor/chartist/css/chartist.min.css'
				],
				'FastoAdminController_projects' => [

				],
				'FastoAdminController_contacts' => [

				],
				'FastoAdminController_kanban' => [

				],
				'FastoAdminController_calendar' => [
					'vendor/fullcalendar/css/main.min.css'
				],
				'FastoAdminController_messages' => [

				],
				'FastoAdminController_app_calender' => [
					'vendor/fullcalendar/css/main.min.css'
				],
				'FastoAdminController_app_profile' => [
					'vendor/lightgallery/css/lightgallery.min.css'
				],
				'FastoAdminController_post_details' => [
					'vendor/lightgallery/css/lightgallery.min.css'
				],
				'FastoAdminController_chart_chartist' => [
					'vendor/chartist/css/chartist.min.css'
				],
				'FastoAdminController_chart_chartjs' => [
				],
				'FastoAdminController_chart_flot' => [
				],
				'FastoAdminController_chart_morris' => [
				],
				'FastoAdminController_chart_peity' => [
				],
				'FastoAdminController_chart_sparkline' => [
				],
				'FastoAdminController_ecom_checkout' => [
				],
				'FastoAdminController_ecom_customers' => [
				],
				'FastoAdminController_ecom_invoice' => [
				],
				'FastoAdminController_ecom_product_detail' => [
					'vendor/star-rating/star-rating-svg.css',
					'vendor/owl-carousel/owl.carousel.css'
				],
				'FastoAdminController_ecom_product_grid' => [
				],
				'FastoAdminController_ecom_product_list' => [
					'vendor/star-rating/star-rating-svg.css'
				],
				'FastoAdminController_ecom_product_order' => [
				],
				'FastoAdminController_email_compose' => [
					'vendor/dropzone/dist/dropzone.css'
				],
				'FastoAdminController_email_inbox' => [
				],
				'FastoAdminController_email_read' => [
				],
				'FastoAdminController_form_ckeditor' => [
				],
				'FastoAdminController_form_element' => [
				],
				'FastoAdminController_form_pickers' => [
					'vendor/bootstrap-daterangepicker/daterangepicker.css',
					'vendor/clockpicker/css/bootstrap-clockpicker.min.css',
					'vendor/jquery-asColorPicker/css/asColorPicker.min.css',
					'vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
					'vendor/pickadate/themes/default.css',
					'vendor/pickadate/themes/default.date.css',
					'https://fonts.googleapis.com/icon?family=Material+Icons',
				],
				'FastoAdminController_form_validation_jquery' => [
				],
				'FastoAdminController_form_wizard' => [
					'vendor/jquery-smartwizard/dist/css/smart_wizard.min.css',
				],
				'FastoAdminController_map_jqvmap' => [
					'vendor/jqvmap/css/jqvmap.min.css'
				],
				'FastoAdminController_table_bootstrap_basic' => [
				],
				'FastoAdminController_table_datatable_basic' => [
					'vendor/datatables/css/jquery.dataTables.min.css'
				],
				'FastoAdminController_uc_lightgallery' => [
					'vendor/lightgallery/css/lightgallery.min.css'
				],
				'FastoAdminController_uc_nestable' => [
					'vendor/nestable2/css/jquery.nestable.min.css'
				],
				'FastoAdminController_uc_noui_slider' => [
					'vendor/nouislider/nouislider.min.css'
				],
				'FastoAdminController_uc_select2' => [
					'vendor/select2/css/select2.min.css'
				],
				'FastoAdminController_uc_sweetalert' => [
					'vendor/sweetalert2/dist/sweetalert2.min.css'
				],
				'FastoAdminController_uc_toastr' => [
					'vendor/toastr/css/toastr.min.css'
				],
				'FastoAdminController_ui_accordion' => [
				],
				'FastoAdminController_ui_alert' => [
				],
				'FastoAdminController_ui_badge' => [
				],
				'FastoAdminController_ui_button' => [
				],
				'FastoAdminController_ui_button_group' => [
				],
				'FastoAdminController_ui_card' => [
				],
				'FastoAdminController_ui_carousel' => [
				],
				'FastoAdminController_ui_dropdown' => [
				],
				'FastoAdminController_ui_grid' => [
				],
				'FastoAdminController_ui_list_group' => [
				],
				'FastoAdminController_ui_media_object' => [
				],
				'FastoAdminController_ui_modal' => [
				],
				'FastoAdminController_ui_pagination' => [
				],
				'FastoAdminController_ui_popover' => [
				],
				'FastoAdminController_ui_progressbar' => [
				],
				'FastoAdminController_ui_tab' => [
				],
				'FastoAdminController_ui_typography' => [
				],
				'FastoAdminController_widget_basic' => [
					'vendor/chartist/css/chartist.min.css',
				],
			],
			'js' => [
				'FastoAdminController_dashboard' => [
					'vendor/chart.js/Chart.bundle.min.js',
					'vendor/apexchart/apexchart.js',
					'vendor/peity/jquery.peity.min.js',
					'js/dashboard/dashboard-1.js',
				],
				'FastoAdminController_dashboard_2' => [
					'vendor/chart.js/Chart.bundle.min.js',
					'vendor/apexchart/apexchart.js',
					'vendor/peity/jquery.peity.min.js',
					'js/dashboard/dashboard-1.js',
				],
				'FastoAdminController_projects' => [

				],
				'FastoAdminController_contacts' => [
					'js/dashboard/contact.js'
				],
				'FastoAdminController_kanban' => [
					'vendor/draggable/draggable.js'
				],
				'FastoAdminController_calendar' => [
					'vendor/moment/moment.min.js',
					'vendor/fullcalendar/js/main.min.js',
					'js/dashboard/calendar.js',
				],
				'FastoAdminController_messages' => [

				],
				'FastoAdminController_app_calender' => [
					'vendor/moment/moment.min.js',
					'vendor/fullcalendar/js/main.min.js',
				],
				'FastoAdminController_app_profile' => [
					'vendor/lightgallery/js/lightgallery-all.min.js',
				],
				'FastoAdminController_post_details' => [
					'vendor/lightgallery/js/lightgallery-all.min.js',
				],
				'FastoAdminController_chart_chartist' => [
					'vendor/chart.js/Chart.bundle.min.js',
					'vendor/apexchart/apexchart.js',
					'vendor/chartist/js/chartist.min.js',
					'vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
					'js/plugins-init/chartist-init.js',
				],
				'FastoAdminController_chart_chartjs' => [
					'vendor/chart.js/Chart.bundle.min.js',
					'vendor/apexchart/apexchart.js',
					'js/plugins-init/chartjs-init.js',
				],
				'FastoAdminController_chart_flot' => [
					'vendor/chart.js/Chart.bundle.min.js',
					'vendor/flot/jquery.flot.js',
					'vendor/flot/jquery.flot.pie.js',
					'vendor/flot/jquery.flot.resize.js',
					'vendor/flot-spline/jquery.flot.spline.min.js',
					'js/plugins-init/flot-init.js',
				],
				'FastoAdminController_chart_morris' => [
					'vendor/chart.js/Chart.bundle.min.js',
					'vendor/raphael/raphael.min.js',
					'vendor/morris/morris.min.js',
					'js/plugins-init/morris-init.js',
				],
				'FastoAdminController_chart_peity' => [
					'vendor/chart.js/Chart.bundle.min.js',
					'vendor/peity/jquery.peity.min.js',
					'js/plugins-init/piety-init.js',
				],
				'FastoAdminController_chart_sparkline' => [
					'vendor/chart.js/Chart.bundle.min.js',
					'vendor/jquery-sparkline/jquery.sparkline.min.js',
					'js/plugins-init/sparkline-init.js',
					'vendor/svganimation/vivus.min.js',
					'vendor/svganimation/svg.animation.js',
				],
				'FastoAdminController_ecom_checkout' => [
				],
				'FastoAdminController_ecom_customers' => [
					'vendor/highlightjs/highlight.pack.min.js',
				],
				'FastoAdminController_ecom_invoice' => [

				],
				'FastoAdminController_ecom_product_detail' => [
					'vendor/star-rating/jquery.star-rating-svg.js',
					'vendor/owl-carousel/owl.carousel.js'
				],
				'FastoAdminController_ecom_product_grid' => [
				],
				'FastoAdminController_ecom_product_list' => [
					'vendor/star-rating/jquery.star-rating-svg.js'
				],
				'FastoAdminController_ecom_product_order' => [
				],
				'FastoAdminController_email_compose' => [
					'vendor/dropzone/dist/dropzone.js'
				],
				'FastoAdminController_email_inbox' => [
				],
				'FastoAdminController_email_read' => [
				],
				'FastoAdminController_form_ckeditor' => [
					'vendor/ckeditor/ckeditor.js'
				],
				'FastoAdminController_form_element' => [
				],
				'FastoAdminController_form_pickers' => [
					'vendor/moment/moment.min.js',
					'vendor/bootstrap-daterangepicker/daterangepicker.js',
					'vendor/clockpicker/js/bootstrap-clockpicker.min.js',
					'vendor/jquery-asColor/jquery-asColor.min.js',
					'vendor/jquery-asGradient/jquery-asGradient.min.js',
					'vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js',
					'vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
					'vendor/pickadate/picker.js',
					'vendor/pickadate/picker.time.js',
					'vendor/pickadate/picker.date.js',
					'js/plugins-init/bs-daterange-picker-init.js',
					'js/plugins-init/clock-picker-init.js',
					'js/plugins-init/jquery-asColorPicker.init.js',
					'js/plugins-init/material-date-picker-init.js',
					'js/plugins-init/pickadate-init.js',
				],
				'FastoAdminController_form_validation_jquery' => [
					'vendor/jquery-validation/jquery.validate.min.js',
					'js/plugins-init/jquery.validate-init.js',
				],
				'FastoAdminController_form_wizard' => [
					'vendor/jquery-steps/build/jquery.steps.min.js',
					'vendor/jquery-validation/jquery.validate.min.js',
					'js/plugins-init/jquery.validate-init.js',
					'vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js',
				],
				'FastoAdminController_map_jqvmap' => [
					'vendor/jqvmap/js/jquery.vmap.min.js',
					'vendor/jqvmap/js/jquery.vmap.world.js',
					'vendor/jqvmap/js/jquery.vmap.usa.js',
					'js/plugins-init/jqvmap-init.js',
				],
				'FastoAdminController_page_error_400' => [
				],
				'FastoAdminController_page_error_403' => [
				],
				'FastoAdminController_page_error_404' => [
				],
				'FastoAdminController_page_error_500' => [
				],
				'FastoAdminController_page_error_503' => [
				],
				'FastoAdminController_page_forgot_password' => [
				],
				'FastoAdminController_page_lock_screen' => [
					'vendor/deznav/deznav.min.js'
				],
				'FastoAdminController_page_login' => [
				],
				'FastoAdminController_page_register' => [
				],
				'FastoAdminController_table_bootstrap_basic' => [

				],
				'FastoAdminController_table_datatable_basic' => [
					'vendor/datatables/js/jquery.dataTables.min.js',
					'js/plugins-init/datatables.init.js',
				],
				'FastoAdminController_uc_lightgallery' => [
					'vendor/lightgallery/js/lightgallery-all.min.js'
				],
				'FastoAdminController_uc_nestable' => [
					'vendor/nestable2/js/jquery.nestable.min.js',
					'js/plugins-init/nestable-init.js',
				],
				'FastoAdminController_uc_noui_slider' => [
					'vendor/nouislider/nouislider.min.js',
					'vendor/wnumb/wNumb.js',
					'js/plugins-init/nouislider-init.js',
				],
				'FastoAdminController_uc_select2' => [
					'vendor/select2/js/select2.full.min.js',
					'js/plugins-init/select2-init.js',
				],
				'FastoAdminController_uc_sweetalert' => [
					'vendor/sweetalert2/dist/sweetalert2.min.js',
					'js/plugins-init/sweetalert.init.js',
				],
				'FastoAdminController_uc_toastr' => [
					'vendor/toastr/js/toastr.min.js',
					'js/plugins-init/toastr-init.js',
				],
				'FastoAdminController_ui_accordion' => [
				],
				'FastoAdminController_ui_alert' => [
				],
				'FastoAdminController_ui_badge' => [
				],
				'FastoAdminController_ui_button' => [
				],
				'FastoAdminController_ui_button_group' => [
				],
				'FastoAdminController_ui_card' => [
				],
				'FastoAdminController_ui_carousel' => [
				],
				'FastoAdminController_ui_dropdown' => [
				],
				'FastoAdminController_ui_grid' => [
				],
				'FastoAdminController_ui_list_group' => [
				],
				'FastoAdminController_ui_media_object' => [
				],
				'FastoAdminController_ui_modal' => [
				],
				'FastoAdminController_ui_pagination' => [
				],
				'FastoAdminController_ui_popover' => [
				],
				'FastoAdminController_ui_progressbar' => [
				],
				'FastoAdminController_ui_tab' => [
				],
				'FastoAdminController_ui_typography' => [
				],
				'FastoAdminController_widget_basic' => [
					'vendor/chart.js/Chart.bundle.min.js',
					'vendor/apexchart/apexchart.js',
					'vendor/chartist/js/chartist.min.js',
					'vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
					'vendor/flot/jquery.flot.js',
					'vendor/flot/jquery.flot.pie.js',
					'vendor/flot/jquery.flot.resize.js',
					'vendor/flot-spline/jquery.flot.spline.min.js',
					'vendor/jquery-sparkline/jquery.sparkline.min.js',
					'js/plugins-init/sparkline-init.js',
					'vendor/peity/jquery.peity.min.js',
					'js/plugins-init/piety-init.js',
					'js/plugins-init/widgets-script-init.js',
				],
			]
		],
	]
];
