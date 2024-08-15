<script type="text/javascript">
     
    function GetEmployeeName() {
        return $('#staffname').val();
    }
    function GetMonthName() {
        return $('#month').val();
    }
    function GetYear() {
        return $('#yearSelector').val();
    }
    function Gettemplate() {
        return $('#template').val();
    }
   

     

        // Function to get selected branch
        function getBranch() {
            return $('#table_filter_branch').val();
        }


        // Fetch staff data based on selected branch
        function fetchStaffData() {
            $.ajax({
                url: '<?= base_url() . 'Report/StaffDropdownData' ?>',
                type: 'POST',
                data: {
                    branch: getBranch(),
                },
                dataType: 'json',
                success: function(data) {
                    
                    var select = $('#staffname');
                    select.empty();
                    var staff_id = '<?php echo $_GET["userid"]??''; ?>';
                    for (var i = 0; i < data[0].length; i += 2) {
                        var id = data[0][i];
                        var name = data[0][i + 1];
                        let selected='';
                        if(staff_id==id){
                            selected = 'selected="selected"';
                        }

                        select.append('<option value="' + id + '" '+selected+'>' + name + '</option>');
                    }
                    select.trigger('change');
                    select.prop('disabled', false);
                },
                error: function(error) {
                    var select = $('#staffname');
                    select.empty(); // Clear existing options
                    select.append('<option value="null">Staff Not Available</option>');
                    select.prop('disabled', true); 
                    console.error('Error fetching staff data:', error);
                }
            });
        };
       
            // Fetch staff data when branch selection changes
            $('#table_filter_branch').on('change', fetchStaffData);
            $(document).ready(function() {
                fetchStaffData();
            });
           
         
        function loadData() {
            $('#cardContent').html('');
        // Getstaffs(function(employee) {
             var staffId = '';
             staffId = $('#staffname').val();
             if(staffId == null){
                staffId = '<?php echo $_GET['userid']??null; ?>';
             }
            console.log(staffId);

        if(staffId){
            var month = GetMonthName();
            var year = GetYear();
            var template = Gettemplate();

            $.ajax({
                url: 'Report/view', 
                type: 'POST',
                data: {
                    staff: staffId,
                    month: month,
                    year: year,
                    template: template,
                    branch: getBranch()
                },
                success: function(data) {
                    $('#cardContent').html(data); // Update content
                    // $('#example').DataTable({
                    //         scrollX:true,
                    //         dom: 'Bfrtip',
                    //     });
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            // });
        });
    }
    window.history.replaceState({}, document.title, window.location.pathname);
    }      
 
$(document).ready(function() { 
        loadData();
});
function generateReport(e) {
    e.preventDefault();
    loadData();
}

function GetMonthName() {
    return $('#month').val();
}

// function GetYear() {
//     return $('#yearSelector').val();
// }

// function Gettemplate() {
//     return $('#template').val();
// }
function getBranchofreport() {
    return $('#branch_report_branch').val();
}
function GetMonth() {
    return $('#month_branch_report').val();
}

function GetYearofreport() {
    return $('#yearSelector_branch_report').val();
}

// $(document).ready(function() {
function branch_report(){
    $('#cardContent2').html('');
    var month = GetMonth();
    var year = GetYearofreport();
    var branch = getBranchofreport();
    $.ajax({
url :"<?= base_url().'Report/Select_branch_report' ?>",
type: "post",
data:{
    month : month,
    year : year,
    branch : branch,    
  },
  success: function(data) {
    $('#cardContent2').html(data); 
                },
                error: function(error) {
                    console.error('Error:', error);
                }              
            });
        };
function branch_report_view(e) {
    e.preventDefault();
    branch_report();
}
</script>