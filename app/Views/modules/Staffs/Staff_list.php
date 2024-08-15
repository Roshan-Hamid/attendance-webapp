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
				<li class="breadcrumb-item text-gray-500 mx-n1"><?php print_r($folder); ?></li>
              	<!--end::Item-->
			</ul>
			<!--end::Breadcrumb-->
			<!--begin::Title-->
			<h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 ms-n1"></h1>
			<!--end::Title-->
		</div>
		<!--end::Page title-->
		<!--begin::Actions-->
		<div class="d-flex align-items-center gap-2 gap-lg-3">
			<!-- <a href="#" class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold" data-bs-toggle="modal"data-bs-target="#material_add_modal">Add Branch</a> -->
			<!-- <a href="#" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">New Device</a> -->
		</div>
		<!--end::Actions-->
	</div>
	<!--end::Toolbar wrapper-->
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<div class="d-flex flex-column-fluid">
			<div class="container">
				<!-- <div class="card card-custom"> -->
  				<div class="card-body pt-7">
					<!--begin::Row-->
   					<div class="row g-5 g-xl-8">
						<div class="col-g-5 g-xl-8">
							<!--begin::List Widget 1-->
							<div class="card card-stretch mb-1">
								<!--begin::Header-->
								<div class="card-header align-items-center border-0">
									<h3 class="card-title align-items-start flex-column">
										<div class="form-group fs-5">
											<label for="table_filter_branch"></label>
											<div class="select-icon select-icon-right">
												<select required class="form-control form-control-lg table_filters"name="branch_filter" id="table_filter_branch">
												</select>
											</div>
										</div>
									</h3>
									<div class="card-toolbar">
										<!--begin::Menu-->
										<button type="button" class="btn btn-clean  btn-icon btn-icon-primary btn-active-light-primary fa-3x me-n3" data-bs-toggle="modal"data-bs-target="#staff_add_modal">
                      						<i class="bi bi-plus-square-fill"style="font-size:25px;"></i>
										</button>
										<!--end::Menu-->
									</div>
								</div>
								<!--end::Header-->
								<!--begin::Body-->
								<div class="card-body py-0 pb-10">
								
									<div class="row">
                  						<?php  echo view('include_tables/table_staff') ?>
										<?php //echo view('include_tables/table_Devices') ?>
									</div>
								</div>
								<!--end::Body-->
							</div>
							<!--end::List Widget 1-->
						</div>
										<!--end::col-->
									</div>
									<!--end::Row-->
							</div>
							<!--end::Container-->
						</div>
				<!--end::Content-->
      		</div>
      		<!--end::Card-->
    	</div>
  	</div>
</div>
<!--end::Content-->

 
<?php echo view('include_modals/Staffs_modals') ?>


<?php echo view('include_scripts/Staffs_scripts') ?>
