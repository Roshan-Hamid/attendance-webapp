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
   					<div class="row g-5 g-xl-12">
						<div class="col-xl-12">
							<!--begin::List Widget 1-->
							<div class="card card-stretch mb-1">
								<!--begin::Header-->
                                <?php
                                            $this->session = \Config\Services::session(); // Initialize session if not already initialized
                                            $userRole = $this->session->get('user_role'); // Get the user role from the session
                                            if ($userRole !== "manager") { // Check if user role is not equal to "manager"
                                            ?>
								<div class="card-header align-items-center border-0">
									<h3 class="card-title align-items-start flex-column">
									<!-- <span class="fw-bold text-gray-900 fs-3">My Competitors</span>
										<span class="text-gray-500 mt-2 fw-semibold fs-6">More than 400+ new members</span> -->
									</h3>
									<div class="card-toolbar">
										<!--begin::Menu-->
										<button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal"data-bs-target="#branch_add_modal">
                            				<i class="bi bi-plus-square-fill"style="font-size:25px;"></i>
										</button>
										<!--end::Menu-->
									</div>
								</div>
                                <?php } ?>

								<!--end::Header-->
								<!--begin::Body-->
								<div class="card-body py-0 pb-10">
									<div class="row">
										<?php echo view('include_tables/table_Branch') ?>
									</div>
								</div>
								<!--end::Body-->
							</div>
							<!--end::List Widget 1-->
						</div>
						<div class="col-xl-6">
						<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
							<div class="offcanvas-header">
								<!-- <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Colored with scrolling</h5> -->
								<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<div class="offcanvas-body">
								<div class="card d-flex justify-content-between mb-0">
									<div class="card-header align-items-center border-0 mt-4">
										<h3 class="card-title align-items-start flex-column">
										<span class="fw-bold text-uppercase text-gray-900" id="branch_name_title"></span>
											<span class="text-muted mt-1 fw-semibold fs-7" id="location_title"></span>
										</h3>
										<div class="card-toolbar">
											<button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
												<i class="ki-outline ki-dots-square fs-1 text-gray-500 me-n1"></i>
											</button>
												<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
													<div class="menu-item px-3">
														<a data-bs-toggle="modal"data-bs-target="#branch_edit_modal" class="menu-link px-3">Edit Branch</a>
													</div>
													<div class="menu-item px-3">
														<a data-bs-toggle="modal"data-bs-target="#branch_delete_modal" class="menu-link px-3">Delete Branch</a>
													</div>
													<div class="menu-item px-3">
														<a data-bs-toggle="modal" data-bs-target="#time_edit_modal" class="menu-link px-3" id="schedule_edit_btn">Edit Shedule</a>
													</div>
													<div class="menu-item px-3">
														<a data-bs-toggle="modal"data-bs-target="#Device_add_modal" class="menu-link px-3" id="schedule_edit_btn">Add Device</a>
													</div>
												</div>			
										</div>
									</div>
									<div class="card-body pt-0"id="">
									<div class="row py-5"> 
										<div class="card mb-5"> 
											<!-- <div class="card-toolbar d-flex justify-content-between align-items-start"> -->
												<h4 class="fw-bold text-uppercase text-gray-400 mb-0 mt-3">Schedules</h4>
											<!-- </div> -->
											<div class="col-md-12">
											<?php echo view('include_tables/table_shedule') ?>
											</div>
											</div>

											<div class="card mb-5">
												<!-- <div class="card-toolbar d-flex justify-content-between align-items-start mb-0 mt-5"> -->
													<h4 class="fw-bold text-uppercase text-gray-400 mb-0 mt-3">Devices</h4>
														<!-- <button type="button" class="btn btn-clean  btn-icon btn-icon btn-active-light-secondary fa-3x me-n3" data-bs-toggle="modal"data-bs-target="#Device_add_modal">
															<i class="bi bi-plus-square-fill"style="font-size:25px;"></i>
														</button> -->
												<!-- </div> -->
												<div class="card-body mt-0 pt-0">
													<?php echo view('include_tables/table_Devices') ?>
												</div>
											</div>
											</div>
											</div>
											</div>
											</div>
										</div>
										<!--end::col-->
									</div>
									<!--end::Row-->
								</div>
							</div>
							<!--end::Container-->
						</div>
					</div>
        		</div>
				<!--end::Content-->
      		</div>
      		<!--end::Card-->
    	</div>
  	</div>
</div>
<!--end::Content-->

<?php echo view('include_modals/branches_modals') ?>

<?php echo view('include_scripts/branches_scripts') ?>

<script>

$(function () {            
$("#start_timepicker").datetimepicker({
	format : "HH:mm"
}); 
$("#end_timepicker").datetimepicker({
	format : "HH:mm"
}); 
$("#break_timepicker").datetimepicker({
	format : "HH:mm"
}); 
$("#schedule_b_start_timepicker").datetimepicker({
	format : "HH:mm"
}); 
$("#schedule_b_end_timepicker").datetimepicker({
	format : "HH:mm"
}); 
$("#schedule_b_break_timepicker").datetimepicker({
	format : "HH:mm"
}); 
});              


$(document).ready(function() {
    function handleCheckboxChange() {
        if ($('#schedule_b_checkbox').is(':checked')) {
            $('#schedule_b_fields').show();
            $('#schedule_b_start_timepicker, #schedule_b_end_timepicker, #schedule_b_break_timepicker').prop('disabled', false);
        } else {
            $('#schedule_b_fields').hide();
            $('#schedule_b_start_timepicker, #schedule_b_end_timepicker, #schedule_b_break_timepicker').prop('disabled', true).val('');
        }
    }

// Bind the change event directly to the checkbox
	$('#schedule_b_checkbox').change(handleCheckboxChange);

// Initially trigger the event handler to handle initial state
	handleCheckboxChange();
});
  
</script>   