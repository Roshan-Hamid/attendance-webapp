<script type="text/javascript">

$(document).ready(function() {

  $.ajax({
      url: '<?= base_url() . 'Branches/DropdownData' ?>',
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

});

  
    var Branch_view_table = $('#Branch_view_table').DataTable({

    "ajax":{
    url :"<?= base_url().'Branches/select_Branch' ?>",
    type: "post",
    data: function(d){
      }
    },
  });
  
 

function GetId(callback) {
    setTimeout(function() {
      var branchId = "";
        $('.togglefiter').on('click', function() {
            var id = $(this).attr('id');
            var name = $(this).attr('branch_name');
            var location = $(this).attr('location');

            callback(id); 
            branchId = id;
            $('#branch_id').text(id);
            $('#branch_name_title').text(name);
            $('#location_title').text(location);

            $('#branch_id_edit').val(id);
            $('#schedule_branch_id').val(id);
            $('#schedule_branch_name').val(name);
            $('#branch_id_delete').val(branchId);
            $('#branch_name_edit').val(name);
            $('#branch_location_edit').val(location);

        });
          $('body').on('click', '#Device_add_modal', function() {
          console.log("modal Id:", branchId); // Log the branch ID
          $('#branch_id').val(branchId); 
          });
         
    }, 500);
  }
  
  $(document).ready(function() {
    GetId(function(id) {
      var schedule_view_table = $('#schedule_view_table').DataTable({
        destroy: true,
      "ajax":{
      url :"<?= base_url().'Branches/select_schedule' ?>",
      type: "post",
      data: {
          id: id
        }
      },
      });
    });
  });
  
  $(document).ready(function() {
    GetId(function(id) {
      var Devices_view_table = $('#Devices_view_table').DataTable({
        destroy: true,
      "ajax":{
      url :"<?= base_url().'Branches/select_Devices' ?>",
      type: "post",
      data: {
          id: id
        }
      },
      });
    });
  });
 

  function GetScheduleId() {
    setTimeout(function() {

  $(document).ready(function() {
    var checkin = $('.timepick').attr('checkin');
    var checkout = $('.timepick').attr('checkout');
    var breaktime = $('.timepick').attr('breaktime');
    var checkin2 = $('.timepick2').attr('checkin2');
    var checkout2 = $('.timepick2').attr('checkout2');
    var breaktime2 = $('.timepick2').attr('breaktime2');


    $('#start_timepicker').val(checkin);
    $('#end_timepicker').val(checkout);
    $('#break_timepicker').val(breaktime);
    $('#schedule_b_start_timepicker').val(checkin2);
    $('#schedule_b_end_timepicker').val(checkout2);
    $('#schedule_b_break_timepicker').val(breaktime2);
   });
  }, 1000);
  }

  $(document).ready(function() {
      $('#form_branch_create').submit(function(e) {
         e.preventDefault();
      var formData = $(this).serialize();
    $.ajax({
      url :"<?= base_url().'Branches/create_branch' ?>",
      type: "post",
      data: formData,
      success: function(response) {
      console.log(response);
      var branchName = response.branch_name;
      Swal.fire("Created !!", branchName + " Created Successfully!", "success");
      $('#form_branch_create')[0].reset();
      $('#branch_add_modal').modal('hide');
      $('#Branch_view_table').DataTable().ajax.reload();
      },
      error: function(xhr, status, error) {
      console.error(xhr.responseText);
      Swal.fire("Incorrect... !!", "Sorry.. There Have been Some Error Occurred. Please Try Again!", "error")
      }
    });
    });
  });

  $(document).ready(function() {
      $('#form_branch_edit').submit(function(e) {
        e.preventDefault();
      var formData = $(this).serialize();
    $.ajax({
      url :"<?= base_url().'Branches/update_branch' ?>",
      type: "post",
      data: formData,
      success: function(response) {
      console.log(response);
      var branch_name = response.branch_name;
      Swal.fire("Updated !!", branch_name + " Updated Successfully!", "success");
      $('#branch_edit_modal').modal('hide');
      $('#Branch_view_table').DataTable().ajax.reload();
      },
      error: function(xhr, status, error) {
      console.error(xhr.responseText);
      Swal.fire("Incorrect... !!", "Sorry.. There Have been Some Error Occurred. Please Try Again!", "error")

      }
    });
    });
  });

  $(document).ready(function() {
      $('#form_device_edit').submit(function(e) {
        e.preventDefault();
      var formData = $(this).serialize();
    $.ajax({
      url :"<?= base_url().'Branches/update_device' ?>",
      type: "post",
      data: formData,
      success: function(response) {
      console.log(response);
      var device_name = response.device_name;
      Swal.fire("Updated !!", device_name + " Updated Successfully!", "success");
      $('#edit_device_modal').modal('hide');
      $('#Devices_view_table').DataTable().ajax.reload();
      },
      error: function(xhr, status, error, response) {
      console.error(xhr.responseText);
      Swal.fire("Incorrect... !!", "Sorry.. There Have been Some Error Occurred. Please Try Again!", "error")

      }
    });
    });
  });


  $(document).ready(function() {
    $('#form_device_create').submit(function(e) {
      e.preventDefault();
    var formData = $(this).serialize();
  $.ajax({
    url :"<?= base_url().'Branches/create_device' ?>",
    type: "post",
    data: formData,
    success: function(response) {
     console.log(response);
     var device_name = response.device_name;
      Swal.fire("Created !!", device_name + " Device Created Successfully!", "success");
      $('#form_device_create')[0].reset();
      $('#Device_add_modal').modal('hide');
      $('#Devices_view_table').DataTable().ajax.reload();
      },
    error: function(xhr, status, error) {
     console.error(xhr.responseText);
     Swal.fire("Incorrect... !!", "Sorry.. There Have been Some Error Occurred. Please Try Again!", "error")

     }
   });
  });
});

$(document).ready(function() {
      $('#form_schedule_edit').submit(function(e) {
        e.preventDefault();
      var formData = $(this).serialize();
    $.ajax({
      url :"<?= base_url().'Branches/update_schedule' ?>",
      type: "post",
      data: formData,
      success: function(response) {
      console.log(response);
      Swal.fire("Updated !!", "Schedule Updated Successfully!", "success");
      $('#time_edit_modal').modal('hide');
      $('#schedule_view_table').DataTable().ajax.reload();
      },
      error: function(xhr, status, error) {
      console.error(xhr.responseText);
      Swal.fire("Incorrect... !!", "Sorry.. There Have been Some Error Occurred. Please Try Again!", "error")

      }
    });
    });
  });

  $(document).ready(function() {
      $('#branch_delete').submit(function() {
        // e.preventDefault();
      var formData = $(this).serialize();
    $.ajax({
      url :"<?= base_url().'Branches/delete_branch' ?>",
      type: "post",
      data: formData,
      success: function(response) {
      console.log(response);
      Swal.fire("Deleted !!", "Branch Deleted Successfully!", "success");
      $('#branch_delete_modal').modal('hide');
      $('#offcanvasScrolling').offcanvas('hide');
      $('#Branch_view_table').DataTable().ajax.reload();
      },
      error: function(xhr, status, error) {
      console.error(xhr.responseText);
      Swal.fire("Incorrect... !!", "Sorry.. There Have been Some Error Occurred. Please Try Again!", "error")

      }
    });
    });
  });

  $(document).ready(function() {
      $('#device_delete').submit(function(e) {
        e.preventDefault();
      var formData = $(this).serialize();
    $.ajax({
      url :"<?= base_url().'Branches/delete_device' ?>",
      type: "post",
      data: formData,
      success: function(response) {
      console.log(response);
      Swal.fire("Deleted !!", "Device Deleted Successfully!", "success");
      $('#device_delete_modal').modal('hide');
      $('#Devices_view_table').DataTable().ajax.reload();
      },
      error: function(xhr, status, error) {
      console.error(xhr.responseText);
      Swal.fire("Incorrect... !!", "Sorry.. There Have been Some Error Occurred. Please Try Again!", "error")

      }
    });
    });
  });
  
  $(document).on('click','.delete_btn', function() {
        var id = $(this).attr('trashitem');
        console.log("device Id:", id);
        $('#trash_id').val(id);
    });

  $(document).on('click', '.edit_btn', function() {
  var id = $(this).attr('deviceid');
  var name = $(this).attr('device_name');
  var ip = $(this).attr('ip');
  var port = $(this).attr('device_port');
 
  console.log(id);
  console.log(name);
  console.log(ip);

  $('#device_id_edit').val(id);
  $('#device_name_edit').val(name);
  $('#device_ip').val(ip);
  $('#device_port').val(port);

  });           

</script>