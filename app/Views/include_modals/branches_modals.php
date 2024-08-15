<!-- Create Branch Modal-->
<div class="modal fade" id="branch_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_branch_create" method="POST">
                <div class="modal-header border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <div class="text-center mb-13">
                        <h1 style="justify-content: center!important;">Create Branch</h1>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="branch_name" class="form-control text-capitalize form-control-lg form-control-solid" name="branch_name" placeholder="Name"/>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Location <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="location" class="form-control text-capitalize form-control-lg form-control-solid" name="branch_location" placeholder="Location"/>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- End:Create Branch Modal-->




<!-- Edit Branch Modal-->
<div class="modal fade" id="branch_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_branch_edit" method="POST">
                <div class="modal-header border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                        <div class="text-center mb-13">
                            <h1 style="justify-content: center!important;" >Update Branch</h1>
                        </div>

                    <input type="hidden" id="branch_id_edit" name="branch_id_edit">

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Branch Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="branch_name_edit" class="form-control form-control-lg form-control-solid" name="branch_name" placeholder="branch Name" value="" />
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Location <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="branch_location_edit" class="form-control text-capitalize form-control-lg form-control-solid" name="branch_location_edit" placeholder="Location"/>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>

    

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Create Device Modal-->
<div class="modal fade" id="Device_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_device_create"method="POST">
                <div class="modal-header border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <div class="text-center mb-13">
                        <h1 style="justify-content: center!important;">Create Device</h1>
                    </div>
                        <input type="hidden" id="branch_id" name="branch_id">

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Device Id<span class="text-danger">*</span></label>
                                    <div class="input-icon input-icon-right">
                                        <input required type="text" id="device_id" class="form-control form-control-lg form-control-solid" name="device_id" placeholder="Device Id"/>
                                    </div>
                                    <span class="form-text text-muted"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name<span class="text-danger"></span></label>
                                    <div class="input-icon input-icon-right">
                                        <input type="text" id="device_name" class="form-control form-control-lg form-control-solid" name="device_name" placeholder="Device Name"/>
                                        <span><i class="flaticon2-tag icon-md"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Device Ip<span class="text-danger">*</span></label>
                                    <div class="input-icon input-icon-right">
                                        <input required type="text" id="ip" class="form-control form-control-lg form-control-solid" name="device_ip" placeholder="Device Ip"/>
                                    </div>
                                    <span class="form-text text-muted"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Port<span class="text-danger">*</span></label>
                                    <div class="input-icon input-icon-right">
                                        <input type="text" id="port" class="form-control form-control-lg form-control-solid" name="port" placeholder="4370"/>
                                    </div>
                                    <span class="form-text text-muted"></span>
                                </div>
                            </div>
                        </div>
                    
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End:Create Device Modal-->

<!-- Edit Device Modal-->
<div class="modal fade" id="edit_device_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_device_edit"method="POST">
                <div class="modal-header border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <div class="text-center mb-13">
                        <h1 style="justify-content: center!important;">Update Device</h1>
                    </div>
                        <input type="hidden" id="device_id_edit" name="device_id">

                        

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name<span class="text-danger"></span></label>
                                    <div class="input-icon input-icon-right">
                                        <input type="text" id="device_name_edit" class="form-control form-control-lg form-control-solid" name="device_name" placeholder="Device Name"/>
                                        <span><i class="flaticon2-tag icon-md"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Device Id<span class="text-danger">*</span></label>
                                    <div class="input-icon input-icon-right">
                                        <input required type="text" id="device_id_edit" class="form-control form-control-lg form-control-solid" name="device_id_edit" placeholder="Device Id"/>
                                    </div>
                                    <span class="form-text text-muted"></span>
                                </div>
                            </div>
                        </div> -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Device Ip<span class="text-danger">*</span></label>
                                    <div class="input-icon input-icon-right">
                                        <input required type="text" id="device_ip" class="form-control form-control-lg form-control-solid" name="device_ip" placeholder="Device Ip"/>
                                    </div>
                                    <span class="form-text text-muted"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Device Port<span class="text-danger">*</span></label>
                                    <div class="input-icon input-icon-right">
                                        <input type="text" id="device_port" class="form-control form-control-lg form-control-solid" name="port" placeholder="Device port"/>
                                    </div>
                                    <span class="form-text text-muted"></span>
                                </div>
                            </div>
                        </div>
                    
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End:Create Device Modal-->

<!-- Edit Time Shedule Modal-->
<div class="modal fade" id="time_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_schedule_edit" data-form-type="material" data-modal-id="time_edit_modal" method="POST">
                <div class="modal-header border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>
                    <div class="modal-body mx-5 mx-xl-18 pt-0 pb-15">
                        <div class="text-center mb-13">
                            <h1 style="justify-content: center!important;" >Update Schedule</h1>
                        </div>
                        <input type="hidden" id="schedule_branch_id" name="branch_id">
                        <input type="hidden" id="schedule_branch_name" name="schedule_branch_name">

											<div class="row">  
												<div class="col-md-4">
													<div class="form-group">
														<label class="fs-6 fw-semibold mb-2" for="start_timepicker">Check In</label>
														<div class="col-sm-9">          
															<input required class="form-control" type="text" id="start_timepicker" name="start_timepicker" />
														</div>
													</div>  
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="fs-6 fw-semibold mb-2" for="end_timepicker">Check Out</label>
														<div class="col-sm-9">          
															<input required class="form-control" type="text" id="end_timepicker" name="end_timepicker"  />
														</div>
													</div>  
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="fs-6 fw-semibold mb-2" for="break_timepicker">Break</label>
														<div class="col-sm-9">          
															<input required class="form-control" type="text" id="break_timepicker" name="break_timepicker" />
														</div>
													</div>  
												</div>

 
                                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid my-10">
                                                    <input class="form-check-input" type="checkbox" value="checked" id="schedule_b_checkbox">
                                                    <label class="form-check-label" for="schedule_b_checkbox">Schedule 2</label>
                                                </div>

                                                <div id="schedule_b_fields" style="display: none;">
                                                    <div class="row">  
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="fs-6 fw-semibold mb-2" for="start_timepicker">Check In</label>
                                                                <div class="col-sm-9">          
                                                                    <input class="form-control" type="text" id="schedule_b_start_timepicker" name="schedule_b_start_timepicker" />
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="fs-6 fw-semibold mb-2" for="end_timepicker">Check Out</label>
                                                                <div class="col-sm-9">          
                                                                    <input class="form-control" type="text" id="schedule_b_end_timepicker" name="schedule_b_end_timepicker"  />
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="fs-6 fw-semibold mb-2" for="break_timepicker">Break</label>
                                                                <div class="col-sm-9">          
                                                                    <input class="form-control" type="text" id="schedule_b_break_timepicker" name="schedule_b_break_timepicker" />
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                                
											</div>
                        <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


 <!-- branch_delete_modal -->
 <div class="modal fade" id="branch_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warning! Please Confirm Your Action</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>
            <form method="post" id="branch_delete" data-modal-id="branch_delete_modal" >
                <div class="modal-body">
                    <p>Are You Sure to Delete this Data? All the associated data will be lost.</p>
                    <input type="hidden" id="branch_id_delete" name="branch_id_delete">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm and Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


 <!-- device_delete_modal -->
 <div class="modal fade" id="device_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warning! Please Confirm Your Action</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post"  id="device_delete" data-modal-id="device_delete_modal">
                <div class="modal-body">
                    <p>Are You Sure to Delete this Device? All the associated data will be lost.</p>
                    <input type="hidden" id="trash_id" name="trash_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm and Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>



