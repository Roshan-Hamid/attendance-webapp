<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head><base href="">
	<meta charset="utf-8" />
	<title><?=config('App.app_name')?></title>
	<meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
	<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template by KeenThemes" />
	<meta property="og:url" content="https://keenthemes.com/metronic" />
	<meta property="og:site_name" content="Metronic by Keenthemes" />
	<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
	<link rel="shortcut icon" href="<?=base_url()?>assets1/media/logos/favicon_a.ico" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Vendors Styles(used by this page)-->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

	<link href="<?=base_url()?>assets1/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets1/plugins/custom/fullcalendar/fullcalendar.bundle.js">
	<link href="<?=base_url()?>assets1/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles-->
	<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
	<link href="<?=base_url()?>assets1/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets1/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets1/css/fonts.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
	<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	
	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="<?=base_url()?>assets1/plugins/global/plugins.bundle.js"></script>
	<script src="<?=base_url()?>assets1/plugins/custom/prismjs/prismjs.bundle.js"></script>
	<script src="<?=base_url()?>assets1/js/scripts.bundle.js"></script>
	<!--end::Global Theme Bundle-->
	<!-- begin::DataTable -->
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/sc-2.0.1/sp-1.0.1/datatables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/sc-2.0.1/sp-1.0.1/datatables.min.css"/>

	<!-- end::DataTable -->
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.js" data-turbolinks-track="true"></script>

	<!-- <script src="<?=base_url()?>assets/plugins/custom/kanban/kanban.bundle.js?v=7.2.8"></script> -->


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/css/jquery.fancybox.min.css" integrity="sha512-3IQL+PcFRQuSVCbyYeiT3jtO7Hwes+JU2JO0SlEBKwfyYr/aGRqLk72UTolR0opyvnDAiOTnG7u2Jyl5bri9tQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/js/jquery.fancybox.min.js" integrity="sha512-ycg6GpWTcSok9ORtPFQNzbLzRoOGd2fjmFZ5UI5hY2Vvc3bPrI7c4hC5tH4w44wCp3K9MPFJbDWTXz3VYUeInQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" /> 
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> -->
	<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->
<style>

</style>
</head>
<!--end::Head-->

<?php // echo view('includes/Inc_quick_panel')?>
