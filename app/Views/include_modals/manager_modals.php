<!-- Bootstrap Select Picker CSS (CDN) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">

<!-- Bootstrap Select Picker JavaScript (CDN) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>


<!-- Manager Create Modal-->
<div class="modal fade" id="manager_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_manager_create" data-form-type="manager" data-modal-id="manager_add_modal" method="POST" >
                <!-- <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body"-->
                <div class="modal-header border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                        <div class="text-center mb-13">
                            <h1 style="justify-content: center!important;" >Add Manager</h1>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Full Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="name" class="form-control form-control form-control-lg form-control-solid" name="name" placeholder="Full Name"/>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email<span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="email" id="user_name" class="form-control form-control-lg  form-control-solid" name="user_name" placeholder="Email"/>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="Password" class="form-control form-control-lg form-control-solid" name="password" placeholder="Password"/>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Branch Name:<span class="text-danger">*</span></label>
                                <div class="select-icon select-icon-right">
                                <select class="form-control form-control-lg form-control-solid" name="branch[]" id="branch" multiple>
                                <?php 
                                print_r($branches);
                                if (isset($branches)) {
                                foreach ($branches as $branch) { 
                                $selected = '';
                               
                                echo "<option value='$branch->branch_id'   $selected>$branch->branch_name</option>";
                                }
                            }
                                ?>
                            </select></div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                    
                        

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary mr-2 " data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-pill btn-primary font-weight-bold form_submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!--Edit manager Modal-->
<div class="modal fade" id="manager_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_manager_edit" data-form-type="client" data-modal-id="manager_edit_modal" method="POST">
                    <div class="modal-header border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                        <div class="text-center mb-13">
                            <h1 style="justify-content: center!important;" >Edit User</h1>
                        </div>
                        <input type="hidden" id="user_id_edit" name="user_id">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <div class="input-icon input-icon-right">
                                            <input required type="text" id="name_edit" class="form-control form-control-lg form-control-solid" name="name_edit" placeholder="Full Name"/>
                                        </div>
                                        <span class="form-text text-muted"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <div class="input-icon input-icon-right">
                                            <input required type="email" id="user_name_edit" class="form-control form-control-lg text-lowercase form-control-solid" name="user_name_edit" placeholder="name"/>
                                        </div>
                                        <span class="form-text text-muted"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <div class="input-icon input-icon-right">
                                            <input required type="text" id="password_edit" class="form-control form-control-lg form-control-solid" name="password_edit" placeholder="Password"/>
                                        </div>
                                        <span class="form-text text-muted"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label >Branch Name:<span class="text-danger">*</span></label>
                                        <div class="select-icon select-icon-right">
                                        <select class="form-control form-control-lg form-control-solid" name="branch_name_edit[]" id="branch1" multiple>
                                        <?php 
                                            if (isset($branches)) {
                                            foreach ($branches as $branch) { 
                                            echo "<option value='$branch->branch_id'>$branch->branch_name</option>";
                                            }
                                        }
                                            ?>
                                        </select></div>
                                        <span class="form-text text-muted"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary mr-2 " data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-pill btn-primary font-weight-bold form_submit">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Delete Manager Modal -->
<div class="modal fade" id="manager_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" data-form-type="client" id="form_manager_delete">
      <div class="modal-header">
                <h5 class="modal-title">Warning! Please Confirm Your Action</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>
        <div class="modal-body">
          <p>Are You Sure to Delete this User? All the associated data will be lost.</p>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Confirm and Delete</button>
        </div>

        <input type="hidden" id="user_id_delete" name="user_id">
      </form>
    </div>
  </div>
</div>
