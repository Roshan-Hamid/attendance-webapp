<script type="text/javascript">

function GetbranchName() {
        return $('#branch').val();
    }


  function GetLocation() { return $('#table_filter_locality').val();}

  var manager_view_table = $('#manager_view_table').DataTable({

   "ajax":{
    url :"<?= base_url().'Manager/select_manager' ?>",
    type: "post",
    data: function(){
      }
    },
  });


  $(document).ready(function() {
      $('#form_manager_create').submit(function(e) {
        e.preventDefault();
      var formData = $(this).serialize();
    $.ajax({
      url :"<?= base_url().'Manager/create' ?>",
      type: "post",
      data: formData,
      success: function(response) {
      console.log(response);
      var manager = response.manager;
        Swal.fire("Created !!", manager + " Created Successfully!", "success");
        $('#form_manager_create')[0].reset();
        // $('#branch')[0].reset();
        $('#manager_add_modal').modal('hide');
        $('#manager_view_table').DataTable().ajax.reload();
        },
      error: function(xhr, status, error) {
      console.error(xhr.responseText);
      Swal.fire("Incorrect... !!", "Sorry.. There Have been Some Error Occurred. Please Try Again!", "error")
      }
    });
    });
  });
  
  $(document).ready(function() {
        $('#form_manager_edit').submit(function(e) {
          e.preventDefault();
        var formData = $(this).serialize();
      $.ajax({
        url :"<?= base_url().'Manager/update' ?>",
        type: "post",
        data: formData,
        success: function(response) {
        console.log(response);
        var manager = response.manager;
        Swal.fire("Updated !!", manager + " Updated Successfully!", "success");
        $('#manager_edit_modal').modal('hide');
        $('#manager_view_table').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
        console.error(xhr.responseText);
        Swal.fire("Incorrect... !!", "Sorry.. There Have been Some Error Occurred. Please Try Again!", "error")
        }
      });
      });
    });

    $(document).ready(function() {
      $('#form_manager_delete').submit(function(e) {
        e.preventDefault();
      var formData = $(this).serialize();
    $.ajax({
      url :"<?= base_url().'Manager/delete' ?>",
      type: "post",
      data: formData,
      success: function(response) {
      console.log(response);
      Swal.fire("Deleted !!", "Staff Deleted Successfully!", "success");
      $('#manager_delete_modal').modal('hide');
      $('#manager_view_table').DataTable().ajax.reload();
      },
      error: function(xhr, status, error) {
      console.error(xhr.responseText);
      Swal.fire("Incorrect... !!", "Sorry.. There Have been Some Error Occurred. Please Try Again!", "error")
      }
    });
    });
  });

  $(document).ready(function() {
    $('#user_name').on('input', function() {
        var email = $(this).val();
        $(this).val(email.toLowerCase());
    });
    });
    $(document).ready(function() {
    $('#user_name_edit').on('input', function() {
        var email = $(this).val();
        $(this).val(email.toLowerCase());
    });
    });

  $(document).on('click', '.edit_btn', function() {
    var id = $(this).attr('id');
    var managername = $(this).attr('managername');
    var username = $(this).attr('username');
    var password = $(this).attr('password');
    var branch_name = $(this).attr('branch_name');
    console.log(branch_name);
    $('#user_id_edit').val(id);
    $('#name_edit').val(managername);
    $('#user_name_edit').val(username);
    $('#password_edit').val(password);
    $('#branch1').val(branch_name);
   
  });


  $(document).on('click','.delete_btn', function() {
       var id = $(this).attr('id');
       console.log("user_id_delete Id:", id);
       $('#user_id_delete').val(id);
   });

</script>