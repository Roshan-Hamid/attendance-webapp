<script type="text/javascript">
function GetbranchName() {
        return $('#branch').val();
    }
    function Getbranch() {
    return $('#table_filter_branch').val();
  }
$(document).ready(function() {

$.ajax({
    url: '<?= base_url() . 'Staffs/DropdownData' ?>',
    type: 'POST',
    dataType: 'json',
    success: function(data) {
        var select = $('#branch');
        select.empty();
        for (var i = 0; i < data[0].length; i += 2) {
            var id = data[0][i];
            var name = data[0][i + 1];
            select.append('<option value="' + id + '">' + name + '</option>');
        }

        select.trigger('change');
    },
    
    error: function(error) {
        console.error('Error fetching branch data:', error);
    }
});

$.ajax({
    url: '<?= base_url() . 'Staffs/DropdownData' ?>',
    type: 'POST',
    dataType: 'json',
    success: function(data) {
        var select = $('#table_filter_branch');
        select.empty();
        for (var i = 0; i < data[0].length; i += 2) {
            var id = data[0][i];
            var name = data[0][i + 1];
            select.append('<option value="' + id + '">' + name + '</option>');
        }
        select.trigger('change');
    },
    
    error: function(error) {
        console.error('Error fetching table_filter_branch data:', error);
    }
});

$.ajax({
    url: '<?= base_url() . 'Staffs/DropdownData' ?>',
    type: 'POST',
    dataType: 'json',
    success: function(data) {
        var select = $('#branch_edit');
        select.empty();
        for (var i = 0; i < data[0].length; i += 2) {
            var id = data[0][i];
            var name = data[0][i + 1];
            select.append('<option value="' + id + '">' + name + '</option>');
        }

        select.trigger('change');
    },
    
    error: function(error) {
        console.error('Error fetching branch data:', error);
    }
});

$.ajax({
    url: '<?= base_url() . 'Staffs/DropdownData' ?>',
    type: 'POST',
    dataType: 'json',
    success: function(data) {
        var select = $('#select_branch');
        select.empty();
        for (var i = 0; i < data[0].length; i += 2) {
            var id = data[0][i];
            var name = data[0][i + 1];
            select.append('<option value="' + id + '">' + name + '</option>');
        }

        select.trigger('change');
    },
    
    error: function(error) {
        console.error('Error fetching branch data:', error);
    }
});

});
// $(document).ready(function() {
        // Function to get selected branch
        function getBranch() {
          return $('#select_branch').val();
        }
        // Fetch device data based on selected branch
        function fetchdevice() {
            $.ajax({
                url: '<?= base_url() . 'Staffs/DeviceDropdownData' ?>',
                type: 'POST',
                data: {
                    branch: getBranch(),
                },
                dataType: 'json',
                success: function(data) {
                    var select = $('#device');
                    select.empty();
                    for (var i = 0; i < data[0].length; i += 2) {
                        var id = data[0][i];
                        var name = data[0][i + 1];
                        let selected='';
                        select.append('<option value="' + id + '" '+selected+'>' + name + '</option>');
                    }
                    select.trigger('change');
                },
                error: function(error) {
                    var select = $('#device');
                    select.empty();
                    console.error('Error fetching device data:', error);
                }
            });
        };
        $('#select_branch').on('change', fetchdevice);
            $(document).ready(function() {
              fetchdevice();
            });
            
