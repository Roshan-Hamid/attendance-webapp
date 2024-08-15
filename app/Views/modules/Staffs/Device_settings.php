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
												<!--begin::Item-->
												<li class="breadcrumb-item">
													<i class="ki-outline ki-right fs-7 text-gray-700"></i>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item text-gray-700 fw-bold lh-1 mx-n1">
													<a href="<?= base_url() ?>Staffs" class="text-dark" >
														<?php echo($folder); ?>
													</a>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item">
													<i class="ki-outline ki-right fs-7 text-gray-700"></i>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item text-gray-700 fw-bold lh-1 mx-n1">
													<a onclick="history.back()">Profile</a>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item">
													<i class="ki-outline ki-right fs-7 text-gray-700"></i>
												</li>
												<!--end::Item-->
												<!--begin::Item-->
												<li class="breadcrumb-item text-gray-500  fw-bold  mx-n1">
													<a href="#" class="text-gray-500">Device Settings</a>
												</li>
												<!--end::Item-->
											</ul>
											<!--end::Breadcrumb-->
											<!--begin::Title-->
											<!-- <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 ms-n1">Device Settings</h1> -->
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
														<img src="<?= base_url()?>assets1/media/avatars/300-1.jpg" alt="image" />
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
													<!--begin::Stats-->
													<!-- <div class="d-flex flex-wrap flex-stack">
														<div class="d-flex flex-column flex-grow-1 pe-8">
															<div class="d-flex flex-wrap">
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<div class="d-flex align-items-center">
																		<i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
																		<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$">0</div>
																	</div>
																	<div class="fw-semibold fs-6 text-gray-500">Earnings</div>
																</div>
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<div class="d-flex align-items-center">
																		<i class="ki-outline ki-arrow-down fs-3 text-danger me-2"></i>
																		<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="80">0</div>
																	</div>
																	<div class="fw-semibold fs-6 text-gray-500">Projects</div>
																</div>
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<div class="d-flex align-items-center">
																		<i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
																		<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%">0</div>
																	</div>
																	<div class="fw-semibold fs-6 text-gray-500">Success Rate</div>
																</div>
															</div>
														</div>>
														<div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
															<div class="d-flex justify-content-between w-100 mt-auto mb-2">
																<span class="fw-semibold fs-6 text-gray-500">Profile Compleation</span>
																<span class="fw-bold fs-6">50%</span>
															</div>
															<div class="h-5px mx-3 w-100 bg-light mb-3">
																<div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
													</div> -->
												</div>
												<!--end::Info-->
											</div>
											<!--end::Details-->
											<!--begin::Navs-->
											<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
												<!--begin::Nav item-->
												<li class="nav-item mt-2">
													<a class="nav-link text-active-primary ms-0 me-10 py-5" onclick="history.back()">Profile</a>
												</li>
												<!--end::Nav item-->
												<!--begin::Nav item-->
												<li class="nav-item mt-2">
													<a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="#">Devices</a>
												</li>
												<!--end::Nav item-->
											</ul>
											<!--begin::Navs-->
										</div>
									</div>
									<!--end::Navbar-->
									<!--begin::Basic info-->
									<div class="card mb-5 mb-xl-10">
										<!--begin::Card header-->
										<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
											<!--begin::Card title-->
											<div class="card-title py-6 px-9">
												<h3 class="fw-bold m-0">Device Settings</h3>
											</div>
											<div class="card-title d-flex justify-content-end py-6 px-9">
												<button type="submit" class="btn btn-primary"data-bs-toggle="modal"data-bs-target="#add_device_modal" id="add_device" staff_id="<?=$staff->id?>"device_id="<?=json_decode($staff->device_id, true); ?>"><i class="bi bi-plus-square-fill" style="font-size:20px;"></i> Add Device</button>
											</div>
											<!--end::Card title-->
										</div>
										<!--begin::Card header-->
										<!--begin::Content-->
										<div id="kt_account_settings_profile_details" class="collapse show">
											<!--begin::Form-->
											<form id="form_staff_edit" class="form">
												<!--begin::Card body-->
												<div class="card-body border-top p-9">
													
													<!--begin::Input group-->
													<div class="row mb-6">
														<!--begin::Label-->
														<label class="col-lg-3 col-form-label fw-semibold fs-6">Devices</label>
														<!--end::Label-->
														<!--begin::Col-->
														<div class="col-lg-6">
															<?php echo view('include_tables/table_staff_device_view') ?>
														</div>
														<!--end::Col-->
													</div>
													<!--end::Input group-->
													
												</div>
												<!--end::Card body-->
												<!--begin::Actions-->
												<!-- <div class="card-footer d-flex justify-content-end py-6 px-9">
													<button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
													<button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
												</div> -->
												<!--end::Actions-->
											</form>
											<!--end::Form-->
										</div>
										<!--end::Content-->
									</div>
									<!--end::Basic info-->
								</div>
								<!--end::Content-->
							</div>
							<!--end::Content wrapper-->
						</div>
						<!--end:::Main-->
					</div>
					<!--end::Wrapper container-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->
		
		<!--begin::Scrolltop-->
		<!-- <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-outline ki-arrow-up"></i>
		</div> -->
		<!--end::Scrolltop-->
		
		<!--begin::Javascript-->
		<script>var hostUrl = "<?= base_url()?>assets1/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?= base_url()?>assets1/plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url()?>assets1/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="<?= base_url()?>assets1/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="<?= base_url()?>assets1/js/custom/account/settings/signin-methods.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/account/settings/profile-details.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/account/settings/deactivate-account.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/pages/user-profile/general.js"></script>
		<script src="<?= base_url()?>assets1/js/widgets.bundle.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/widgets.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/apps/chat/chat.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/utilities/modals/create-campaign.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/utilities/modals/offer-a-deal/type.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/utilities/modals/offer-a-deal/details.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/utilities/modals/offer-a-deal/finance.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/utilities/modals/offer-a-deal/complete.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/utilities/modals/offer-a-deal/main.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/utilities/modals/two-factor-authentication.js"></script>
		<script src="<?= base_url()?>assets1/js/custom/utilities/modals/users-search.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
		
<?php echo view('include_modals/Staffs_modals') ?>


<?php echo view('include_scripts/Staffs_scripts') ?>