	<!-- <script>window.history.replaceState({}, document.title, window.location.pathname);</script> -->

								<!--begin::Toolbar-->
								<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
									<!--begin::Toolbar wrapper-->
									<div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
										<!--begin::Page title-->
										<div class="page-title d-flex flex-column justify-content-center gap-1 me-3 ms-1">
											<!--begin::Breadcrumb-->
											<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
												<!--begin::Item-->
												<li class="breadcrumb-item text-gray-700 fw-bold lh-1 mx-n1">
													<a href="<?= base_url() ?>dashboard" class="text-hover-primary">
														<i class="ki-outline ki-home text-gray-700 fs-6"></i>
													</a>
												</li>
												<!--end::Item-->
												<!--begin::Breadcrumb-->
												<!--begin::Item-->
												<li class="breadcrumb-item">
													<i class="ki-outline ki-right fs-7 text-gray-700"></i>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item text-gray-700 fw-bold lh-1 mx-n1">
													<a href="<?= base_url() ?>Staffs" class="text-dark" >
														<?php print_r($folder); ?>
													</a>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item">
													<i class="ki-outline ki-right fs-7 text-gray-700"></i>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item text-gray-500  fw-bold mx-n1">Profile</li>
												<!--end::Item-->
											</ul>
											<!--end::Breadcrumb-->
											<!--begin::Title-->
											<h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 ms-n1">Staff Profile</h1>
											<!--end::Title-->
										</div>
										<!--end::Page title-->
									</div>
									<!--end::Toolbar wrapper-->
								</div>
								<!--end::Toolbar-->
								<!--begin::Content-->
								<div id="kt_app_content" class="app-content">
									<!--begin::Navbar-->
									<div class="card mb-5 mb-xl-10">
										<div class="card-body pt-9 pb-0">
											<!--begin::Details-->
											<div class="d-flex flex-wrap flex-sm-nowrap">
												<!--begin: Pic-->
												<div class="me-7 mb-4">
													<div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
														<img src="<?= base_url() ?>assets1/media/avatars/300-1.jpg" alt="image" />
														<div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
													</div>
												</div>
												<!--end::Pic-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<!--begin::Title-->
													<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
														<!--begin::User-->
														<div class="d-flex flex-column">
															<!--begin::Name-->
															<div class="d-flex align-items-center mb-2">
																<a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"><?=$staff->name?></a>
																<a href="#">
																	<i class="ki-outline ki-verify fs-1 text-primary"></i>
																</a>
															</div>
															<!--begin::Input group-->
															<div class="row mb-0">
																<!--begin::Label-->
																<label class="col-lg-12 col-form-label fw-semibold fs-6">App Enabled</label>
																<!--begin::Label-->
																<div class="col-lg-12 d-flex align-items-center">
																	<div class="form-check form-check-solid form-switch form-check-custom fv-row">
																		<input class="form-check-input w-45px h-30px" type="checkbox" id="allowmarketing" checked="checked" />
																		<label class="form-check-label" for="allowmarketing"></label>
																	</div>
																</div>
																<!--begin::Label-->
															</div>

															<!--end::Input group-->
															<!--end::Name-->
															<!--begin::Info-->
															<!-- <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
																<a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
																<i class="ki-outline ki-profile-circle fs-4 me-1"></i>Developer</a>
																<a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
																<i class="ki-outline ki-geolocation fs-4 me-1"></i>SF, Bay Area</a>
																<a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
																<i class="ki-outline ki-sms fs-4"></i>max@kt.com</a>
															</div> -->
															<!--end::Info-->
														</div>
														<!--end::User-->
													</div>
													<!--end::Title-->
												</div>
												<!--end::Info-->
											</div>
											<!--end::Details-->
											<!--begin::Navs-->
											<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
												<!--begin::Nav item-->
												<li class="nav-item mt-2">
													<a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="<?= base_url()?>Staffs/Profile">Profile</a>
												</li>
												<!--end::Nav item-->
												<!--begin::Nav item-->
												<li class="nav-item mt-2">
													<a class="nav-link text-active-primary ms-0 me-10 py-5 edit_btn" href="<?= base_url()?>Staffs/Device_settings?uid=<?= urlencode($staff->uid) ?>&userid=<?= urlencode($staff->userid) ?>">Devices</a>
												</li>
												<!--end::Nav item-->
											</ul>
											<!--begin::Navs-->
										</div>
									</div>
									<!--end::Navbar-->
									<!--begin::details View-->
									<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
										<!--begin::Card header-->
										<div class="card-header cursor-pointer">
											<!--begin::Card title-->
											<div class="card-title m-0">
												<h3 class="fw-bold m-0">Profile Details</h3>
											</div>
											<!--end::Card title-->
											<!--begin::Action-->
											<a class="btn btn-sm btn-primary align-self-center edit_btn" data-bs-toggle="modal" data-bs-target="#staff_edit_modal" id="<?=$staff->id?>" staffname="<?=$staff->name?>" userid="<?=$staff->userid?>" uid="<?=$staff->uid?>"  >Edit Profile</a>
											<!--end::Action-->
										</div>
										<!--begin::Card header-->
										<!--begin::Card body-->
										<div class="card-body p-9">
											<!--begin::Row-->
											<div class="row mb-7">
												<!--begin::Label-->
												<label class="col-lg-4 fw-semibold text-muted">Full Name</label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-8">
													<span class="fw-bold fs-6 text-gray-800 text-capitalize"><?=$staff->name?></span>
												</div>
												<!--end::Col-->
											</div>
											<!--end::Row-->
											<!--begin::Input group-->
											<div class="row mb-7">
												<!--begin::Label-->
												<label class="col-lg-4 fw-semibold text-muted">Branch</label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-8 fv-row">
													<span class="fw-semibold text-gray-800 text-capitalize fs-6"><?=$staff->branch_name?></span>
												</div>
												<!--end::Col-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="row mb-7">
												<!--begin::Label-->
												<label class="col-lg-4 fw-semibold text-muted">UserID</label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-8">
													<a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary"><?=$staff->userid?></a>
												</div>
												<!--end::Col-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="row mb-7">
												<!--begin::Label-->
												<label class="col-lg-4 fw-semibold text-muted">Uid</label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-8">
													<a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary"><?=$staff->uid?></a>
												</div>
												<!--end::Col-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="row mb-7">
												<!--begin::Label-->
												<label class="col-lg-4 fw-semibold text-muted">Password</label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-8">
													<a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary"><?=$staff->password?></a>
												</div>
												<!--end::Col-->
											</div>
											<!--end::Input group-->
											<div class="row mb-7">
												<!--begin::Label-->
												<label class="col-lg-4 fw-semibold text-muted">Card No</label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-8">
													<span class="fw-bold fs-6 text-gray-800"><?=$staff->cardno?></span>
												</div>
												<!--end::Col-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="row mb-10">
												<!--begin::Label-->
												<label class="col-lg-4 fw-semibold text-muted">Status</label>
												<!--begin::Label-->
												<!--begin::Label-->
												<div class="col-lg-8">
													<span class="fw-semibold fs-6 text-gray-800"><?=$staff->status?></span>
												</div>
												<!--begin::Label-->
											</div>
											<!--end::Input group-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::details View-->		
												
<?php echo view('include_modals/Staffs_modals') ?>


<?php echo view('include_scripts/Staffs_scripts') ?>