// });
$(document).ready(function() {

  var Staffs_view_table = $('#Staffs_view_table').DataTable({

    "ajax": {
      url: "<?= base_url() . 'Staffs/select_Staffs' ?>",
      type: "post",
      data: function(d) {
        d.branch_filter = Getbranch();
      }
    },
  });

  $(".table_filters").on("change", function() {
    Staffs_view_table.ajax.reload();
  });
});

  $(document).ready(function() {
      var Devices_view_table = $('#Devices_view_table').DataTable({
      "ajax":{
      url :"<?= base_url().'Staffs/select_Devices' ?>",
      type: "post",
      data: function() {
       // Validate and sanitize $_GET['userid']
       var userid = <?php echo isset($_GET['userid']) ? json_encode($_GET['userid']) : 'null'; ?>;
       // console.log(userid);
       userid = userid;
        }                  
      },
      });
  });


    $(document).ready(function() {
      $('#form_staff_create').submit(function(e) {
        e.preventDefault();
      var formData = $(this).serialize();
    $.ajax({
      url :"<?= base_url().'Staffs/create' ?>",
      type: "post",
      data: formData,
      success: function(response) {
      console.log(response);
      var staff = response.staff;
      if (response.success) {
        Swal.fire("Created !!", staff + " Created Successfully!", "success");
        $('#form_staff_create')[0].reset();
        $('#staff_add_modal').modal('hide');
        $('#Staffs_view_table').DataTable().ajax.reload();
        } else {
            Swal.fire("Error !!", response.message, "error");
        }
        },
      error: function(xhr, status, error) {
      console.error(xhr.responseText);
      var message = response.message;
      Swal.fire(message)
      }
    });
    });
  });

  $(document).ready(function() {
        $('#form_staff_edit').submit(function(e) {
          e.preventDefault();
        var formData = $(this).serialize();
      $.ajax({
        url :"<?= base_url().'Staffs/update' ?>",
        type: "post",
        data: formData,
        success: function(response) {
        console.log(response);
        var staff = response.staff;
        Swal.fire("Updated !!", staff + " Updated Successfully!", "success");
        $('#staff_edit_modal').modal('hide');
        // $('#Staffs_view_table').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
        console.error(xhr.responseText);
        var message = response.message;
        Swal.fire(message)
        }
      });
      });
    });

    $(document).ready(function() {
      $('#staff_delete').submit(function(e) {
        e.preventDefault();
      var formData = $(this).serialize();
    $.ajax({
      url :"<?= base_url().'Staffs/delete' ?>",
      type: "post",
      data: formData,
      success: function(response) {
      console.log(response);
      Swal.fire("Deleted !!", "Staff Deleted Successfully!", "success");
      $('#staff_delete_modal').modal('hide');
      $('#Staffs_view_table').DataTable().ajax.reload();
      },
      error: function(xhr, status, error) {
      console.error(xhr.responseText);
      var message = response.message;
      Swal.fire(message)
      }
    });
    });
  });

  $(document).ready(function() {
      $('#form_add_device').submit(function(e) {
        e.preventDefault();
      var formData = $(this).serialize();
    $.ajax({
      url :"<?= base_url().'Staffs/AddDevice' ?>",
      type: "post",
      data: formData,
      success: function(response) {
      console.log(response);
      var device = response.device;
      if (response.success) {
        Swal.fire("Created !!", device + " Added Successfully!", "success");
        $('#form_add_device')[0].reset();
        $('#add_device_modal').modal('hide');
        $('#Devices_view_table').DataTable().ajax.reload();
        } else {
            Swal.fire("Error !!", response.message, "error");
        }
        },
      error: function(xhr, status, error) {
      console.error(xhr.responseText);
      Swal.fire("Incorrect... !!", "Sorry.. There Have been Some Error Occurred. Please Try Again!", "error")
      }
    });
    });
  });
    $(document).on('click', '.edit_btn', function() {
      var id = $(this).attr('id');
      var staffname = $(this).attr('staffname');
      var userid = $(this).attr('userid');
      var uid = $(this).attr('uid');
      console.log("userid:", userid);
      console.log("staffname:", staffname);
      console.log("staff_id Id:", id);
      $('#staff_id').val(id);
      $('#userid_edit').val(userid);
      $('#uid_edit').val(uid);
      $('#name_edit').val(staffname);
  });

  $(document).on('click', '#add_device', function() {
    var id = $(this).attr('staff_id');
    var device_id = $(this).attr('device_id');
    console.log("staff_id:", id);
    console.log("device_id:", device_id);
    $('#staff_id2').val(id);
    $('#device_id').val(device_id);
  });
    $(document).on('click','.delete_btn', function() {
       var id = $(this).attr('id');
       console.log("staff_id Id:", id);
       $('#staff_id_delete').val(id);
   });



</script>