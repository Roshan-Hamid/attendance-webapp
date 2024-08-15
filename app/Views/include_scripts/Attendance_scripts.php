<script type="text/javascript">

  function GetStartDate() {
    return $('#datepicker_start_date').val();
  }

  function GetEndDate() {
    return $('#datepicker_end_date').val();
  }
  function Getbranch() {
    return $('#table_filter_branch').val();
  }

  $.ajax({
    url: '<?= base_url() . 'Attendance/BranchDropdownData' ?>',
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
        console.error('Error fetching branch data:', error);
    }
});

  $.ajax({
    url: '<?= base_url() . 'Attendance/BranchDropdownData' ?>',
    type: 'POST',
    dataType: 'json',
    success: function(data) {
        var select = $('#add_branch');
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
    url: '<?= base_url() . 'Attendance/BranchDropdownData' ?>',
    type: 'POST',
    dataType: 'json',
    success: function(data) {
        var select = $('#edit_branch');
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

$(document).ready(function() {
        // Function to get selected branch
        function getBranch() {
          return $('#add_branch').val();
        }

            //check schedule2 exist in attendance add 
                function checkschedule() {
            $.ajax({
                url: '<?= base_url() . 'Attendance/checkschedule' ?>',
                type: 'POST',
                data: {
                    branch: getBranch(),
                },
                success: function(response) {
                    if (response.success) { // Check if data.data is not an empty string
                        console.log("Schedule2 Exist", response);
                        $('#schedule_b_fields').show(); // Show the schedule fields
                    } else{
                        console.log("Schedule2 is null");
                        $('#schedule_b_fields').hide(); // Hide the schedule fields if no data available
                    }
                },
                error: function(error) {
                    console.error('Error fetching schedule data:', error);
                }
            });
        };

        // Fetch staff data based on selected branch to modal
        function fetchStaffData() {
            $.ajax({
                url: '<?= base_url() . 'Attendance/StaffDropdownData' ?>',
                type: 'POST',
                data: {
                    branch: getBranch(),
                },
                dataType: 'json',
                success: function(data) {
                    
                    var select = $('#staffname');
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
                    var select = $('#staffname');
                    select.empty();
                    console.error('Error fetching staff data or staff data empty', error);
                }
            });
        };
        $('#add_branch').on('change',checkschedule);
            $(document).ready(function() {
                checkschedule();
            });
        $('#add_branch').on('change', fetchStaffData);
            $(document).ready(function() {
                fetchStaffData();
            });
});

$(document).ready(function() {
  var Attendance_view_table;
  setTimeout(function() {
  Attendance_view_table = $('#Attendance_view_table').DataTable({
    "ajax": {
      url: "<?= base_url() . 'Attendance/select_Attendance' ?>",
      type: "post",
      data: function(d) {
        d.branch = Getbranch();
        d.start_date = GetStartDate();
        d.end_date = GetEndDate();

      }
    },
    "pageLength": 50 ,
    "lengthMenu": [ [50, 100, 200, 300, 400, 500], [50, 100, 200, 300, 400, 500] ]
  });
}, 500);
  $(".table_filters").on("click", function() {
    Attendance_view_table.ajax.reload();
  });
  // $("#table_filter_branch").on("change", function() {
  //   Attendance_view_table.ajax.reload();
  // });
  $("#datepicker_start_date").on("click", function() {
    Attendance_view_table.ajax.reload();
  });
  // $("#datepicker_start_date, #datepicker_end_date").on("click", function() {
  //   Attendance_view_table.ajax.reload();
  //   });

});
   
    $(document).ready(function() {
      $('#form_attendance_create').submit(function(e) {
        e.preventDefault();
      var formData = $(this).serialize();
    $.ajax({
      url :"<?= base_url().'Attendance/create_Attendance' ?>",
      type: "post",
      data: formData,
      success: function(response) {
      console.log(response);
      var attendance = response.attendance;
        Swal.fire("success !!",attendance,"success");
        $('#form_attendance_create')[0].reset();
        $('#attendance_add_modal').modal('hide');
        $('#Attendance_view_table').DataTable().ajax.reload();
        },
      error: function(xhr, status, error) {
      console.error(xhr.responseText);
      var message = response.message;
      Swal.fire("Error !!", message, "error");
      }
    });
    });
  });
 
  $(document).ready(function() {
        $('#form_attendance_edit').submit(function(e) {
          e.preventDefault();
        var formData = $(this).serialize();
      $.ajax({
        url :"<?= base_url().'Attendance/update_attendance' ?>",
        type: "post",
        data: formData,
        success: function(response) {
        console.log(response);
        var attendance = response.attendance;
        Swal.fire("success !!",attendance,"success");
        $('#attendance_edit_modal').modal('hide');
        $('#Attendance_view_table').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
        console.error(xhr.responseText);
        var message = response.message;
        Swal.fire("Error !!", message, "error");
        }
      });
      });
    });
// });

  $(document).on('click', '.edit_btn', function() {
    var id = $(this).attr('attendanceid');
    // var userid = $(this).attr('userid');
    var name = $(this).attr('name');
    var date = $(this).attr('date');
    var check_in = $(this).attr('check_in');
    var check_out = $(this).attr('check_out');
    var schedule_2 = $(this).attr('schedule_2');

    if (schedule_2 && schedule_2.length > 0) { // Check if schedule_2 is not an empty array
      console.log("Schedule2 Exist in edit data");
      $('#schedule_b_fields_edit').show(); // Show the schedule fields
    } else {
        console.log("Schedule2 is null");
        $('#schedule_b_fields_edit').hide(); // Hide the schedule fields if no data available
    }
    console.log(id);
    console.log(schedule_2);
    console.log(name);
    console.log(check_in);
    console.log(check_out);

    $('#edit_id').val(id);
    $('#name_edit').val(name);
    $('#date_edit').val(date);
    $('#intime_edit').val(check_in);
    $('#outtime_edit').val(check_out);           
    });           


</script>