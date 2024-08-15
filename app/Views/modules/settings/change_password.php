<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid py-7" id="kt_content">
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
                            Change Password
                        </h3>
                    </div>

                    <form autocomplete="off" id="form_change_password" data-form-type="password" data-form-location="body" method="post">

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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="current_password">Current Password <span class="text-danger">*</span></label>
                                    <input autocomplete="off" required type="password" class="form-control" id="current_password" name="current_password" placeholder="Password"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">New Password <span class="text-danger">*</span></label>
                                    <input required type="password" class="form-control" name="password" id="password" placeholder="Password"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm New Password <span class="text-danger">*</span></label>
                                    <input required autocomplete="off" type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password"/>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="card-footer border-0">
                        <div class="float-right mb-8">
                            <button type="submit" class="btn btn-primary mr-2 float-right form_submit">Submit</button>
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
<?php echo view('include_scripts/Settings_scripts') ?>

<!-- <script type="text/javascript">
    $('.active').removeClass('menu-item-active');
    $('#password_menu').addClass('menu-item-active');
</script> -->
