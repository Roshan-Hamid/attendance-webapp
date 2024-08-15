<!--begin::Body-->
<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="false" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: false, lg: '300px'}">
					<!--begin::Header container-->
					<div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
						<!--begin::Header primary-->
						<div class="d-flex align-items-center justify-content-between flex-row-fluid" id="kt_app_header_wrapper">
							<!--begin::Header logo-->
							<div class="app-header-logo d-flex align-items-center">
								<!--begin::Mobile toggle-->
								<div class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px ms-n3 me-2 d-flex d-lg-none" id="kt_app_sidebar_mobile_toggle">
									<i class="ki-outline ki-abstract-14 fs-1"></i>
								</div>
								<!--end::Mobile toggle-->
								<!--begin::Logo image-->
								<a href="#" class="me-5 me-lg-9">
									<img alt="Logo" src="<?=base_url()?>assets1/media/logos/advance_logo.png" class="h-50px h-sm-60px" />
								</a>
								<!--end::Logo image-->
								<!--begin::Section-->
								<div class="d-none d-md-inline">
									<div class="fw-bold fs-3 text-gray-900">Advance General Trading LLC </div>
									<div class="fw-semibold text-gray-500"><?= strtoupper(str_replace('_', ' ', session()->get('role_name'))) ?></div>
								</div>
								<!--end::Section-->
							</div>
							<!--end::Header logo-->
							<!--begin::Menu wrapper-->
							<div class="d-flex align-items-stretch" id="kt_app_header_menu_wrapper">
								<!--begin::Menu holder-->
								<div class="app-header-menu app-header-mobile-drawer align-items-stretch" >
									<!--begin::Menu-->
									<div class="menu menu-rounded menu-column menu-lg-row menu-active-bg menu-title-gray-600 menu-state-gray-900 menu-arrow-gray-500 fw-semibold fw-semibold fs-6 align-items-stretch my-5 my-lg-0 px-2 px-lg-0" id="#kt_app_header_menu" data-kt-menu="true">
										<!--begin:Menu item-->
										<div  data-kt-menu-placement="bottom-start" data-kt-menu-offset="-250,0" class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
											<!--begin:Menu link-->
											<a href="<?= base_url() ?>dashboard" >
											<span class="menu-link">
												<span class="menu-title">Dashboards</span>
												<span class="menu-arrow d-lg-none"></span>
											</span>
											</a>
											<!--end:Menu link-->
										</div>
										<!--end:Menu item-->
										<!--begin:Menu item-->
										<div data-kt-menu-placement="bottom-start" data-kt-menu-offset="-250,0" class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2" >
											<!--begin:Menu link-->
											<a href="<?= base_url() ?>Attendance" >
											<span class="menu-link">
												<span class="menu-title">Attendance</span>
												<span class="menu-arrow d-lg-none"></span>
											</span>
											</a>
											<!--end:Menu link-->
										</div>
										<!--end:Menu item-->
										<!--begin:Menu item-->
										<div data-kt-menu-placement="bottom-start" data-kt-menu-offset="-250,0" class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2" >
											<!--begin:Menu link-->
											<a href="<?= base_url() ?>Staffs" >
											<span class="menu-link">
												<span class="menu-title">Staffs</span>
												<span class="menu-arrow d-lg-none"></span>
											</span>
											</a>
											<!--end:Menu link-->
										</div>
										<!--end:Menu item-->
										<!--begin:Menu item-->
										<div data-kt-menu-placement="bottom-start" data-kt-menu-offset="-250,0" class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2" >
											<!--begin:Menu link-->
											<a href="<?= base_url() ?>Branches" >
											<span class="menu-link">
												<span class="menu-title">Branches</span>
												<span class="menu-arrow d-lg-none"></span>
											</span>
											</a>
											<!--end:Menu link-->
										</div>
										<!--end:Menu item-->
										
										<!--begin:Menu item-->
										<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" data-kt-menu-offset="12,0" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
											<!--begin:Menu link-->
											<a href="<?= base_url() ?>Report" >
											<span class="menu-link">
												<span class="menu-title">Report</span>
												<span class="menu-arrow d-lg-none"></span>
											</span>
											<!--end:Menu link-->
											<!--begin:Menu sub-->
											<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
												<!--begin:Menu item-->
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link" href="<?= base_url() ?>Report"  title="Report of Staff" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
														<span class="menu-icon">
															<i class="fa-solid fa-clipboard-user fs-2"></i>
														</span>
														<span class="menu-title">Staffs Report</span>
													</a>
													<!--end:Menu link-->
												</div>
												<!--end:Menu item-->
											
												<!--begin:Menu item-->
												<div class="menu-item">
													<!--begin:Menu link-->
													<a class="menu-link" href="<?= base_url() ?>Report/Branch_report" title="Report of a Branch" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
														<span class="menu-icon">
															<i class="ki-solid bi-building-fill fs-2"></i>
														</span>
														<span class="menu-title">Branch Report</span>
													</a>
													<!--end:Menu link-->
												</div>
												<!--end:Menu item-->
											</div>
											<!--end:Menu sub-->
										</div>
										<!--end:Menu item-->
										<!--begin:Menu item-->
										<?php  
										$this->session = \Config\Services::session();
										$userRole = $this->session->get('user_role');
										if ($userRole !== "manager") {?>
										<div data-kt-menu-placement="bottom-start" data-kt-menu-offset="-250,0" class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2" >
											<!--begin:Menu link-->
											<a href="<?= base_url() ?>Manager" >
											<span class="menu-link">
												<span class="menu-title">Managers</span>
												<span class="menu-arrow d-lg-none"></span>
											</span>
											</a>
											<!--end:Menu link-->
										</div>
										<?php }?>
										<!--end:Menu item-->
									</div>
									<!--end::Menu-->
								</div>
								<!--end::Menu holder-->
							</div>
							<!--end::Menu wrapper-->
							<!--begin::Navbar-->
							<div class="app-navbar flex-shrink-0">
								<!--begin::User menu-->
								<div class="app-navbar-item me-3" id="kt_header_user_menu_toggle">
									<!--begin::Menu wrapper-->
									<div class="btn btn-icon btn-icon-gray-600 border border-dashed border-gray-300 w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<i class="ki-outline ki-user fs-3"></i>
									</div>
									<!--begin::User account menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<!--begin::Avatar-->
												<div class="symbol symbol-50px me-5">
													<!--img alt="Logo" src="<?=base_url()?>assets1/media/avatars/300-5.jpg" /-->
													<span class="symbol-label bg-light-danger text-danger fs-5 fw-bolder"><?= strtoupper(substr(session()->get('role_name'), 0, 1)) ?></span>
												</div>
												<!--end::Avatar-->
												<!--begin::Username-->
												<div class="d-flex flex-column">
													<div class="fw-bold d-flex align-items-center fs-5"><?= strtoupper(str_replace('_', ' ', session()->get('role_name'))) ?>
													<!--span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span--></div>
													<a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><?= str_replace('_', ' ', session()->get('user_name')) ?></a>
												</div>
												<!--end::Username-->
											</div>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="<?=base_url()?>MyProfile" class="menu-link px-5">My Profile</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<!--div class="menu-item px-5">
											<a href="apps/projects/list.html" class="menu-link px-5">
												<span class="menu-text">My Projects</span>
												<span class="menu-badge">
													<span class="badge badge-light-danger badge-circle fw-bold fs-7">3</span>
												</span>
											</a>
										<!--/div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<!--div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
											<a href="#" class="menu-link px-5">
												<span class="menu-title">My Subscription</span>
												<span class="menu-arrow"></span>
											</a>
											<!--begin::Menu sub-->
											<div class="menu-sub menu-sub-dropdown w-175px py-4">
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<a href="account/referrals.html" class="menu-link px-5">Referrals</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<a href="account/billing.html" class="menu-link px-5">Billing</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<a href="account/statements.html" class="menu-link px-5">Payments</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<a href="account/statements.html" class="menu-link d-flex flex-stack px-5">Statements 
													<span class="ms-2 lh-0" data-bs-toggle="tooltip" title="View your statements">
														<i class="ki-outline ki-information-5 fs-5"></i>
													</span></a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu separator-->
												<div class="separator my-2"></div>
												<!--end::Menu separator-->
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<div class="menu-content px-3">
														<label class="form-check form-switch form-check-custom form-check-solid">
															<input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
															<span class="form-check-label text-muted fs-7">Notifications</span>
														</label>
													</div>
												</div>
												<!--end::Menu item-->
											</div>
											<!--end::Menu sub-->
										<!--/div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<!--div class="menu-item px-5">
											<a href="account/statements.html" class="menu-link px-5">My Statements</a>
										<!--/div>
										<!--end::Menu item-->
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
											<a href="#" class="menu-link px-5">
												<span class="menu-title position-relative">Mode 
												<span class="ms-5 position-absolute translate-middle-y top-50 end-0">
													<i class="ki-outline ki-night-day theme-light-show fs-2"></i>
													<i class="ki-outline ki-moon theme-dark-show fs-2"></i>
												</span></span>
											</a>
											<!--begin::Menu-->
											<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
												<!--begin::Menu item-->
												<div class="menu-item px-3 my-0">
													<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
														<span class="menu-icon" data-kt-element="icon">
															<i class="ki-outline ki-night-day fs-2"></i>
														</span>
														<span class="menu-title">Light</span>
													</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3 my-0">
													<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
														<span class="menu-icon" data-kt-element="icon">
															<i class="ki-outline ki-moon fs-2"></i>
														</span>
														<span class="menu-title">Dark</span>
													</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3 my-0">
													<a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
														<span class="menu-icon" data-kt-element="icon">
															<i class="ki-outline ki-screen fs-2"></i>
														</span>
														<span class="menu-title">System</span>
													</a>
												</div>
												<!--end::Menu item-->
											</div>
											<!--end::Menu-->
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<!--div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
											<a href="#" class="menu-link px-5">
												<span class="menu-title position-relative">Language 
												<span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English 
												<img class="w-15px h-15px rounded-1 ms-2" src="<?=base_url()?>assets1/media/flags/united-states.svg" alt="" /></span></span>
											</a>
											<!--begin::Menu sub-->
											<div class="menu-sub menu-sub-dropdown w-175px py-4">
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<a href="account/settings.html" class="menu-link d-flex px-5 active">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="<?=base_url()?>assets1/media/flags/united-states.svg" alt="" />
													</span>English</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<a href="account/settings.html" class="menu-link d-flex px-5">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="<?=base_url()?>assets1/media/flags/spain.svg" alt="" />
													</span>Spanish</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<a href="account/settings.html" class="menu-link d-flex px-5">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="<?=base_url()?>assets1/media/flags/germany.svg" alt="" />
													</span>German</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<a href="account/settings.html" class="menu-link d-flex px-5">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="<?=base_url()?>assets1/media/flags/japan.svg" alt="" />
													</span>Japanese</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<a href="account/settings.html" class="menu-link d-flex px-5">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="<?=base_url()?>assets1/media/flags/france.svg" alt="" />
													</span>French</a>
												</div>
												<!--end::Menu item-->
											</div>
											<!--end::Menu sub-->
										<!--/div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-5 my-1">
											<a href="<?= base_url() ?>settings/password" class="menu-link px-5">Account Settings</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="<?= base_url() ?>login/logout" class="menu-link px-5">Sign Out</a>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::User account menu-->
									<!--end::Menu wrapper-->
								</div>
								<!--end::User menu-->
								<!--begin::Chat-->
								<!--div class="app-navbar-item me-3">
									<a href="#" class="d-flex align-items-center" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<button class="btn btn-icon btn-body position-relative btn btn-icon btn-icon-gray-600 border border-dashed border-gray-300 w-35px h-35px w-md-40px h-md-40px" id="kt_drawer_chat_toggle">
											<i class="ki-outline ki-messages fs-3"></i>
											<span class="position-absolute top-0 start-100 translate-middle badge badge-circle badge-sm badge-info">5</span>
										</button>
									</a>
								<!--/div>
								<!--end::Chat-->
								<!--begin::Notifications-->
								<!--div class="app-navbar-item me-3">
									<!--begin::Menu- wrapper-->
									<!--div class="btn btn-icon btn-icon-gray-600 border border-dashed border-gray-300 w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<i class="ki-outline ki-element-11 fs-3"></i>
									<!--/div>
									<!--begin::Menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
										<!--begin::Heading-->
										<div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('<?=base_url()?>assets1/media/misc/menu-header-bg.jpg')">
											<!--begin::Title-->
											<h3 class="text-white fw-semibold px-9 mt-10 mb-6">Notifications 
											<span class="fs-8 opacity-75 ps-3">24 reports</span></h3>
											<!--end::Title-->
											<!--begin::Tabs-->
											<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9">
												<li class="nav-item">
													<a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_1">Alerts</a>
												</li>
												<li class="nav-item">
													<a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#kt_topbar_notifications_2">Updates</a>
												</li>
												<li class="nav-item">
													<a class="nav-link text-white opacity-75 opacity-state-100 pb-4" data-bs-toggle="tab" href="#kt_topbar_notifications_3">Logs</a>
												</li>
											</ul>
											<!--end::Tabs-->
										</div>
										<!--end::Heading-->
										<!--begin::Tab content-->
										<div class="tab-content">
											<!--begin::Tab panel-->
											<div class="tab-pane fade" id="kt_topbar_notifications_1" role="tabpanel">
												<!--begin::Items-->
												<div class="scroll-y mh-325px my-5 px-8">
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-primary">
																	<i class="ki-outline ki-abstract-28 fs-2 text-primary"></i>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Project Alice</a>
																<div class="text-gray-500 fs-7">Phase 1 development</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">1 hr</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-danger">
																	<i class="ki-outline ki-information fs-2 text-danger"></i>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">HR Confidential</a>
																<div class="text-gray-500 fs-7">Confidential staff documents</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">2 hrs</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-warning">
																	<i class="ki-outline ki-briefcase fs-2 text-warning"></i>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Company HR</a>
																<div class="text-gray-500 fs-7">Corporeate staff profiles</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">5 hrs</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-success">
																	<i class="ki-outline ki-abstract-12 fs-2 text-success"></i>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Project Redux</a>
																<div class="text-gray-500 fs-7">New frontend admin theme</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">2 days</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-primary">
																	<i class="ki-outline ki-colors-square fs-2 text-primary"></i>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Project Breafing</a>
																<div class="text-gray-500 fs-7">Product launch status update</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">21 Jan</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-info">
																	<i class="ki-outline ki-picture fs-2 text-info"></i>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Banner Assets</a>
																<div class="text-gray-500 fs-7">Collection of banner images</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">21 Jan</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center">
															<!--begin::Symbol-->
															<div class="symbol symbol-35px me-4">
																<span class="symbol-label bg-light-warning">
																	<i class="ki-outline ki-color-swatch fs-2 text-warning"></i>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Title-->
															<div class="mb-0 me-2">
																<a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Icon Assets</a>
																<div class="text-gray-500 fs-7">Collection of SVG icons</div>
															</div>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">20 March</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
												</div>
												<!--end::Items-->
												<!--begin::View more-->
												<div class="py-3 text-center border-top">
													<a href="pages/user-profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All 
													<i class="ki-outline ki-arrow-right fs-5"></i></a>
												</div>
												<!--end::View more-->
											</div>
											<!--end::Tab panel-->
											<!--begin::Tab panel-->
											<div class="tab-pane fade show active" id="kt_topbar_notifications_2" role="tabpanel">
												<!--begin::Wrapper-->
												<div class="d-flex flex-column px-9">
													<!--begin::Section-->
													<div class="pt-10 pb-0">
														<!--begin::Title-->
														<h3 class="text-gray-900 text-center fw-bold">Get Pro Access</h3>
														<!--end::Title-->
														<!--begin::Text-->
														<div class="text-center text-gray-600 fw-semibold pt-1">Outlines keep you honest. They stoping you from amazing poorly about drive</div>
														<!--end::Text-->
														<!--begin::Action-->
														<div class="text-center mt-5 mb-9">
															<a href="#" class="btn btn-sm btn-primary px-6" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Upgrade</a>
														</div>
														<!--end::Action-->
													</div>
													<!--end::Section-->
													<!--begin::Illustration-->
													<div class="text-center px-4">
														<img class="mw-100 mh-200px" alt="image" src="<?=base_url()?>assets1/media/illustrations/sketchy-1/1.png" />
													</div>
													<!--end::Illustration-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Tab panel-->
											<!--begin::Tab panel-->
											<div class="tab-pane fade" id="kt_topbar_notifications_3" role="tabpanel">
												<!--begin::Items-->
												<div class="scroll-y mh-325px my-5 px-8">
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-success me-4">200 OK</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a href="#" class="text-gray-800 text-hover-primary fw-semibold">New order</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Just now</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-danger me-4">500 ERR</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a href="#" class="text-gray-800 text-hover-primary fw-semibold">New customer</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">2 hrs</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-success me-4">200 OK</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a href="#" class="text-gray-800 text-hover-primary fw-semibold">Payment process</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">5 hrs</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-warning me-4">300 WRN</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a href="#" class="text-gray-800 text-hover-primary fw-semibold">Search query</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">2 days</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-success me-4">200 OK</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a href="#" class="text-gray-800 text-hover-primary fw-semibold">API connection</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">1 week</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-success me-4">200 OK</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a href="#" class="text-gray-800 text-hover-primary fw-semibold">Database restore</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Mar 5</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-warning me-4">300 WRN</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a href="#" class="text-gray-800 text-hover-primary fw-semibold">System update</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">May 15</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-warning me-4">300 WRN</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a href="#" class="text-gray-800 text-hover-primary fw-semibold">Server OS update</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Apr 3</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-warning me-4">300 WRN</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a href="#" class="text-gray-800 text-hover-primary fw-semibold">API rollback</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Jun 30</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-danger me-4">500 ERR</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a href="#" class="text-gray-800 text-hover-primary fw-semibold">Refund process</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Jul 10</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-danger me-4">500 ERR</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a href="#" class="text-gray-800 text-hover-primary fw-semibold">Withdrawal process</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Sep 10</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
													<!--begin::Item-->
													<div class="d-flex flex-stack py-4">
														<!--begin::Section-->
														<div class="d-flex align-items-center me-2">
															<!--begin::Code-->
															<span class="w-70px badge badge-light-danger me-4">500 ERR</span>
															<!--end::Code-->
															<!--begin::Title-->
															<a href="#" class="text-gray-800 text-hover-primary fw-semibold">Mail tasks</a>
															<!--end::Title-->
														</div>
														<!--end::Section-->
														<!--begin::Label-->
														<span class="badge badge-light fs-8">Dec 10</span>
														<!--end::Label-->
													</div>
													<!--end::Item-->
												</div>
												<!--end::Items-->
												<!--begin::View more-->
												<div class="py-3 text-center border-top">
													<a href="pages/user-profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All 
													<i class="ki-outline ki-arrow-right fs-5"></i></a>
												</div>
												<!--end::View more-->
											</div>
											<!--end::Tab panel-->
										</div>
										<!--end::Tab content-->
									</div>
									<!--end::Menu-->
									<!--end::Menu wrapper-->
								<!--/div>
								<!--end::Notifications-->
								<!--begin::Quick links-->
								<!--div class="app-navbar-item me-3">
									<!--begin::Menu- wrapper-->
									<!--div class="btn btn-icon btn-icon-gray-600 border border-dashed border-gray-300 w-35px h-35px w-md-40px h-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<i class="ki-outline ki-setting-3 fs-3"></i>
									<!--/div>
									<!--begin::Menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
										<!--begin::Heading-->
										<div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url('<?=base_url()?>assets1/media/misc/menu-header-bg.jpg')">
											<!--begin::Title-->
											<h3 class="text-white fw-semibold mb-3">Quick Links</h3>
											<!--end::Title-->
											<!--begin::Status-->
											<span class="badge bg-primary text-inverse-primary py-2 px-3">25 pending tasks</span>
											<!--end::Status-->
										</div>
										<!--end::Heading-->
										<!--begin:Nav-->
										<div class="row g-0">
											<!--begin:Item-->
											<div class="col-6">
												<a href="apps/projects/budget.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
													<i class="ki-outline ki-dollar fs-3x text-primary mb-2"></i>
													<span class="fs-5 fw-semibold text-gray-800 mb-0">Accounting</span>
													<span class="fs-7 text-gray-500">eCommerce</span>
												</a>
											</div>
											<!--end:Item-->
											<!--begin:Item-->
											<div class="col-6">
												<a href="apps/projects/settings.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">
													<i class="ki-outline ki-sms fs-3x text-primary mb-2"></i>
													<span class="fs-5 fw-semibold text-gray-800 mb-0">Administration</span>
													<span class="fs-7 text-gray-500">Console</span>
												</a>
											</div>
											<!--end:Item-->
											<!--begin:Item-->
											<div class="col-6">
												<a href="apps/projects/list.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end">
													<i class="ki-outline ki-abstract-41 fs-3x text-primary mb-2"></i>
													<span class="fs-5 fw-semibold text-gray-800 mb-0">Projects</span>
													<span class="fs-7 text-gray-500">Pending Tasks</span>
												</a>
											</div>
											<!--end:Item-->
											<!--begin:Item-->
											<div class="col-6">
												<a href="apps/projects/users.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light">
													<i class="ki-outline ki-briefcase fs-3x text-primary mb-2"></i>
													<span class="fs-5 fw-semibold text-gray-800 mb-0">Customers</span>
													<span class="fs-7 text-gray-500">Latest cases</span>
												</a>
											</div>
											<!--end:Item-->
										</div>
										<!--end:Nav-->
										<!--begin::View more-->
										<div class="py-2 text-center border-top">
											<a href="pages/user-profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All 
											<i class="ki-outline ki-arrow-right fs-5"></i></a>
										</div>
										<!--end::View more-->
									</div>
									<!--end::Menu-->
									<!--end::Menu wrapper-->
								<!--/div>
								<!--end::Quick links-->
								<!--begin::Action-->
								<!--div class="app-navbar-item">
									<a href="<?= base_url()?>login/logout" class="btn btn-flex btn-icon align-self-center fw-bold btn-success w-35px w-md-100 h-35px h-md-40px px-4"  >
										<i class="ki-outline ki-crown-2 fs-3"></i>
										<span class="d-none d-md-inline ms-2">Logout</span>
									</a>
								<!--/div>
								<!--end::Action-->
								<!--begin::Sidebar menu toggle-->
								<div class="app-navbar-item d-flex align-items-center d-lg-none ms-1 me-n3">
									<a href="#" class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
										<i class="ki-outline ki-text-align-left fs-1"></i>
									</a>
								</div>
								<!--end::Sidebar menu toggle-->
							</div>
							<!--end::Navbar-->
						</div>
						<!--end::Header primary-->
					</div>
					<!--end::Header container-->
				</div>
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Wrapper container-->
					<div class="app-container container-fluid d-flex flex-grow-1">
						<!--begin::Sidebar-->
						<div id="kt_app_sidebar" class="app-sidebar flex-column flex-shrink-0" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
							<!--begin::Wrapper-->
							<div class="hover-scroll-overlay-y me-lg-4 mb-5" data-kt-sticky="true" data-kt-sticky-name="app-sidebar-menu-sticky" data-kt-sticky-offset="{default: false, xl: '400px'}" data-kt-sticky-release="#kt_app_stats" data-kt-sticky-width="auto" data-kt-sticky-left="auto" data-kt-sticky-top="100px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header, #kt_app_footer" data-kt-scroll-wrappers="#kt_app_sidebar_nav" data-kt-scroll-offset="0px">
								<!--begin::Nav-->
								<ul class="nav flex-column w-lg-100" id="kt_app_sidebar_nav">
									<!--begin::Nav item-->
									<li class="nav-item mb-2">
										<!--begin::Nav link-->
										<a class="nav-link btn btn-icon btn-active-info btn-color-gray-600"  href="<?= base_url() ?>Dashboard">
											<i class="ki-solid ki-home-2 fs-2"></i>
										</a>
										<!--end::Nav link-->
									</li>
									<!--end::Nav item-->
									<!--begin::Nav item-->
									<li class="nav-item mb-2">
										<!--begin::Nav link-->
										<a class="nav-link btn btn-icon btn-active-info btn-color-gray-600"  href="<?= base_url() ?>Attendance">
											<i class="fa-solid fa-clipboard-user fs-2"></i>
										</a>
										<!--end::Nav link-->
									</li>
									<!--end::Nav item-->
									<!--begin::Nav item-->
									<li class="nav-item mb-2">
										<!--begin::Nav link-->
										<a class="nav-link btn btn-icon btn-active-info btn-color-gray-600"  href="<?= base_url() ?>Staffs">
											<i class="bi-solid bi-people-fill fs-2"></i>
										</a>
										<!--end::Nav link-->
									</li>
									<!--end::Nav item-->
									<!--begin::Nav item-->
									<li class="nav-item mb-2">
										<!--begin::Nav link-->
										<a class="nav-link btn btn-icon btn-active-info btn-color-gray-600"  href="<?= base_url() ?>Branches">
											<i class="ki-solid bi-building-fill fs-2"></i>
										</a>
										<!--end::Nav link-->
									</li>
									<!--end::Nav item-->
									<!--begin::Nav item-->
									<li class="nav-item mb-2">
										<!--begin::Nav link-->
										<a class="nav-link btn btn-icon btn-active-info btn-color-gray-600"  href="<?= base_url() ?>Report">
										<i class="bi bi-printer-fill fs-2"></i>
										</a>
										<!--end::Nav link-->
									</li>
									<!--end::Nav item-->
									<?php
									 $this->session = \Config\Services::session();
									 $userRole = $this->session->get('user_role');
										if ($userRole !== "manager") {
										?>
									<!--begin::Nav item-->
									<li class="nav-item mb-2">
										<!--begin::Nav link-->
										<a class="nav-link btn btn-icon btn-active-info btn-color-gray-600"  href="<?= base_url() ?>Manager">
											<i class="bi-solid  bi-person-fill-add fs-2"></i>
										</a>
										<!--end::Nav link-->
									</li>
									<!--end::Nav item-->
									<?php } ?>
									<!--begin::Nav item-->
									<!--li class="nav-item mb-2">
										<!--begin::Nav link-->
										<!--a class="nav-link btn btn-icon btn-active-info btn-color-gray-600" data-bs-toggle="tab" href="#">
											<!--i class="ki-outline ki-paypal fs-2"></i>
											<!--i class="ki-outline ki-note-2 fs-2"></i>

										</a>
										<!--end::Nav link-->
									<!--/li>
									<!--end::Nav item-->
									<!--begin::Nav item-->
									<!--li class="nav-item mb-2">
										<!--begin::Nav link-->
										<!--a class="nav-link btn btn-icon btn-active-info btn-color-gray-600" data-bs-toggle="tab" href="#">
											<!--i class="ki-outline ki-information fs-2"></i>
										</a>
										<!--end::Nav link-->
									<!--/li>
									<!--end::Nav item-->
								</ul>
								<!--end::Tabs-->
							</div>
							<!--end::Nav-->
						</div>
						<!--end::Sidebar-->

	<!--begin::Main-->
	