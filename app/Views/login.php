<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <meta charset="utf-8" />
    <title><?= config('App.appName') . ' ' . config('App.version') ?>Login</title>
    <meta name="description" content="<?= config('App.appName') ?> Login to Dashboard" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" /> -->
    <link rel="canonical" href="<?= base_url() ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template by KeenThemes" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Metronic by Keenthemes" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="<?= base_url() ?>assets1/media/logos/favicon_a.ico" />
    <!--begin::Fonts-->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" /> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?= base_url() ?>assets1/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets1/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background-image: url('<?= base_url() ?>assets1/media/auth/bg10.jpeg'); } [data-bs-theme="dark"] body { background-image: url('<?= base_url() ?>assets1/media/auth/bg10-dark.jpeg'); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-lg-row-fluid">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
						<!--begin::Image-->
						<img class="theme-light-show mx-auto mw-100 w-250px w-lg-300px mb-10 mb-lg-20" src="<?= base_url() ?>assets1/media/logos/advance_logo.png" alt="" />
						<img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="<?= base_url() ?>assets1/media/logos/advance_logo.png" alt="" />
						<!--end::Image-->
						<!--begin::Title-->
						<h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Fast, Efficient and Productive</h1>
						<!--end::Title-->
						<!--begin::Text-->
						<div class="text-gray-600 fs-base text-center fw-semibold">Streamline your attendance tracking with our fast and efficient application.</br> Say goodbye to manual processes and hello to productivity. </br>With our user-friendly interface, you can easily manage attendance records in no time.</br> Spend less time on paperwork and more time on what matters most. </br>Try it now and experience the efficiency firsthand!.</div>
						<!--end::Text-->
					</div>
					<!--end::Content-->
				</div>
				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
					<!--begin::Wrapper-->
					<div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
						<!--begin::Content-->
						<div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
							<!--begin::Wrapper-->
							<div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
								<!--begin::Form-->
								<form class="form w-100"  id="kt_login_signin_form"  action="javascript:;" method="POST">
									<!--begin::Heading-->
									<div class="text-center mb-11">
										<!--begin::Title-->
										<h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
										<!--end::Title-->
										<!--begin::Subtitle-->
										<!--end::Subtitle=-->
									</div>
									<!--begin::Heading-->
									<!--begin::Login options-->
									<div class="row g-3 mb-9">
										
									</div>
									<!--end::Login options-->
									<!--begin::Input group=-->
									<div class="row mb-8">
										<!--begin::Email-->
										<input type="text" placeholder="Email" name="username" autocomplete="off" class="form-control bg-transparent" />
										<!--end::Email-->
									</div>
									<!--end::Input group=-->
									<div class="row mb-3">
										<!--begin::Password-->
										<input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
										<!--end::Password-->
									</div>
									<!--end::Input group=-->
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
										<div></div>
										<!--begin::Link-->
										<a href="<?= base_url() ?>forgot_password" class="link-primary">Forgot Password ?</a>
										<!--end::Link-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Submit button-->
									<div class="d-grid mb-10">
										<button type="submit" id="kt_login_signin_submit" class="btn btn-primary">
											<!--begin::Indicator label-->
											<span class="indicator-label">Sign In</span>
											<!--end::Indicator label-->
											<!--begin::Indicator progress-->
											<span class="indicator-progress">Please wait... 
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
											<!--end::Indicator progress-->
										</button>
									</div>
									<!--end::Submit button-->
									<!--begin::Sign up-->
									<!--div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet? 
									<!--a href="authentication/layouts/overlay/sign-up.html" class="link-primary"--></a></div-->
									<!--end::Sign up-->
								</form>
								<!--end::Form-->
							</div>
							<!--end::Wrapper-->
							<!--begin::Footer-->
							<div class="d-flex flex-stack">
								<!--begin::Languages-->
								<div class="me-10">
									<!--begin::Toggle-->
									<!--button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
										<img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3" src="<?= base_url() ?>assets1/media/flags/united-states.svg" alt="" />
										<span data-kt-element="current-lang-name" class="me-1">English</span>
										<i class="ki-outline ki-down fs-5 text-muted rotate-180 m-0"></i>
									</button-->
									<!--end::Toggle-->
									<!--begin::Menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
												<span class="symbol symbol-20px me-4">
													<img data-kt-element="lang-flag" class="rounded-1" src="<?= base_url() ?>assets1/media/flags/united-states.svg" alt="" />
												</span>
												<span data-kt-element="lang-name">English</span>
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a href="#" class="menu-link d-flex px-5" data-kt-lang="Spanish">
												<span class="symbol symbol-20px me-4">
													<img data-kt-element="lang-flag" class="rounded-1" src="<?= base_url() ?>assets1/media/flags/spain.svg" alt="" />
												</span>
												<span data-kt-element="lang-name">Spanish</span>
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a href="#" class="menu-link d-flex px-5" data-kt-lang="German">
												<span class="symbol symbol-20px me-4">
													<img data-kt-element="lang-flag" class="rounded-1" src="<?= base_url() ?>assets1/media/flags/germany.svg" alt="" />
												</span>
												<span data-kt-element="lang-name">German</span>
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a href="#" class="menu-link d-flex px-5" data-kt-lang="Japanese">
												<span class="symbol symbol-20px me-4">
													<img data-kt-element="lang-flag" class="rounded-1" src="<?= base_url() ?>assets1/media/flags/japan.svg" alt="" />
												</span>
												<span data-kt-element="lang-name">Japanese</span>
											</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<a href="#" class="menu-link d-flex px-5" data-kt-lang="French">
												<span class="symbol symbol-20px me-4">
													<img data-kt-element="lang-flag" class="rounded-1" src="<?= base_url() ?>assets1/media/flags/france.svg" alt="" />
												</span>
												<span data-kt-element="lang-name">French</span>
											</a>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::Menu-->
								</div>
								<!--end::Languages-->
								<!--begin::Links-->
								<!--div class="d-flex fw-semibold text-primary fs-base gap-5">
									<a href="pages/team.html" target="_blank">Terms</a>
									<a href="pages/pricing/column.html" target="_blank">Plans</a>
									<a href="pages/contact.html" target="_blank">Contact Us</a>
								</div!-->
								<!--end::Links-->
							</div>
							<!--end::Footer-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "<?= base_url() ?>assets1/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?= base_url() ?>assets1/plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url() ?>assets1/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="assets1/js/custom/authentication/sign-in/general.js"></script>


    <style type="text/css">
        .hidden{
            display: none !important;
        }
    </style>
		<script type="text/javascript">
       
        // var validation;

        // // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        // validation = FormValidation.formValidation(
        //     document.getElementById('kt_login_signin_form'), {


        $('#kt_login_signin_submit').on('click', function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');
            var action = "<?php echo base_url() ?>login/login_process";

            var btn_text = $(this).html();
            var btn_loading_text = btn_text + '<span class="spinner ml-3"></span>';

            $(btn).html(btn_loading_text);



                    $.ajax({
                        type: "POST",
                        url: action,
                        data: form.serialize(),
                        success: function(data) {
                            // console.log(data);


                            $(btn).html(btn_text);

                            // var obj = $.parseJSON(data);
                            // var obj = JSON.parse(data);
                            var obj = data;


                            var content = {};

                            if (obj.status == 1 || obj.status == 2) {

                                if (obj.status == 1) {
                                    content.message = 'Logging into Dashboard !';
                                } else {
                                    content.message = 'Logging in ... !';
                                }

                                // content.title = '';
                                // content.icon = 'icon ';
                                Swal.fire('Logging in', 'Logging into Dashboard !', 'success');

                               

                                setTimeout(function() {
                                    if (obj.status == 1) {
                                        window.open('<?php echo base_url() ?>dashboard', '_self');
                                    } else {
                                        window.open('<?php echo base_url() ?>', '_self');
                                    }
                                }, 2000);
                            } else {

                                
                                toastr.error('Invalid Credentials, Please check !','Error!');

                               
                            }


                        }
                    });


        });
    </script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>