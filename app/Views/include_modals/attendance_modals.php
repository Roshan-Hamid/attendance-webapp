<!-- Create Attendance Modal-->
<div class="modal fade" id="attendance_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_attendance_create"method="POST">
                <div class="modal-header border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <div class="text-center mb-13">
                        <h1 style="justify-content: center!important;">Create Attendance</h1>
                    </div>
                        <!-- <input type="hidden" id="id" name="id"> -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Branch Name:<span class="text-danger">*</span></label>
                                <div class="select-icon select-icon-right">
                                    <select required class="form-control form-control-lg form-control-solid" name="add_branch" id="add_branch">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <div class="select-icon select-icon-right">
                                    <select required class="form-control form-control-lg form-control-solid"  id="staffname"name="userid">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Date<span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="date" class="form-control required form-control-lg form-control-solid" name="date"  />
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>In Time</label>
                                <div class="input-icon input-icon-right">
                                    <input type='text' class="form-control required form-control-lg form-control-solid" name="intime" id='intime' />
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Out Time <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="outtime" class="form-control required form-control-lg form-control-solid" name="outtime" />
                                </div>
                            </div>
                        </div>
                    </div>

                 
                    <div id="schedule_b_fields" style="display: none;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>In Time 2</label>
                                    <div class="input-icon input-icon-right">
                                        <input type='text' class="form-control required form-control-lg form-control-solid" name="intime2" id='intime2' />
                                    </div>
                                </div>
                            </div>
                        </div>
                                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Out Time 2<span class="text-danger">*</span></label>
                                    <div class="input-icon input-icon-right">
                                        <input type="text" id="outtime2" class="form-control required form-control-lg form-control-solid" name="outtime2" />
                                    </div>
                                </div>
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


<!-- Edit Attendance Modal-->
<div class="modal fade" id="attendance_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_attendance_edit" method="POST">
                <div class="modal-header border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                        <div class="text-center mb-13">
                            <h1 style="justify-content: center!important;">Update Attendance</h1>
                        </div>

                    <input type="hidden" id="edit_id" name="edit_id">
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Branch Name:<span class="text-danger">*</span></label>
                                <div class="select-icon select-icon-right">
                                    <select required class="form-control form-control-lg form-control-solid" name="branch" id="edit_branch">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="name_edit" class="form-control form-control-lg form-control-solid" name="name" />
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Date<span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="date_edit" class="form-control required form-control-lg form-control-solid" name="date"  />
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>In Time</label>
                                <div class="input-icon input-icon-right">
                                    <input type='text' class="form-control required form-control-lg form-control-solid" name="intime" id='intime_edit' />
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Out Time <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="outtime_edit" class="form-control required form-control-lg form-control-solid" name="outtime"  />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="schedule_b_fields_edit" style="display: none;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>In Time 2</label>
                                    <div class="input-icon input-icon-right">
                                        <input type='text' class="form-control required form-control-lg form-control-solid" name="intime2" id='intime2edit' />
                                    </div>
                                </div>
                            </div>
                        </div>
                                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Out Time 2<span class="text-danger">*</span></label>
                                    <div class="input-icon input-icon-right">
                                        <input type="text" id="outtime2" class="form-control required form-control-lg form-control-solid" name="outtime2edit" />
                                    </div>
                                </div>
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
