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
      <div class="card card-custom py-3">
          <div class="card-body card-body-custom">
              <!-- <form id="myForm" action="<?= base_url() ?>Report/export" method="post"> -->
              <form  action="" method="post">
              <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="branch_report_branch">Branch:<span class="text-danger">*</span></label>
                            <div class="select-icon select-icon-right branch_id" > 
                            <select  class="form-control"name="branch"id="branch_report_branch" >
                            <?php 
                            foreach ($branches as $branch) { 
                            $selected = '';
                            if(isset($staff)){
                                if($branch->branch_id == $staff->branch_id){
                                $selected = "selected='selected' ";
                                }
                            }
                            echo "<option value='$branch->branch_id'   $selected>$branch->branch_name</option>";
                            }

                             ?>
                        </select>
                            </div>
                    </div>
                </div>

             <div class="col-md-2">
                      <div class="form-group">
                      <label for="yearSelector">year:</label>
                <select class="form-control" id="yearSelector_branch_report" ></select>
                <script>
                    // Get the current year
                    var currentYear = new Date().getFullYear();

                    // Set the range of years you want to include
                    var startYear = currentYear - 4; 
                    var endYear = currentYear + 30;   

                    // Get the select element
                    var yearSelector = document.getElementById('yearSelector_branch_report');

                    // Populate the select element with years
                    for (var year = startYear; year <= endYear; year++) {
                        var option = document.createElement('option');
                        option.value = year;
                        option.text = year;
                        yearSelector.add(option);
                    }

                    // Set the default selected year
                    yearSelector.value = currentYear;

                </script>
              </select>
              </div>
           </div>  

           <div class="col-md-2">
            <div class="form-group">
              <label for="month">Month:</label>
              <select class="form-control" name="month" id="month_branch_report">
                <?php
                      $currentMonth = date('m');

                      $monthNames = [
                          '01' => 'January',
                          '02' => 'February',
                          '03' => 'March',
                          '04' => 'April',
                          '05' => 'May',
                          '06' => 'June',
                          '07' => 'July',
                          '08' => 'August',
                          '09' => 'September',
                          '10' => 'October',
                          '11' => 'November',
                          '12' => 'December',
                      ];
                      $monthNames = array_map('strtoupper', $monthNames);

                      foreach ($monthNames as $monthNumber => $monthName) {
                          $selected = ($currentMonth == $monthNumber) ? 'selected' : '';
                          echo "<option value='$monthNumber' $selected>$monthName</option>";
                      }
                      ?>
                 </select>
              </div>
           </div>


        
           <div class="col-md-2">
            <div class="form-group">
            <br>
              <div class="form-group text-md-end">
              <button type="submit" onclick="branch_report_view(event)" id="report"class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold" >Preview</button>
              </div> 
            </div>
           </div>
           </div>  
             
            </form>
                                         
        </div>
      </div>
      <!--end::Card-->
      <div class="card-container pt-7">
    <div class="card card-custom">
        <div class="card-body card-body-custom bord" id="cardContent2">
        </div>
    </div>
</div>
    </div>
  </div>
</div>
<!--end::Content-->
<?php //echo view('include_modals/Materials_modals') ?>
<?php echo view('include_scripts/Report_scripts') ?>
<script type="text/javascript">
 


</script>