<!-- Create Staff Modal-->
<div class="modal fade" id="staff_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_staff_create" data-form-type="Employees" data-modal-id="staff_add_modal" method="POST" >
                <div class="modal-header border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                        <div class="text-center mb-13">
                            <h1 style="justify-content: center!important;" >Add Staff</h1>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="name" class="form-control form-control-lg form-control-solid" name="name" placeholder="Name" />
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
                                <select class="form-control form-control-lg form-control-solid" name="branch_id" id="branch">
                                <span><i class="select2-selection select2-selection--single form-select mb-2"></i></span>
                                </select></div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                   


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>User Id<span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="userid" class="form-control form-control-lg form-control-solid" name="userid" placeholder="User Id" />
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Uid<span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="uid" class="form-control form-control-lg form-control-solid" name="uid" placeholder="UId" />
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Status<span class="text-danger">*</span></label>
                                <div class="radio-inline form-control form-control-lg form-control-solid">
									<label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input w-30px h-20px" type="checkbox" value="ACTIVE" checked="checked" name="Status_unit" id="statusCheckbox" />
                                        <span id="statusLabel" class="form-check-label text-muted fs-6">ACTIVE</span>
									</label>
                                </div>
                            </div> 
                        </div> 
                    </div>

                    
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary mr-2 " data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-pill btn-primary font-weight-bold form_submit">Submit</button>
                </div>
                </div>

            </form>
        </div>
    </div>
</div>


<!-- Edit Modal-->
<div class="modal fade" id="staff_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_staff_edit" data-form-type="client" data-modal-id="staff_edit_modal" method="POST" >
            <div class="modal-header border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <div class="text-center mb-13">
                        <h1 style="justify-content: center!important;">Edit Staff</h1>
                    </div>

                    
                    <input type="hidden" id="staff_id" name="id">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="name_edit" class="form-control form-control-lg form-control-solid" name="name_edit"  />
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
                                <select class="form-control form-control-lg form-control-solid" name="branch_edit" id="branch_edit">
                                <span><i class="select2-selection select2-selection--single form-select mb-2"></i></span>
                                </select></div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                   


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>User Id<span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="userid_edit" class="form-control form-control-lg form-control-solid" name="userid_edit"  />
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Uid<span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="uid_edit" class="form-control form-control-lg form-control-solid" name="uid_edit" />
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Status<span class="text-danger">*</span></label>
                                <div class="radio-inline form-control form-control-lg form-control-solid">
									<label class="form-check form-switch form-check-custom form-check-solid">
									    <input class="form-check-input w-30px h-20px" type="checkbox" value="ACTIVE" checked="checked" name="Status_unit_edit" />
									    <span class="form-check-label text-muted fs-6">ACTIVE</span>
									</label>
                                </div>
                            </div> 
                        </div> 
                    </div>


                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary mr-2 " data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-pill btn-primary font-weight-bold form_submit">Update</button>
                </div>
                </div>

            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="staff_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this staff member?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="post" data-form-type="client" id="staff_delete" >
                    <input type="hidden" id="staff_id_delete" name="id">
                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Device Modal-->
<div class="modal fade" id="add_device_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_add_device"method="POST">
                <div class="modal-header border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <div class="text-center mb-13">
                        <h1 style="justify-content: center!important;">Add Device</h1>
                    </div>
                        <input type="hidden" id="staff_id2" name="staff_id2">
                        <input type="hidden" id="device_id" name="device_id">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Branch Name:<span class="text-danger">*</span></label>
                                <div class="select-icon select-icon-right">
                                    <select required class="form-control form-control-lg form-control-solid" name="select_branch" id="select_branch">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Device <span class="text-danger">*</span></label>
                                <div class="select-icon select-icon-right">
                                    <select required class="form-control form-control-lg form-control-solid"name="device" id="device">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End:Create Device Modal-->
