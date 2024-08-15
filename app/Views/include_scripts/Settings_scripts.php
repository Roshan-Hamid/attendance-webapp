<script type="text/javascript">


$(document).ready(function() {
        $('#form_change_password').submit(function(e) {
          e.preventDefault();
        var formData = $(this).serialize();
      $.ajax({
        url :"<?= base_url().'settings/change_password' ?>",
        type: "post",
        data: formData,
        success: function(response) {
        console.log(response);
        if (response.success) {
            Swal.fire("Updated !!", response.message, "success");
        } else {
            Swal.fire("Error !!", response.message, "error");
        }
        $('#form_change_password')[0].reset();

        },
        error: function(xhr, status, error) {
        console.error(xhr.responseText);
        Swal.fire("Incorrect... !!", "Sorry.. There Have been Some Error Occurred. Please Try Again!", "error")
        }
      });
      });
    });
    </script>
