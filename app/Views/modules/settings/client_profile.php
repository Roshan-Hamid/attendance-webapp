
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->

      <div class="row">

        <div class="col-md-3"></div>

        <div class="col-md-6 card card-custom">
          <div class="card-header">
            <h3 class="card-title">
              My Profile 
            </h3>
          </div>

          <form autocomplete="off" id="form_update_profile" data-form-type="sales_men_profilr" data-form-location="body" method="post" action="<?= base_url()?>settings/update_profile">

            <div class="card-body">
              <div class="form-group mb-8" >
                <div class="alert alert-custom alert-warning" role="alert" style="display: none;" id="form_change_password_alert">
                  <div class="alert-icon">
                    <i class="flaticon-warning text-white"></i>
                  </div>
                  <div class="alert-text">
                    Some field not properly filled , Please correct and try again
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-md-3"></div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="company_name">Profile Photo</label>

                    <div class="image-input" id="kt_image_3">

                      <?php if(!empty($this->session->userdata('employee_data')) && $this->session->userdata('employee_data')->profile_photo!=''){ ?>
                       <div class="image-input-wrapper" style="background-image: url(<?= base_url() ?>assets/media/sales_men/<?= $this->session->userdata('employee_data')->profile_photo ?>)"></div>
                     <?php } else { ?>
                      <div class="image-input-wrapper" style="background-image: url(<?= base_url() ?>assets/media/users/default.jpg"></div>
                     <?php } ?>

                     <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                      <i class="fa fa-pen icon-sm text-muted"></i>
                      <input required type="file" name="sales_man_photo" accept=".png, .jpg, .jpeg"/>
                      <input type="hidden" name="sales_man_photo_remove"/>
                    </label>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                      <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                  </div>
                </div>
              </div>

                <div class="col-md-3"></div>


            </div>




                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required required type="text" id="name" class="form-control form-control-pill form_hospital_add_fields" name="name" placeholder="Name" value="" />
                                    <span><i class="flaticon-user icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required required type="text" id="name" class="form-control form-control-pill form_hospital_add_fields" name="name" placeholder="E Mail"  />
                                    <span><i class="flaticon2 flaticon2-mail icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Contact <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required required type="text" id="name" class="form-control form-control-pill form_hospital_add_fields" name="name" placeholder="Contact" />
                                    <span><i class="flaticon2 flaticon2-phone icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                    </div>



          </div>

          <div class="card-footer">
            <div class="float-right mb-8">
              <button type="submit" class="btn btn-primary mr-2 float-right form_submit">Update Profile</button>
              <button type="reset" class="btn btn-secondary mr-2 ">Cancel</button>
            </div>
          </div>
        </form>
        <!--end::Form-->
      </div>

      <div class="col-md-3"></div>

    </div>

    <!--end::Dashboard-->
  </div>
  <!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!--end::Content-->

<script type="text/javascript">
  $('.active').removeClass('menu-item-active');
  $('#profile_menu').addClass('menu-item-active');

  var avatar3 = new KTImageInput('kt_image_3');

</script>
