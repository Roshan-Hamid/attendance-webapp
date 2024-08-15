<!-- <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />  -->


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

  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container pt-7">
      <!--begin::Dashboard-->
      <!--begin::Card-->
       <div class="card card-custom">
        
        <div class="card-body pt-7">

          <!-- <form action="" method="post"> -->

          <div class="row">

          <div class="col-md-12" style="display: flex; justify-content: flex-end; !important;">
          <div class="form-group mx-20">
            <button type="button" class="btn btn-clean  btn-icon btn-icon-primary btn-active-light-primary " data-bs-toggle="modal"data-bs-target="#attendance_add_modal">
              <i class="bi bi-plus-square-fill"style="font-size:25px;"></i>
            </button>
          </div>
        </div>
           

          <div class="col-md-3">
              <div class="form-group">
                  <label for="table_filter_branch">Branch Name:<span class="text-danger">*</span></label>
                  <div class="select-icon select-icon-right">
                      <select required class="form-control form-control-lg"name="branch" id="table_filter_branch">
                      </select>
                  </div>
              </div>
          </div>
          <div class="col-md-3">
              <div class="form-group">
                  <label for="datepicker_start_date">Start Date</label>
                  <div class="input-icon input-icon-right">
                      <input type='text' class="form-control" name="start_date" id='datepicker_start_date' value="<?= date('d-m-Y', strtotime(date('d-m-Y'))) ?>" />
                  </div>
              </div>
          </div>
          <div class="col-md-3">
              <div class="form-group">
                  <label for="datepicker_end_date">End Date</label>
                  <div class="input-icon input-icon-right">
                      <input type='text' class="form-control" name="end_date" id='datepicker_end_date' value="<?= date('d-m-Y') ?>" />
                  </div>
              </div>
          </div>
          
          <div class="col-md-3">
              <div class="form-group mx-20">
                  <label></label>
                  <div class="input-icon input-icon-right">
                    <a href="#" class="btn btn-sm btn-light table_filters py-4">View</a>
                  </div>
              </div>
          </div>

        </div>

          <?php echo view('include_tables/table_Attendance') ?>
        </div>
      </div>
      <!--end::Card-->
    </div>
  </div>
</div>
<!--end::Content-->




<?php echo view('include_scripts/Attendance_scripts') ?>
<?php echo view('include_modals/attendance_modals') ?>
<script>

  $("#datepicker_start_date").datetimepicker({
                    format : "DD-MM-YYYY"
                });
  $("#datepicker_end_date").datetimepicker({
                    format : "DD-MM-YYYY"
                });


$("#date").datetimepicker({
                    format : "DD-MM-YYYY"
                });
//  $("#intime").datetimepicker({
//                     format : "HH:mm"
//                 });
 $("#intime").datetimepicker({
                    format : "LT"
                });
 $("#outtime").datetimepicker({
                    format : "LT"
                });

 $("#intime2").datetimepicker({
                    format : "LT"
                });
 $("#outtime2").datetimepicker({
                    format : "LT"
                });


$("#date_edit").datetimepicker({
                    format : "DD-MM-YYYY"
                });
 $("#intime_edit").datetimepicker({
                    format : "LT"
                });
 $("#outtime_edit").datetimepicker({
                    format : "LT"
                });
 $("#intime2edit").datetimepicker({
                    format : "LT"
                });
 $("#outtime2edit").datetimepicker({
                    format : "LT"
                });
               
</script>
