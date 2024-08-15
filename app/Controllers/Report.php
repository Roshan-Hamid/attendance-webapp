<?php

namespace App\Controllers;

use DateTime;
use DateInterval;

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Writer\Html;
use Mpdf\Mpdf;

use Dompdf\Dompdf;
use Dompdf\Options;

class Report extends BaseController
{

    public function __construct()
    {

        ini_set('max_execution_time', 5000);
        ini_set("memory_limit", "-1");
        date_default_timezone_set('Asia/Kolkata');
        $this->session = \Config\Services::session();
        $this->data['folder'] = 'Report';
        $this->Report = model('Report_model');
        $this->Attendance = model('Attendance_model');
        $this->Staffs = model('Staffs_model');
        $this->Devices = model('Devices_model');
        $this->Branch = model('Branch_model');
    }


    public function index()
    {

        if (isset($_GET['uid']) && isset($_GET['userid']) != '') {
            $json_data = array();
            $j = 0;
            $data = array();
            $userid = $_GET['userid'] ?? null;
            $data['s.userid ='] = $userid;
            $staffs = $this->Staffs->select_Staffs("*", $data);
            $staff = @$staffs->getResult()[0];
            $this->data['staff'] = $staff;

            $this->data['userid'] = $userid;
        }
        $json_data = array();
        $j = 0;
        $data = array();
        $userRole = $this->session->get('user_role');
        if ($userRole === 'admin') {
            // $json_data = array();
            // $j = 0;
            // $data = array();
            $branch = $this->Branch->select_Branches("*");
            $this->data['branches'] = $branch->getResult();
        } elseif ($userRole === 'manager') {
            $branch_id = $this->session->get('branch_id');
            if (isset($branch_id) && $branch_id != '') {
                $data['branch_id'] = json_decode($branch_id, true);
            }
            $branch = $this->Branch->select_branches_for_managers("*", $data);
            $this->data['branches'] = $branch->getResult();
        }

        $userRole = $this->session->get('user_role');
        if ($userRole === 'admin' || $userRole === 'manager') {
            $this->data['page'] = 'Report_list';
            return view('Index', $this->data);
        } else {
            return redirect()->to('/');
        }
    }


    // public function BranchDropdownData() {
    //     $json_data = array();
    //     $j = 0;
    //     $data = array();
    //     $userRole = $this->session->get('user_role');
    //     if ($userRole === 'manager') {
    //         $branch_id = $this->session->get('branch_id');
    //         if (isset($branch_id) && $branch_id != '')  {
    //             $branch_ids = json_decode($branch_id, true); 
    //         }
    //     }
    //     if (isset($_POST['branch_id']) && $_POST['branch_id'] !== '') {
    //         $data['b.branch_id ='] = $_POST['branch_id'];
    //     }
    //     $result = $this->Branch->select_Branches("*", $data);
    //     $result_array = $result->getResult();
    //     foreach ($result_array as $row) :
    //         if (in_array($row->branch_id, $branch_ids)) {
    //             $array[$j][] = $row->branch_id;
    //             $array[$j][] = $row->branch_name;
    //         }else{
    //             $array[$j][] = $row->branch_id;
    //             $array[$j][] = $row->branch_name;
    //         }
    //     endforeach;
    //     $json_data['data'] = $array;
    //     echo json_encode($array);

    // }
    public function StaffDropdownData()
    {
        $json_data = array();
        $j = 0;
        $data = array();

        if (isset($_POST['branch']) && $_POST['branch'] != '') {
            $data['s.branch_id ='] = $_POST['branch'];
        }

        if (isset($_POST['userid']) && $_POST['userid'] !== '') {
            $data['s.userid ='] = $_POST['userid'];
        }


        $staffs = $this->Staffs->select_Staffs("*", $data);
        $staffs_array = $staffs->getResult();
        if (!$staffs_array) {
            // Display an alert and then redirect
            echo '<script>alert("Error: Selected Branch staff data is Not Provided.");</script>';
            // echo '<script>window.location.replace("/Report");</script>';
            exit;
        }
        foreach ($staffs_array as $row) :
            $array[$j][] = $row->userid;
            $array[$j][] = $row->name;
        endforeach;
        $json_data['data'] = $array;
        echo json_encode($array);
    }


    public function view()
    {
        $json_data = array();
        $j = 0;

        $data = array();

        if (isset($_POST['staff']) && $_POST['staff'] !== '') {
            // If $_POST['staff'] is set and not empty
            $data['a.userid ='] = $_POST['staff'];
        }

        $year = isset($_POST['year']) ? $_POST['year'] : null;
        $month = isset($_POST['month']) ? $_POST['month'] : null;
        if ($month !== null) {
            $dateTime = new DateTime("$year-$month-01 00:00:00");
            $formattedMonth = $dateTime->format("Y-m-d H:i:s");
            $data['MONTH(a.check_in) ='] = date('n', strtotime($formattedMonth));
        }else {
            echo '<script>';
            echo 'Swal.fire({';
            echo '    icon: "error",';
            echo '    title: "Error",';
            echo '    text: "Month Not Provided."';
            echo '});';
            echo '</script>';
            exit;
        }
        if ($year !== null) {
            $dateTime = new DateTime("$year-$month-01 00:00:00");
            $formattedYear = $dateTime->format("Y-m-d H:i:s");
            $data['YEAR(a.check_in) ='] = date('Y', strtotime($formattedYear));
        }



        if (isset($_POST['template'])) {
            $templateValue = intval($_POST['template']); // Convert to integer for safety

            if ($templateValue === 1) {
            } elseif ($templateValue === 2) {
                $this->Report_arabic();
                exit;
            } elseif ($templateValue === 3) {
                $this->Report_Combined();
                exit;
            } else {
                echo "Invalid template value";
            }
        }


        $attendance = $this->Report->select_Attendance("a.* ,device.name as device_name,s.name as name ", $data);
        $attendance_array = $attendance->getResult();
        if (!$attendance_array) {

            echo '<script>';
            echo 'Swal.fire({';
            echo '    icon: "error",';
            echo '    title: "Error",';
            echo '    text: "Selected Month Data Or Branch Data is Not Provided."';
            echo '});';
            echo '</script>';
            exit;
        }

        // $currentYear = date("Y");
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month,  $year);

        $array = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = date("d-m-Y", strtotime(" $year-$month-$day"));
            $dayOfWeek = date("l", strtotime($date));

            $dayArray = [
                'date' => $date,
                'day' => $dayOfWeek,
            ];

            $array[] = $dayArray;
        }

        $j = 0;

        $data = array();
        if (isset($_POST['branch']) && $_POST['branch'] != '') {
            $data['b.branch_id ='] = $_POST['branch'];
        }

        $branch = $this->Branch->select_Branches("*", $data);
        $branch_array = $branch->getResult();
        foreach ($branch_array as $row) {
            $schedule_1 = $obj = json_decode($row->schedule_1);
            $schedule_2 = $obj = json_decode($row->schedule_2);
        }

        $totalHours_worked = 0;
        $totalMinutes_worked = 0;
        $totalDurationInSeconds = 0;
        foreach ($attendance_array as $row) {
            $totalDurationInSeconds = 0;
            $schedule_1checkin = $schedule_1->checkin;
            $schedule_1break = $schedule_1->break;
            $schedule_1checkout = $schedule_1->checkout;
            if ($schedule_2 != null) {
                $schedule_2checkin = $schedule_2->checkin;
                $schedule_2break = $schedule_2->break;
                $schedule_2checkout = $schedule_2->checkout;
            }
            $timestamp1 = strtotime($row->check_in);
            $time1 = date("h:i A", $timestamp1);
            $timestamp2 = strtotime($row->check_out);
            $time2 = $timestamp2 ? date("h:i A", $timestamp2) : date("h:i A", strtotime($schedule_1->checkout));

            // Calculate duration for schedule 1
            $diff = (new DateTime($time1))->diff(new DateTime($time2));
            $breakInSeconds = strtotime($schedule_1->break) - strtotime('TODAY');
            $durationInSeconds = max(0, $diff->h * 3600 + $diff->i * 60 - $breakInSeconds);
            $totalDurationInSeconds += $durationInSeconds;

            // If schedule 2 is present, calculate its duration and add to the total
            if ($schedule_2 != null) {
                $timestamp1_schedule2 = strtotime($row->check_in2);

                if ($timestamp1_schedule2) {
                    $time1_schedule2 = date("h:i A", $timestamp1_schedule2);
                    $timestamp2_schedule2 = strtotime($row->check_out2);
                    $time2_schedule2 = $timestamp2_schedule2 ? date("h:i A", $timestamp2_schedule2) : date("h:i A", strtotime($schedule_2->checkout));
                    $diff_schedule2 = (new DateTime($time1_schedule2))->diff(new DateTime($time2_schedule2));
                    $breakInSeconds_schedule2 = strtotime($schedule_2->break) - strtotime('TODAY');
                    $durationInSeconds_schedule2 = max(0, $diff_schedule2->h * 3600 + $diff_schedule2->i * 60 - $breakInSeconds_schedule2);
                    $totalDurationInSeconds += $durationInSeconds_schedule2;
                } else {
                    $time1_schedule2 = '';
                    $time2_schedule2 = '';
                }
            }

            // Format total duration a day
            $totalHoursWorked = floor($totalDurationInSeconds / 3600);
            $totalMinutesWorked = floor(($totalDurationInSeconds % 3600) / 60);
            $totalDurationFormatted = sprintf('%02d:%02d', $totalHoursWorked, $totalMinutesWorked);

            // Update total hours and minutes for the current row
            list($hours, $minutes) = explode(':', $totalDurationFormatted);
            $totalHours_worked += (int)$hours;
            $totalMinutes_worked += (int)$minutes;

            // Handle carryover if minutes exceed 60
            if ($totalMinutes_worked >= 60) {
                $totalHours_worked += floor($totalMinutes_worked / 60);
                $totalMinutes_worked %= 60;
            }

            $name = $row->name;

            $key = array_search(date("d-m-Y", $timestamp1), array_column($array, 'date'));

            if ($key !== false) {

                if ($schedule_2 == null) {
                    $array[$key]['time'] = $time1;
                    $array[$key]['time2'] = $time2;
                    $array[$key]['duration'] = $totalDurationFormatted;
                } else {
                    $array[$key]['time'] = $time1;
                    $array[$key]['time2'] = $time2;
                    $array[$key]['schedule_2_time1'] = $time1_schedule2;
                    $array[$key]['schedule_2_time2'] = $time2_schedule2;
                    // $array[$key]['duration'] = $diff2->format("%h : %i ");
                    $array[$key]['duration'] = $totalDurationFormatted;
                }
            }
            $j++;
        }




        // total required hours and present days
        if ($schedule_2 == null) {

            $schedule_1checkin_Obj = DateTime::createFromFormat('H:i', $schedule_1checkin);
            $schedule_1checkout_Obj = DateTime::createFromFormat('H:i', $schedule_1checkout);

            // Convert break duration to seconds
            $schedule_1break_numeric = floatval($schedule_1break);
            $break_seconds = $schedule_1break_numeric * 3600;

            // Create a DateInterval object for the break duration
            $schedule_1break_Obj = new DateInterval("PT{$break_seconds}S");

            // Initialize variables
            $workingHoursPerDay = '';

            if ($schedule_1checkin_Obj && $schedule_1checkout_Obj) {
                $difference = $schedule_1checkin_Obj->diff($schedule_1checkout_Obj);

                $diff_seconds = ($difference->h * 3600) + ($difference->i * 60) - $break_seconds;

                $result_hours = floor($diff_seconds / 3600);
                $result_minutes = floor(($diff_seconds % 3600) / 60);

                // echo "Result: $result_hours hours and $result_minutes minutes";
            }
        } else {
            $schedule_2checkin_Obj = DateTime::createFromFormat('H:i', $schedule_2checkin);
            $schedule_2checkout_Obj = DateTime::createFromFormat('H:i', $schedule_2checkout);

            // Convert break duration to seconds
            $schedule_1break_numeric = floatval($schedule_2break);
            $break_seconds = $schedule_1break_numeric * 3600;

            // Create a DateInterval object for the break duration
            $schedule_1break_Obj = new DateInterval("PT{$break_seconds}S");

            // Initialize variables
            $workingHoursPerDay = '';

            if ($schedule_2checkin_Obj && $schedule_2checkout_Obj) {
                $difference = $schedule_2checkin_Obj->diff($schedule_2checkout_Obj);

                $diff_seconds = ($difference->h * 3600) + ($difference->i * 60) - $break_seconds;

                $result_hours = floor($diff_seconds / 3600);
                $result_minutes = floor(($diff_seconds % 3600) / 60);

                // echo "Result: $result_hours hours and $result_minutes minutes";
            }
        }
        $totalMinutes = ($result_hours * 60) + $result_minutes;
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $totalRequireddays = $daysInMonth - 2;
        $totalRequiredMinutes = $totalMinutes * $totalRequireddays;
        $totalRequiredHours = $totalRequiredMinutes / 60;
        $workingHoursPerDay = $totalRequiredHours / $totalRequireddays;


        // totalPresentDays
        $totalPresentDays = 0;

        if ($schedule_2 == null) {
            foreach ($attendance_array as $row) {
                // Get timestamps
                $timestamp = strtotime($row->check_in);
                $timestamp2 = strtotime($row->check_out);

                // Check if both check-in and check-out entries exist for the same day
                // if (date('Y-m-d', $timestamp) == date('Y-m-d', $timestamp2)) {
                if (date('Y-m-d', $timestamp)) {
                    $totalPresentDays++;
                }
            }
        } else {
            foreach ($attendance_array as $row) {
                // Get timestamps
                $timestamp = strtotime($row->check_in);
                $timestamp2 = strtotime($row->check_out);

                $schedule2_timestamp = strtotime($row->check_in2);
                $schedule2_timestamp2 = strtotime($row->check_out2);
                // Check if both check-in and check-out entries exist for the same day for schedule 1
                // if (date('Y-m-d', $timestamp) == date('Y-m-d', $timestamp2)) {
                if (date('Y-m-d', $timestamp)) {
                    $totalPresentDays++;
                }

                // Check if both check_in2 and check_out2 entries exist for the same day for schedule 2
                if (date('Y-m-d', $schedule2_timestamp)) {
                    $totalPresentDays++;
                }
            }
        }





        // Total absent days
        $totalAbsentDays = 0;

        for ($day = 1; $day <= $totalRequireddays; $day++) {
            // Format the date
            $date = date("Y-m-d", strtotime("$year-$month-$day"));
            // Check if there is no entry for the current day
            $entriesExist = false;
            // Loop through each row to check for entries
            foreach ($attendance_array as $row) {
                // Check for entry based on schedule
                if ($schedule_2 == null) {
                    $timestamp = strtotime($row->check_in);
                } else {
                    $timestamp1 = strtotime($row->check_in);
                    $timestamp2 = strtotime($row->check_in2);
                    // Check if either entry matches the current date
                    if (date("Y-m-d", $timestamp1) == $date || date("Y-m-d", $timestamp2) == $date) {
                        $entriesExist = true;
                        break; // Exit the loop if an entry is found for the current day
                    }
                }

                // Check if the entry matches the current date
                if (date("Y-m-d", $timestamp) == $date) {
                    $entriesExist = true;
                    break; // Exit the loop if an entry is found for the current day
                }
            }

            // If no entries found for the current day, consider it an absent day
            if (!$entriesExist) {
                $totalAbsentDays++;
            }
        }


        // Total Absent Hours
        $totalMinutes_workedmonth = $totalHours_worked * 60 + $totalMinutes_worked;
        $totalRequiredMinutes = $totalRequiredHours * 60;

        // Calculate total absent minutes
        $totalAbsentMinutes = $totalRequiredMinutes - $totalMinutes_workedmonth;

        // Calculate total absent hours and remaining minutes
        $totalAbsentHours = floor($totalAbsentMinutes / 60);
        $totalAbsentMinutes %= 60;

        // If totalAbsentMinutes is negative, adjust totalAbsentHours accordingly
        if ($totalAbsentMinutes < 0) {
            $totalAbsentHours--; // Decrement totalAbsentHours by 1
            $totalAbsentMinutes += 60; // Add 60 minutes to compensate for the negative value
        }

        // echo 'Total Absent Hours: ' . $totalAbsentHours . ' Hr ' . $totalAbsentMinutes . ' Min';



        $data = array();
        if (isset($_POST['branch']) && $_POST['branch'] != '') {
            $data['b.branch_id ='] = $_POST['branch'];
        }

        $branch = $this->Branch->select_Branches("*", $data);
        $branch_array = $branch->getResult();
        // $schedule_2 = NULL;
        foreach ($branch_array as $row) {
            $schedule_2 = $row->schedule_2;
        }

        if ($schedule_2 == 'null') {
            $heads = array('Date', 'DAY', 'In-Time', 'Out-Time', 'TotalHours');
        } else {
            $heads = array('Date', 'DAY', 'In-Time', 'Out-Time', 'In-Time2', 'Out-Time2', 'TotalHours');
        }

        $i = 'A';

        $rowIndex = 4;


        $json_data['data'] =  $array;
        $dataTableRows = $json_data['data'];

        $timestamp = strtotime("2023-$month-01");
        $monthName = date("F", $timestamp);

        $htmlHeader = '<div style="text-align: center; font-size:10px; font-family: Verdana; margin-bottom: 10px;"><b>' . strtoupper('ADVANCE COOL GENERAL TRADING/LLC') . '</b></div>' . '<div style="text-align: center; font-size: 12px; font-family: Arial; margin-bottom: 10px;"><b>' . strtoupper(htmlspecialchars($name) . ' ATTENDANCE FOR THE MONTH OF ' . htmlspecialchars($monthName)) . '</b></div>';


        $htmlTable = '<table border="2" style="width:100%; border-collapse:collapse; text-align: center; margin-bottom:5px;border: 1px solid black;">';
        $htmlTable .= '<thead style="background-color: #fffff; border: 1px solid black;"><tr>';
        foreach ($heads as $header) {

            $htmlTable .= '<th style="padding: 5px; border-collapse: collapse;border: 1px solid black;">' . strtoupper(htmlspecialchars($header)) . '</th>';
        }
        $maxCells = max(array_map('count', $dataTableRows));

        $htmlTable .= '</tr></thead><tbody>';
        foreach ($dataTableRows as $row) {
            $htmlTable .= '<tr style="font-size: 12px; border-collapse: collapse;border: 1px solid black;"';
            if (isset($row['day']) && $row['day'] === 'Sunday') {
                $htmlTable .= ' style="background-color: #c0c0c0; font-size: 12px;border-collapse: collapse;border: 1px solid black;"';
            }
            $htmlTable .= '>';

            // Iterate over the existing values in $row
            foreach ($row as $value) {
                $htmlTable .= '<td style="padding:2px;border-collapse: collapse;border: 1px solid black;">' . htmlspecialchars($value) . '</td>';
            }

            // Add empty cells to match $maxCells
            for ($i = count($row); $i < $maxCells; $i++) {
                $htmlTable .= '<td style="padding: 3px;border: 1px solid black;">&nbsp;</td>'; // Use &nbsp; for an empty cell
            }

            $htmlTable .= '</tr>';
        }
        $htmlTable .= '</tbody>';

        $htmlTable .= '</table>';
        $htmlTable1 = '<table border="2" style="width: 100%; border-collapse: collapse;border: 1px solid black; text-align: center;">';

        $htmlTable1 .= ' <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;">Total Required Hours (month)</td>
                    <td style="border: 1px solid black;">' . $totalRequiredHours . ' hours</td>
                  </tr>
                  <tr style="border: 1px solid black;">
                  <td style="border: 1px solid black;">Total Hours Worked</td>
                    <td style="border: 1px solid black;"> '  . $totalHours_worked . ' : ' . $totalMinutes_worked . '</td>
                  </tr>
                  <tr style="border: 1px solid black;">
                   <td style="border: 1px solid black;">Total Required Present days</td>
                    <td style="border: 1px solid black;">' . $totalRequireddays . '</td>
                  </tr>
                   <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;">Total Actual Present days</td>
                    <td style="border: 1px solid black;">' . $totalPresentDays . '</td>
                  </tr>
                   <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;">Total Absent days</td>
                    <td style="border: 1px solid black;">' . $totalAbsentDays . '</td>
                  </tr>
                   <tr style="border: 1px solid black;">
                   <td style="border: 1px solid black;">Total Absent Hours</td>
                    <td style="border: 1px solid black;"> -' . $totalAbsentHours . ': ' . $totalAbsentMinutes . '</td>
                  </tr>';


        $htmlTable1 .= '</table>';

        $htmlfooter = ' <p>I, the undersigned hereby acknowledge to have read this report and the details mentioned are true and correct.</p>
            <p><b>Staff Signature:</b></p>
            <p><b>Thumb Impression:</b></p>
            <p><b>Date:</b></p>
            <p><b>Branch Incharge Signature:</b></p>
        ';


        $htmlContent = $htmlHeader . $htmlTable . $htmlTable1 . $htmlfooter;


        $mpdf = new \Mpdf\Mpdf();
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'Arial'
        ]);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->WriteHTML($htmlContent);
        $filename = strtoupper(htmlspecialchars($name)) . '_ATTENDANCE_' . strtoupper(htmlspecialchars($monthName))  . date('dmYhis') . '.pdf';
        // $mpdf->Output($filename.'.pdf', 'I');

        $pdfData = $mpdf->Output('', 'S'); // Capture the PDF content as a string

        // Encode the PDF data as base64
        $pdfBase64 = base64_encode($pdfData);

        // Output the PDF data as an object within a card
        // echo '<object data="data:application/pdf;base64,' . $pdfBase64 . '" type="application/pdf" style="width:100%;height:1200px;"></object>';
        echo '<object data="data:application/pdf;base64,' . $pdfBase64 . '" type="application/pdf" style="width:100%;height:1200px;" download="' . $filename . '"></object>';
        exit;
    }



    //Arabic Language pdf
    public function Report_arabic()
    {

        $json_data = array();
        $j = 0;

        $data = array();


        if (isset($_POST['staff']) && $_POST['staff'] != '') {
            $data['a.userid ='] = ($_POST['staff']);
        }
        $year = isset($_POST['year']) ? $_POST['year'] : null;
        $month = isset($_POST['month']) ? $_POST['month'] : null;
        if ($month !== null) {
            $dateTime = new DateTime("$year-$month-01 00:00:00");
            $formattedMonth = $dateTime->format("Y-m-d H:i:s");
            $data['MONTH(a.check_in) ='] = date('n', strtotime($formattedMonth));
        } else {
            echo "Month not provided";
            exit;
        }
        if ($year !== null) {
            $dateTime = new DateTime("$year-$month-01 00:00:00");
            $formattedYear = $dateTime->format("Y-m-d H:i:s");
            $data['YEAR(a.check_in) ='] = date('Y', strtotime($formattedYear));
        }

        $attendance = $this->Attendance->select_Attendance("*", $data);
        $attendance_array = $attendance->getResult();

        if (!$attendance_array) {
            // Display an alert and then redirect
            echo '<script>alert("Error: Selected Month Data is Not Provided.");</script>';
            echo '<script>window.location.replace("/Report");</script>';
            exit;
        }


        //   $currentYear = date("Y");
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $array = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = date("d-m-Y", strtotime("$year-$month-$day"));
            $dayNumber = date('N', strtotime($date));

            $arabicDays = [
                1 => 'نينثألا',
                2 => 'ءاثالثلا',
                3 => 'ءاعبرألا',
                4 => 'سيمخلا',
                5 => 'هعمجلا ',
                6 => 'تبسلا',
                7 => 'دحألا',
            ];

            $dayArray = [
                'date' => $date,
                'day' => $arabicDays[$dayNumber],
            ];

            $array[] = $dayArray;
        }

        $j = 0;
        $data = array();
        if (isset($_POST['branch']) && $_POST['branch'] != '') {
            $data['b.branch_id ='] = $_POST['branch'];
        }

        $branch = $this->Branch->select_Branches("*", $data);
        $branch_array = $branch->getResult();
        foreach ($branch_array as $row) {
            $schedule_1 = $obj = json_decode($row->schedule_1);
            $schedule_2 = $obj = json_decode($row->schedule_2);
        }

        $totalHours_worked = 0;
        $totalMinutes_worked = 0;
        $totalDurationInSeconds = 0;
        foreach ($attendance_array as $row) {
            $totalDurationInSeconds = 0;

            $schedule_1checkin = $schedule_1->checkin;
            $schedule_1break = $schedule_1->break;
            $schedule_1checkout = $schedule_1->checkout;
            if ($schedule_2 != null) {
                $schedule_2checkin = $schedule_2->checkin;
                $schedule_2break = $schedule_2->break;
                $schedule_2checkout = $schedule_2->checkout;
            }
            $timestamp1 = strtotime($row->check_in);
            $time1 = date("h:i A", $timestamp1);
            $timestamp2 = strtotime($row->check_out);
            $time2 = $timestamp2 ? date("h:i A", $timestamp2) : date("h:i A", strtotime($schedule_1->checkout));

            // Calculate duration for schedule 1
            $diff = (new DateTime($time1))->diff(new DateTime($time2));
            $breakInSeconds = strtotime($schedule_1->break) - strtotime('TODAY');
            $durationInSeconds = max(0, $diff->h * 3600 + $diff->i * 60 - $breakInSeconds);
            $totalDurationInSeconds += $durationInSeconds;

            // If schedule 2 is present, calculate its duration and add to the total
            if ($schedule_2 != null) {
                $timestamp1_schedule2 = strtotime($row->check_in2);

                if ($timestamp1_schedule2) {
                    $time1_schedule2 = date("h:i A", $timestamp1_schedule2);
                    $timestamp2_schedule2 = strtotime($row->check_out2);
                    $time2_schedule2 = $timestamp2_schedule2 ? date("h:i A", $timestamp2_schedule2) : date("h:i A", strtotime($schedule_2->checkout));
                    $diff_schedule2 = (new DateTime($time1_schedule2))->diff(new DateTime($time2_schedule2));
                    $breakInSeconds_schedule2 = strtotime($schedule_2->break) - strtotime('TODAY');
                    $durationInSeconds_schedule2 = max(0, $diff_schedule2->h * 3600 + $diff_schedule2->i * 60 - $breakInSeconds_schedule2);
                    $totalDurationInSeconds += $durationInSeconds_schedule2;
                } else {
                    $time1_schedule2 = '';
                    $time2_schedule2 = '';
                }
            }

            // Format total duration a day
            $totalHoursWorked = floor($totalDurationInSeconds / 3600);
            $totalMinutesWorked = floor(($totalDurationInSeconds % 3600) / 60);
            $totalDurationFormatted = sprintf('%02d:%02d', $totalHoursWorked, $totalMinutesWorked);

            // Update total hours and minutes for the current row
            list($hours, $minutes) = explode(':', $totalDurationFormatted);
            $totalHours_worked += (int)$hours;
            $totalMinutes_worked += (int)$minutes;

            // Handle carryover if minutes exceed 60
            if ($totalMinutes_worked >= 60) {
                $totalHours_worked += floor($totalMinutes_worked / 60);
                $totalMinutes_worked %= 60;
            }



            $name = $row->name;
            $key = array_search(date("d-m-Y", $timestamp1), array_column($array, 'date'));

            if ($key !== false) {

                if ($schedule_2 == null) {
                    $array[$key]['time'] = $time1;
                    $array[$key]['time2'] = $time2;
                    $array[$key]['duration'] = $totalDurationFormatted;
                } else {
                    $array[$key]['time'] = $time1;
                    $array[$key]['time2'] = $time2;
                    $array[$key]['schedule_2_time1'] = $time1_schedule2;
                    $array[$key]['schedule_2_time2'] = $time2_schedule2;
                    // $array[$key]['duration'] = $diff2->format("%h : %i ");
                    $array[$key]['duration'] = $totalDurationFormatted;
                }
            }
            $j++;
        }
        // Total Hours Worked
        // $totalHours_worked = floor($totalDurationInSeconds / 3600);  
        // $totalMinutes_worked =  floor(($totalDurationInSeconds % 3600) / 60);  


        // total required hours and present days
        if ($schedule_2 == null) {

            $schedule_1checkin_Obj = DateTime::createFromFormat('H:i', $schedule_1checkin);
            $schedule_1checkout_Obj = DateTime::createFromFormat('H:i', $schedule_1checkout);

            // Convert break duration to seconds
            $schedule_1break_numeric = floatval($schedule_1break);
            $break_seconds = $schedule_1break_numeric * 3600;

            // Create a DateInterval object for the break duration
            $schedule_1break_Obj = new DateInterval("PT{$break_seconds}S");

            // Initialize variables
            $workingHoursPerDay = '';

            if ($schedule_1checkin_Obj && $schedule_1checkout_Obj) {
                $difference = $schedule_1checkin_Obj->diff($schedule_1checkout_Obj);

                $diff_seconds = ($difference->h * 3600) + ($difference->i * 60) - $break_seconds;

                $result_hours = floor($diff_seconds / 3600);
                $result_minutes = floor(($diff_seconds % 3600) / 60);

                // echo "Result: $result_hours hours and $result_minutes minutes";
            }
        } else {
            $schedule_2checkin_Obj = DateTime::createFromFormat('H:i', $schedule_2checkin);
            $schedule_2checkout_Obj = DateTime::createFromFormat('H:i', $schedule_2checkout);

            // Convert break duration to seconds
            $schedule_1break_numeric = floatval($schedule_2break);
            $break_seconds = $schedule_1break_numeric * 3600;

            // Create a DateInterval object for the break duration
            $schedule_1break_Obj = new DateInterval("PT{$break_seconds}S");

            // Initialize variables
            $workingHoursPerDay = '';

            if ($schedule_2checkin_Obj && $schedule_2checkout_Obj) {
                $difference = $schedule_2checkin_Obj->diff($schedule_2checkout_Obj);

                $diff_seconds = ($difference->h * 3600) + ($difference->i * 60) - $break_seconds;

                $result_hours = floor($diff_seconds / 3600);
                $result_minutes = floor(($diff_seconds % 3600) / 60);

                // echo "Result: $result_hours hours and $result_minutes minutes";
            }
        }
        $totalMinutes = ($result_hours * 60) + $result_minutes;
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $totalRequireddays = $daysInMonth - 2;
        $totalRequiredMinutes = $totalMinutes * $totalRequireddays;
        $totalRequiredHours = $totalRequiredMinutes / 60;
        $workingHoursPerDay = $totalRequiredHours / $totalRequireddays;


        // totalPresentDays
        $totalPresentDays = 0;

        if ($schedule_2 == null) {
            foreach ($attendance_array as $row) {
                // Get timestamps
                $timestamp = strtotime($row->check_in);
                $timestamp2 = strtotime($row->check_out);

                // Check if both check-in and check-out entries exist for the same day
                if (date('Y-m-d', $timestamp)) {
                    $totalPresentDays++;
                }
            }
        } else {
            foreach ($attendance_array as $row) {
                // Get timestamps
                $timestamp = strtotime($row->check_in);
                $timestamp2 = strtotime($row->check_out);

                $schedule2_timestamp = strtotime($row->check_in2);
                $schedule2_timestamp2 = strtotime($row->check_out2);
                // Check if both check-in and check-out entries exist for the same day for schedule 1
                if (date('Y-m-d', $timestamp)) {
                    $totalPresentDays++;
                }

                // Check if both check_in2 and check_out2 entries exist for the same day for schedule 2
                if (date('Y-m-d', $schedule2_timestamp)) {
                    $totalPresentDays++;
                }
            }
        }





        // Total absent days
        $totalAbsentDays = 0;

        for ($day = 1; $day <= $totalRequireddays; $day++) {
            // Format the date
            $date = date("Y-m-d", strtotime("$year-$month-$day"));
            // Check if there is no entry for the current day
            $entriesExist = false;
            // Loop through each row to check for entries
            foreach ($attendance_array as $row) {
                // Check for entry based on schedule
                if ($schedule_2 == null) {
                    $timestamp = strtotime($row->check_in);
                } else {
                    $timestamp1 = strtotime($row->check_in);
                    $timestamp2 = strtotime($row->check_in2);
                    // Check if either entry matches the current date
                    if (date("Y-m-d", $timestamp1) == $date || date("Y-m-d", $timestamp2) == $date) {
                        $entriesExist = true;
                        break; // Exit the loop if an entry is found for the current day
                    }
                }

                // Check if the entry matches the current date
                if (date("Y-m-d", $timestamp) == $date) {
                    $entriesExist = true;
                    break; // Exit the loop if an entry is found for the current day
                }
            }

            // If no entries found for the current day, consider it an absent day
            if (!$entriesExist) {
                $totalAbsentDays++;
            }
        }


        // Total Absent Hours
        $totalMinutes_workedmonth = $totalHours_worked * 60 + $totalMinutes_worked;
        $totalRequiredMinutes = $totalRequiredHours * 60;

        // Calculate total absent minutes
        $totalAbsentMinutes = $totalRequiredMinutes - $totalMinutes_worked;

        // Calculate total absent hours and remaining minutes
        $totalAbsentHours = floor($totalAbsentMinutes / 60);
        $totalAbsentMinutes %= 60;

        // If totalAbsentMinutes is negative, adjust totalAbsentHours accordingly
        if ($totalAbsentMinutes < 0) {
            $totalAbsentHours--; // Decrement totalAbsentHours by 1
            $totalAbsentMinutes += 60; // Add 60 minutes to compensate for the negative value
        }

        // echo 'Total Absent Hours: ' . $totalAbsentHours . ' Hr ' . $totalAbsentMinutes . ' Min';



        $data = array();
        if (isset($_POST['branch']) && $_POST['branch'] != '') {
            $data['b.branch_id ='] = $_POST['branch'];
        }

        $branch = $this->Branch->select_Branches("*", $data);
        $branch_array = $branch->getResult();
        // $schedule_2 = NULL;
        foreach ($branch_array as $row) {
            $schedule_2 = $row->schedule_2;
        }

        if ($schedule_2 == 'null') {
            $heads = array(' التاريخ', ' اليوم', 'وقت الدخول', 'وقت الخروج', ' مجموع الساعات');
        } else {
            $heads = array(' التاريخ', ' اليوم', 'وقت الدخول', 'وقت الخروج', '٢ وقت الدخول', '٢ وقت الخروج', 'مجموع الساعات');
            // $heads = array('Date', 'DAY', 'In-Time', 'Out-Time', 'In-Time2', 'Out-Time2', 'TotalHours');
        }

        foreach ($heads as $key => $value) {
            // Check if the string is not already in UTF-8
            if (!mb_detect_encoding($value, 'UTF-8', true)) {
                $heads[$key] = utf8_encode($value);
            }
        }
        $i = 'A';


        $rowIndex = 2;


        $json_data['data'] =  $array;
        $dataTableRows = $json_data['data'];

        $timestamp = strtotime("2024-$month-01");
        $monthName = date("F", $timestamp);
        $htmlHeader = '<div style="text-align: center; font-size:9px;  margin-bottom: 10px;"><b>' . strtoupper('ADVANCE COOL GENERAL TRADING/LLC') . '</b></div>' . '<div style="text-align: center; font-size: 12px; font-family: Arial; margin-bottom: 10px;"><b>' . strtoupper(htmlspecialchars($name) . ' ATTENDANCE FOR THE MONTH OF ' . htmlspecialchars($monthName)) . '</b></div>';

        // $htmlTable = ' <table border="1" style="width: 100%; border-collapse: collapse; text-align: center; margin-bottom:5px;">';
        // $htmlTable .= '<thead style="background-color: #fffff; "><tr>';
        //     foreach ($heads as $header) {

        //             $htmlTable .= '<th style="padding: 10px; border-collapse: collapse;">' . strtoupper( htmlspecialchars($header)) . '</th>';
        //         }
        //         $maxCells = max(array_map('count', $dataTableRows));

        //         $htmlTable .= '</tr></thead><tbody>';
        //         foreach ($dataTableRows as $row) {
        //             $htmlTable .= '<tr  style="font-size: 12px;"';
        //             if (isset($row['day']) && $row['day'] === 'دحألا') {
        //                 $htmlTable .= ' style="background-color: #c0c0c0; font-size: 12px;"';
        //             }
        //             $htmlTable .= '>';

        //             // Iterate over the existing values in $row
        //             foreach ($row as $value) {
        //                 $htmlTable .= '<td style="padding: 2px;">' . htmlspecialchars($value) . '</td>';
        //             }

        //             // Add empty cells to match $maxCells
        //             for ($i = count($row); $i < $maxCells; $i++) {
        //                 $htmlTable .= '<td style="padding: 2px;">&nbsp;</td>'; // Use &nbsp; for an empty cell
        //             }

        //             $htmlTable .= '</tr>';
        //         }
        //         $htmlTable .= '</tbody>';

        // $htmlTable .= '</table>';
        $htmlTable = '<table border="2" style="width:100%; border-collapse:collapse; text-align: center; margin-bottom:5px;border: 1px solid black;">';
        $htmlTable .= '<thead style="background-color: #fffff; border: 1px solid black;"><tr>';
        foreach ($heads as $header) {

            $htmlTable .= '<th style="padding: 5px; border-collapse: collapse;border: 1px solid black;">' . strtoupper(htmlspecialchars($header)) . '</th>';
        }
        $maxCells = max(array_map('count', $dataTableRows));

        $htmlTable .= '</tr></thead><tbody>';
        foreach ($dataTableRows as $row) {
            $htmlTable .= '<tr style="font-size: 11px; border-collapse: collapse;border: 1px solid black;"';
            if (isset($row['day']) && $row['day'] === 'دحألا') {
                $htmlTable .= ' style="background-color: #c0c0c0; font-size: 12px;border-collapse: collapse;border: 1px solid black;"';
            }
            $htmlTable .= '>';

            // Iterate over the existing values in $row
            foreach ($row as $value) {
                $htmlTable .= '<td style="padding:2.5px;border-collapse: collapse;border: 1px solid black;">' . htmlspecialchars($value) . '</td>';
            }

            // Add empty cells to match $maxCells
            for ($i = count($row); $i < $maxCells; $i++) {
                $htmlTable .= '<td style="padding: 2px;border: 1px solid black;">&nbsp;</td>'; // Use &nbsp; for an empty cell
            }

            $htmlTable .= '</tr>';
        }
        $htmlTable .= '</tbody>';

        $htmlTable .= '</table>';
        $htmlTable1 = '<table border="1" style="width: 100%; border-collapse: collapse; text-align: center; font-family: Arial;">';

        $htmlTable1 .= ' <tr>
                <td dir="rtl">إجمالي الساعات المطلوبة (شهر)</td>
                <td>' . $totalRequiredHours . '</td>
            </tr>
            <tr>
                <td dir="rtl">إجمالي ساعات العمل الفعلية</td>
                <td>' . $totalHours_worked . ' : ' . $totalMinutes_worked . '</td>
            </tr>
            <tr>
                <td dir="rtl">إجمالي اليام الحالية المطلوبة</td>
                <td>' . $totalRequireddays . '</td>
            </tr>
            <tr>
                <td dir="rtl">اليام الحالية الفعلية</td>
                <td>' . $totalPresentDays . '</td>
            </tr>
            <tr>
                <td dir="rtl">إجمالي أيام الغياب</td>
                <td>' . $totalAbsentDays . '</td>
            </tr>
            <tr>
                <td dir="rtl">إجمالي ساعات الغياب</td>
                <td> -' . $totalAbsentHours . ' : ' . $totalAbsentMinutes . '</td>
            </tr>';

        $htmlTable1 .= '</table>';



        $htmlfooter = '<p dir="rtl">أقر أنا الموقع أدناه بأنني قرأت هذا التقرير وأن التفاصيل المذكورة مطابقة.وصحيحة</p>

            <p dir="rtl"><b>  توقيع الموظف  :</b></p>
            <p dir="rtl"><b>  بصمة البهام :</b></p>
            <p dir="rtl"><b>  التاريخ :</b></p>
            <p dir="rtl"><b>  توقيع مسؤول الفرع :</b></p> 
            
            ';


        $htmlContent =  $htmlHeader  . $htmlTable . $htmlTable1 . $htmlfooter;


        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'Arial'
        ]);
        // $mpdf = new \Mpdf\Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->WriteHTML($htmlContent);
        // $mpdf->Output($filename, 'I');

        $pdfData = $mpdf->Output('', 'S'); // Capture the PDF content as a string

        // Encode the PDF data as base64
        $pdfBase64 = base64_encode($pdfData);

        // Output the PDF data as an object within a card
        echo '<object data="data:application/pdf;base64,' . $pdfBase64 . '" type="application/pdf" style="width:100%;height:1200px;"></object>';
        exit;
    }



    //English with Arabic
    public function Report_Combined()
    {

        $json_data = array();
        $j = 0;

        $data = array();


        if (isset($_POST['staff']) && $_POST['staff'] != '') {
            $data['a.userid ='] = ($_POST['staff']);
        }

        $year = isset($_POST['year']) ? $_POST['year'] : null;
        $month = isset($_POST['month']) ? $_POST['month'] : null;
        if ($month !== null) {
            $dateTime = new DateTime("$year-$month-01 00:00:00");
            $formattedMonth = $dateTime->format("Y-m-d H:i:s");
            $data['MONTH(a.check_in) ='] = date('n', strtotime($formattedMonth));
        } else {
            echo "Month not provided";
            exit;
        }
        if ($year !== null) {
            $dateTime = new DateTime("$year-$month-01 00:00:00");
            $formattedYear = $dateTime->format("Y-m-d H:i:s");
            $data['YEAR(a.check_in) ='] = date('Y', strtotime($formattedYear));
        }

        $attendance = $this->Attendance->select_Attendance("*", $data);
        $attendance_array = $attendance->getResult();

        if (!$attendance_array) {
            // Display an alert and then redirect
            echo '<script>alert("Error: Selected Month Data is Not Provided.");</script>';
            echo '<script>window.location.replace("/Report");</script>';
            exit;
        }

        //   $currentYear = date("Y");
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $array = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = date("d-m-Y", strtotime("$year-$month-$day"));
            $dayOfWeek = date("l", strtotime($date));
            $dayNumber = date('N', strtotime($date));

            $arabicDays = [
                1 => 'نينثألا',
                2 => 'ءاثالثلا',
                3 => 'ءاعبرألا',
                4 => 'سيمخلا',
                5 => 'هعمجلا ',
                6 => 'تبسلا',
                7 => 'دحألا',
            ];

            $dayArray = [
                'date' => $date,
                'Engday' => $dayOfWeek,
                'day' => $arabicDays[$dayNumber],
            ];

            $array[] = $dayArray;
        }

        $j = 0;
        $data = array();
        if (isset($_POST['branch']) && $_POST['branch'] != '') {
            $data['b.branch_id ='] = $_POST['branch'];
        }

        $branch = $this->Branch->select_Branches("*", $data);
        $branch_array = $branch->getResult();
        foreach ($branch_array as $row) {
            $schedule_1 = $obj = json_decode($row->schedule_1);
            $schedule_2 = $obj = json_decode($row->schedule_2);
        }

        $totalHours_worked = 0;
        $totalMinutes_worked = 0;
        $totalDurationInSeconds = 0;
        foreach ($attendance_array as $row) {
            $totalDurationInSeconds = 0;

            $schedule_1checkin = $schedule_1->checkin;
            $schedule_1break = $schedule_1->break;
            $schedule_1checkout = $schedule_1->checkout;
            if ($schedule_2 != null) {
                $schedule_2checkin = $schedule_2->checkin;
                $schedule_2break = $schedule_2->break;
                $schedule_2checkout = $schedule_2->checkout;
            }
            $timestamp1 = strtotime($row->check_in);
            $time1 = date("h:i A", $timestamp1);
            $timestamp2 = strtotime($row->check_out);
            $time2 = $timestamp2 ? date("h:i A", $timestamp2) : date("h:i A", strtotime($schedule_1->checkout));

            // Calculate duration for schedule 1
            $diff = (new DateTime($time1))->diff(new DateTime($time2));
            $breakInSeconds = strtotime($schedule_1->break) - strtotime('TODAY');
            $durationInSeconds = max(0, $diff->h * 3600 + $diff->i * 60 - $breakInSeconds);
            $totalDurationInSeconds += $durationInSeconds;

            // If schedule 2 is present, calculate its duration and add to the total
            if ($schedule_2 != null) {
                $timestamp1_schedule2 = strtotime($row->check_in2);

                if ($timestamp1_schedule2) {
                    $time1_schedule2 = date("h:i A", $timestamp1_schedule2);
                    $timestamp2_schedule2 = strtotime($row->check_out2);
                    $time2_schedule2 = $timestamp2_schedule2 ? date("h:i A", $timestamp2_schedule2) : date("h:i A", strtotime($schedule_2->checkout));
                    $diff_schedule2 = (new DateTime($time1_schedule2))->diff(new DateTime($time2_schedule2));
                    $breakInSeconds_schedule2 = strtotime($schedule_2->break) - strtotime('TODAY');
                    $durationInSeconds_schedule2 = max(0, $diff_schedule2->h * 3600 + $diff_schedule2->i * 60 - $breakInSeconds_schedule2);
                    $totalDurationInSeconds += $durationInSeconds_schedule2;
                } else {
                    $time1_schedule2 = '';
                    $time2_schedule2 = '';
                }
            }

            // Format total duration a day
            $totalHoursWorked = floor($totalDurationInSeconds / 3600);
            $totalMinutesWorked = floor(($totalDurationInSeconds % 3600) / 60);
            $totalDurationFormatted = sprintf('%02d:%02d', $totalHoursWorked, $totalMinutesWorked);

            // Update total hours and minutes for the current row
            list($hours, $minutes) = explode(':', $totalDurationFormatted);
            $totalHours_worked += (int)$hours;
            $totalMinutes_worked += (int)$minutes;

            // Handle carryover if minutes exceed 60
            if ($totalMinutes_worked >= 60) {
                $totalHours_worked += floor($totalMinutes_worked / 60);
                $totalMinutes_worked %= 60;
            }

            $name = $row->name;
            $key = array_search(date("d-m-Y", $timestamp1), array_column($array, 'date'));

            if ($key !== false) {

                if ($schedule_2 == null) {
                    $array[$key]['time'] = $time1;
                    $array[$key]['time2'] = $time2;
                    $array[$key]['duration'] = $totalDurationFormatted;
                } else {
                    $array[$key]['time'] = $time1;
                    $array[$key]['time2'] = $time2;
                    $array[$key]['schedule_2_time1'] = $time1_schedule2;
                    $array[$key]['schedule_2_time2'] = $time2_schedule2;
                    // $array[$key]['duration'] = $diff2->format("%h : %i ");
                    $array[$key]['duration'] = $totalDurationFormatted;
                }
            }
            $j++;
        }



        // total required hours and present days
        if ($schedule_2 == null) {

            $schedule_1checkin_Obj = DateTime::createFromFormat('H:i', $schedule_1checkin);
            $schedule_1checkout_Obj = DateTime::createFromFormat('H:i', $schedule_1checkout);

            // Convert break duration to seconds
            $schedule_1break_numeric = floatval($schedule_1break);
            $break_seconds = $schedule_1break_numeric * 3600;

            // Create a DateInterval object for the break duration
            $schedule_1break_Obj = new DateInterval("PT{$break_seconds}S");

            // Initialize variables
            $workingHoursPerDay = '';

            if ($schedule_1checkin_Obj && $schedule_1checkout_Obj) {
                $difference = $schedule_1checkin_Obj->diff($schedule_1checkout_Obj);

                $diff_seconds = ($difference->h * 3600) + ($difference->i * 60) - $break_seconds;

                $result_hours = floor($diff_seconds / 3600);
                $result_minutes = floor(($diff_seconds % 3600) / 60);

                // echo "Result: $result_hours hours and $result_minutes minutes";
            }
        } else {
            $schedule_2checkin_Obj = DateTime::createFromFormat('H:i', $schedule_2checkin);
            $schedule_2checkout_Obj = DateTime::createFromFormat('H:i', $schedule_2checkout);

            // Convert break duration to seconds
            $schedule_1break_numeric = floatval($schedule_2break);
            $break_seconds = $schedule_1break_numeric * 3600;

            // Create a DateInterval object for the break duration
            $schedule_1break_Obj = new DateInterval("PT{$break_seconds}S");

            // Initialize variables
            $workingHoursPerDay = '';

            if ($schedule_2checkin_Obj && $schedule_2checkout_Obj) {
                $difference = $schedule_2checkin_Obj->diff($schedule_2checkout_Obj);

                $diff_seconds = ($difference->h * 3600) + ($difference->i * 60) - $break_seconds;

                $result_hours = floor($diff_seconds / 3600);
                $result_minutes = floor(($diff_seconds % 3600) / 60);

                // echo "Result: $result_hours hours and $result_minutes minutes";
            }
        }
        $totalMinutes = ($result_hours * 60) + $result_minutes;
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $totalRequireddays = $daysInMonth - 2;
        $totalRequiredMinutes = $totalMinutes * $totalRequireddays;
        $totalRequiredHours = $totalRequiredMinutes / 60;
        $workingHoursPerDay = $totalRequiredHours / $totalRequireddays;


        // totalPresentDays
        $totalPresentDays = 0;

        if ($schedule_2 == null) {
            foreach ($attendance_array as $row) {
                // Get timestamps
                $timestamp = strtotime($row->check_in);
                $timestamp2 = strtotime($row->check_out);

                // Check if both check-in and check-out entries exist for the same day
                if (date('Y-m-d', $timestamp)) {
                    $totalPresentDays++;
                }
            }
        } else {
            foreach ($attendance_array as $row) {
                // Get timestamps
                $timestamp = strtotime($row->check_in);
                $timestamp2 = strtotime($row->check_out);

                $schedule2_timestamp = strtotime($row->check_in2);
                $schedule2_timestamp2 = strtotime($row->check_out2);
                // Check if both check-in and check-out entries exist for the same day for schedule 1
                if (date('Y-m-d', $timestamp)) {
                    $totalPresentDays++;
                }

                // Check if both check_in2 and check_out2 entries exist for the same day for schedule 2
                if (date('Y-m-d', $schedule2_timestamp)) {
                    $totalPresentDays++;
                }
            }
        }





        // Total absent days
        $totalAbsentDays = 0;

        for ($day = 1; $day <= $totalRequireddays; $day++) {
            // Format the date
            $date = date("Y-m-d", strtotime("$year-$month-$day"));
            // Check if there is no entry for the current day
            $entriesExist = false;
            // Loop through each row to check for entries
            foreach ($attendance_array as $row) {
                // Check for entry based on schedule
                if ($schedule_2 == null) {
                    $timestamp = strtotime($row->check_in);
                } else {
                    $timestamp1 = strtotime($row->check_in);
                    $timestamp2 = strtotime($row->check_in2);
                    // Check if either entry matches the current date
                    if (date("Y-m-d", $timestamp1) == $date || date("Y-m-d", $timestamp2) == $date) {
                        $entriesExist = true;
                        break; // Exit the loop if an entry is found for the current day
                    }
                }

                // Check if the entry matches the current date
                if (date("Y-m-d", $timestamp) == $date) {
                    $entriesExist = true;
                    break; // Exit the loop if an entry is found for the current day
                }
            }

            // If no entries found for the current day, consider it an absent day
            if (!$entriesExist) {
                $totalAbsentDays++;
            }
        }


        // Total Absent Hours
        $totalMinutes_workedmonth = $totalHours_worked * 60 + $totalMinutes_worked;
        $totalRequiredMinutes = $totalRequiredHours * 60;

        // Calculate total absent minutes
        $totalAbsentMinutes = $totalRequiredMinutes - $totalMinutes_worked;

        // Calculate total absent hours and remaining minutes
        $totalAbsentHours = floor($totalAbsentMinutes / 60);
        $totalAbsentMinutes %= 60;

        // If totalAbsentMinutes is negative, adjust totalAbsentHours accordingly
        if ($totalAbsentMinutes < 0) {
            $totalAbsentHours--; // Decrement totalAbsentHours by 1
            $totalAbsentMinutes += 60; // Add 60 minutes to compensate for the negative value
        }

        // echo 'Total Absent Hours: ' . $totalAbsentHours . ' Hr ' . $totalAbsentMinutes . ' Min';



        $data = array();
        if (isset($_POST['branch']) && $_POST['branch'] != '') {
            $data['b.branch_id ='] = $_POST['branch'];
        }

        $branch = $this->Branch->select_Branches("*", $data);
        $branch_array = $branch->getResult();
        // $schedule_2 = NULL;
        foreach ($branch_array as $row) {
            $schedule_2 = $row->schedule_2;
        }

        if ($schedule_2 == 'null') {
            $heads = array(' DATE (التاريخ)', 'DAY (اليوم)', 'DAY (اليوم)', 'وقت الدخول  IN-TIME', 'وقت الخروج OUT-TIME', 'مجموع الساعات TOTAL HRS');
        } else {
            $heads = array(' DATE (التاريخ)', 'DAY (اليوم)', 'DAY (اليوم)', 'وقت الدخول  IN-TIME', 'وقت الخروج OUT-TIME', ' ٢وقت الدخول  IN-TIME 2', '٢وقت الخروج OUT-TIME 2', 'مجموع الساعات TOTAL HRS');
        }



        foreach ($heads as $key => $value) {
            // Check if the string is not already in UTF-8
            if (!mb_detect_encoding($value, 'UTF-8', true)) {
                $heads[$key] = utf8_encode($value);
            }
        }
        $i = 'A';


        $rowIndex = 2;


        $json_data['data'] =  $array;
        $dataTableRows = $json_data['data'];

        $timestamp = strtotime("2024-$month-01");
        $monthName = date("F", $timestamp);
        $htmlHeader = '<div style="text-align: center; font-size:10px;  margin-bottom: 8px;"><b>' . strtoupper('ADVANCE COOL GENERAL TRADING/LLC') . '</b></div>' . '<div style="text-align: center; font-size: 12px; font-family: Arial; margin-bottom: 10px;"><b>' . strtoupper(htmlspecialchars($name) . ' ATTENDANCE FOR THE MONTH OF ' . htmlspecialchars($monthName)) . '</b></div>';

        $htmlTable = ' <table border="1" style="width: 100%; border-collapse: collapse; text-align: center; margin-bottom:5px;">';
        $htmlTable .= '<thead style="background-color: #fffff; "><tr>';
        foreach ($heads as $header) {

            $htmlTable .= '<th style="padding: 15px; border-collapse: collapse;">' . strtoupper(htmlspecialchars($header)) . '</th>';
        }
        $maxCells = max(array_map('count', $dataTableRows));

        $htmlTable .= '</tr></thead><tbody>';
        foreach ($dataTableRows as $row) {
            $htmlTable .= '<tr  style="font-size: 10px;"';
            if (isset($row['day']) && $row['day'] === 'دحألا') {
                $htmlTable .= ' style="background-color: #c0c0c0; font-size: 12px;"';
            }
            $htmlTable .= '>';

            // Iterate over the existing values in $row
            foreach ($row as $value) {
                $htmlTable .= '<td style="padding: 2px;">' . htmlspecialchars($value) . '</td>';
            }

            // Add empty cells to match $maxCells
            for ($i = count($row); $i < $maxCells; $i++) {
                $htmlTable .= '<td style="padding: 2px;">&nbsp;</td>'; // Use &nbsp; for an empty cell
            }

            $htmlTable .= '</tr>';
        }
        $htmlTable .= '</tbody>';

        $htmlTable .= '</table>';
        $htmlTable1 = '<table border="1" style="width: 100%; border-collapse: collapse; text-align: center; font-family: Arial;">';

        $htmlTable1 .= ' <tr>
                <td>Total Required Hours (month)</td>
                <td>' . $totalRequiredHours . '</td>
                <td dir="rtl">إجمالي الساعات المطلوبة (شهر)</td>
            </tr>
            <tr>
                <td>Total Hours Worked</td>
                <td>' . $totalHours_worked . ' : ' . $totalMinutes_worked . '</td>
                <td dir="rtl">إجمالي ساعات العمل الفعلية</td>
            </tr>
            <tr>
                <td>Total Required Present days</td>
                <td>' . $totalRequireddays . '</td>
                <td dir="rtl">إجمالي اليام الحالية المطلوبة</td>
            </tr>
            <tr>
                <td>Total Actual Present days</td>
                <td>' . $totalPresentDays . '</td>
                <td dir="rtl">اليام الحالية الفعلية</td>
            </tr>
            <tr>
                <td>Total Absent days</td>
                <td>' . $totalAbsentDays . '</td>
                <td dir="rtl">إجمالي أيام الغياب</td>
            </tr>
            <tr>
                <td>Total Absent Hours</td>
                <td> -' . $totalAbsentHours . ' : ' . $totalAbsentMinutes . '</td>
                <td dir="rtl">إجمالي ساعات الغياب</td>
            </tr>';

        $htmlTable1 .= '</table>';

        // // $htmlfooter = '<div style="display: inline-block; width: 50%;">';
        // $htmlfooter = '<div dir="rtl" style="display: inline-block; width: 50%; margin-bottom: -50px"">أقر أنا الموقع أدناه بأنني قرأت هذا التقرير وأن التفاصيل المذكورة مطابقة<br/>.وصحيحة</div>
        // <p >I, the undersigned hereby acknowledge to have read this<br/>report and the details mentioned are true and correct.</p>

        // $htmlHeader = '<div style="text-align: center; font-size: 10px; font-family: Arial; margin-bottom: 20px;"><b>' . strtoupper('ADVANCE COOL GENERAL TRADING/LLC</br>SALEEM ATTENDANCE FOR THE MONTH OF ' . htmlspecialchars($monthName)) . '</b></div>';
        // $htmlfooter = '<p dir="rtl">أقر أنا الموقع أدناه بأنني قرأت هذا التقرير وأن التفاصيل المذكورة مطابقة    I, the undersigned hereby acknowledge to have read this <br/><p dir="rtl"> .وصحيحة  report and the details mentioned are true and correct.</p>
        $htmlfooter = '<div style=" margin-bottom:-10px;">
        <div style="direction: rtl; ">
            <div>أقر أنا الموقع أدناه بأنني قرأت هذا التقرير وأن التفاصيل المذكورة مطابقة  <br/>.وصحيحة  </div>
            <div><br/></div>
            <div style="line-height: 200%;"><b>توقيع الموظف:</b></div>
            <div style="line-height: 200%;"><b>بصمة البهام:</b></div>
            <div style="line-height: 200%;"><b>التاريخ:</b></div>
            <div style="line-height: 200%;"><b>توقيع مسؤول الفرع:</b></div>
        </div>
        <div style="direction: ltr; margin-top:-150p;">
            <div>I, the undersigned hereby acknowledge to have read this<br/> report and the details mentioned are true and correct.</div>
            <div><br/><br/></div>
            <div style="line-height: 200%;"><b>Staff Signature:</b></div>
            <div style="line-height: 200%;"><b>Thumb Impression:</b></div>
            <div style="line-height: 200%;"><b>Date:</b></div>
            <div style="line-height: 200%;"><b>Branch Incharge Signature:</b></div>
        </div>
    </div>
            ';


        $htmlContent =  $htmlHeader  . $htmlTable . $htmlTable1 . $htmlfooter;


        $filename = strtoupper(htmlspecialchars($name)) . '_ATTENDANCE_' . strtoupper(htmlspecialchars($monthName))  . date('dmYhis') . '.pdf';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'Arial'
        ]);
        // $mpdf = new \Mpdf\Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->WriteHTML($htmlContent);
        // $mpdf->Output($filename, 'I');
        $pdfData = $mpdf->Output('', 'S'); // Capture the PDF content as a string

        // Encode the PDF data as base64
        $pdfBase64 = base64_encode($pdfData);

        // Output the PDF data as an object within a card
        echo '<object data="data:application/pdf;base64,' . $pdfBase64 . '" type="application/pdf" style="width:100%;height:1200px;"></object>';

        exit;
    }



    public function Branch_report()
    {
        $userRole = $this->session->get('user_role');
        if ($userRole === 'admin') {
            $branch = $this->Branch->select_Branches("*");
            $this->data['branches'] = $branch->getResult();
        } elseif ($userRole === 'manager') {
            $branch_id = $this->session->get('branch_id');
            if (isset($branch_id) && $branch_id != '') {
                $data['branch_id'] = json_decode($branch_id, true);
            }
            $branch = $this->Branch->select_branches_for_managers("*", $data);
            $this->data['branches'] = $branch->getResult();
        }

        $userRole = $this->session->get('user_role');
        if ($userRole === 'admin' || $userRole === 'manager') {
            $this->data['page'] = 'Branch_report_list';
            return view('Index', $this->data);
        } else {
            return redirect()->to('/');
        }
    }

    public function Select_branch_report()
    {
        $json_data = array();
        $j = 0;

        $data = array();

        $year = isset($_POST['year']) ? $_POST['year'] : null;

        $month = isset($_POST['month']) ? $_POST['month'] : null;
        if ($month !== null) {
            $dateTime = new DateTime("$year-$month-01 00:00:00");
            $formattedMonth = $dateTime->format("Y-m-d H:i:s");
            $data['MONTH(a.check_in) ='] = date('n', strtotime($formattedMonth));
        } else {
            echo '<script>';
            echo 'Swal.fire({';
            echo '    icon: "error",';
            echo '    title: "Error",';
            echo '    text: "Month Not Provided."';
            echo '}).then(() => {';
            echo '    window.location.replace("/Report/Branch_report");';
            echo '});';
            echo '</script>';
            exit;
        }
        if ($year !== null) {
            $dateTime = new DateTime("$year-$month-01 00:00:00");
            $formattedYear = $dateTime->format("Y-m-d H:i:s");
            $data['YEAR(a.check_in) ='] = date('Y', strtotime($formattedYear));
        }

        if (isset($_POST['branch']) && $_POST['branch'] != '') {
            $data['s.branch_id ='] = $_POST['branch'];
            $branch = $_POST['branch'];
        }


        $attendance = $this->Report->select_Attendance("a.* ,device.name as device_name,s.name as name ", $data);
        $attendance_array = $attendance->getResult();
        if (!$attendance_array) {

            echo '<script>';
            echo 'Swal.fire({';
            echo '    icon: "error",';
            echo '    title: "Error",';
            echo '    text: "Selected Month Or Branch Attendance Data is Not Provided."';
            echo '}).then(() => {';
            echo '    window.location.replace("/Report/Branch_report");';
            echo '});';
            echo '</script>';
            exit;
        }

        $currentYear = date("Y");
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month,  $year);

        // $branch = $this->Branch->select_Branches("*", ['branch_id' => $branch]);
        // $branch_array = $branch->getResult();
        // foreach ($branch_array as $row) {
        //     $schedule_1 =$obj = json_decode($row->schedule_1); 
        //     $schedule_2 =$obj = json_decode($row->schedule_2); 
        // }
        // $staffs_array = $this->Staffs->select_Staffs("*", ['s.branch_id' => $branch])->getResult();
        $branch = $this->Branch->select_Branches("*", ['branch_id' => $branch]);
        $branch_array = $branch->getResult();

        // Assuming branch exists, proceed to fetch staffs
        if (!empty($branch_array)) {
            foreach ($branch_array as $row) {
                $schedule_1 = json_decode($row->schedule_1);
                $schedule_2 = json_decode($row->schedule_2);
            }

            // Fetch staffs based on branch ID
            $staffs_array = $this->Staffs->select_Staffs("*", ['s.branch_id' => $row->branch_id])->getResult();
        }

        $array = [];
        $totalHoursWorked = 0;

        foreach ($staffs_array as $staff) {
            $name = $staff->name;

            // Reset calculation variables for each staff member
            $totalPresentDays = 0;
            $totalDurationInSeconds = 0;
            $totalHours_worked = 0;
            $totalMinutes_worked = 0;

            foreach ($attendance_array as $row) {
                if ($row->name === $name) {
                    $timestamp1 = strtotime($row->check_in);
                    $timestamp2 = strtotime($row->check_out);

                    $schedule_1checkin = $schedule_1->checkin;
                    $schedule_1break = $schedule_1->break;
                    $schedule_1checkout = $schedule_1->checkout;

                    if ($schedule_2 != null) {
                        $schedule_2checkin = $schedule_2->checkin;
                        $schedule_2break = $schedule_2->break;
                        $schedule_2checkout = $schedule_2->checkout;
                    }

                    $time1 = date("h:i A", $timestamp1);
                    $time2 = $timestamp2 ? date("h:i A", $timestamp2) : date("h:i A", strtotime($schedule_1->checkout));

                    $diff = (new DateTime($time1))->diff(new DateTime($time2));
                    $breakInSeconds = strtotime($schedule_1->break) - strtotime('TODAY');
                    $durationInSeconds = max(0, $diff->h * 3600 + $diff->i * 60 - $breakInSeconds);

                    $totalDurationInSeconds += $durationInSeconds;

                    if ($schedule_2 != null) {
                        $timestamp1_schedule2 = strtotime($row->check_in2);
                        $time1_schedule2 = date("h:i A", $timestamp1_schedule2);
                        $timestamp2_schedule2 = strtotime($row->check_out2);
                        $time2_schedule2 = $timestamp2_schedule2 ? date("h:i A", $timestamp2_schedule2) : date("h:i A", strtotime($schedule_2->checkout));

                        $diff_schedule2 = (new DateTime($time1_schedule2))->diff(new DateTime($time2_schedule2));
                        $breakInSeconds_schedule2 = strtotime($schedule_2->break) - strtotime('TODAY');
                        $durationInSeconds_schedule2 = max(0, $diff_schedule2->h * 3600 + $diff_schedule2->i * 60 - $breakInSeconds_schedule2);

                        $totalDurationInSeconds += $durationInSeconds_schedule2;
                    }

                    // Increment totalPresentDays if both check-in and check-out exist for the same day
                    // if (date('Y-m-d', $timestamp1) == date('Y-m-d', $timestamp2)) {
                    //     $totalPresentDays++;
                    // }
                    if ($schedule_2) {
                        if (date('Y-m-d', $timestamp1)) {
                            $totalPresentDays++;
                        }
                    } else {
                        if (date('Y-m-d', $timestamp1) || date('Y-m-d', $time1_schedule2)) {
                            $totalPresentDays++;
                        }
                    }
                }
            }

            // Calculate total hours worked for the current staff member
            $totalHours = floor($totalDurationInSeconds / 3600);
            $totalMinutes = floor(($totalDurationInSeconds % 3600) / 60);

            // Update $array with calculated values for the current staff member
            $array[] = [
                'name' => $name,
                'totalPresentDays' => $totalPresentDays,
                'totalHours' => $totalHours . ' : ' . $totalMinutes
            ];

            // Update total hours worked for all staff members
            $totalHoursWorked += $totalDurationInSeconds;
        }

        // Calculate total hours worked for all staff members
        $totalHoursAllStaff = floor($totalHoursWorked / 3600);
        $totalMinutesAllStaff = floor(($totalHoursWorked % 3600) / 60);

        $data = array();
        if (isset($_POST['branch']) && $_POST['branch'] != '') {
            $data['b.branch_id ='] = $_POST['branch'];
        }

        $branch = $this->Branch->select_Branches("*", $data);
        $branch_array = $branch->getResult();
        // $schedule_2 = NULL;
        foreach ($branch_array as $row) {
            $branch_name = $row->branch_name;
        }

        $heads = array('Staff', 'Total Attendance', 'Total Hours Worked');

        $i = 'A';

        $rowIndex = 4;


        $json_data['data'] =  $array;
        $dataTableRows = $json_data['data'];

        $timestamp = strtotime("2023-$month-01");
        $monthName = date("F", $timestamp);

        $htmlHeader = '<div style="text-align: center; font-size:10px; font-family: Verdana; margin-bottom: 10px;"><b>' . strtoupper('ADVANCE COOL GENERAL TRADING/LLC') . '</b></div>' . '<div style="text-align: center; font-size: 12px; font-family: Arial; margin-bottom: 10px;"><b>' . strtoupper(htmlspecialchars($branch_name) . ' BRANCH ATTENDANCE REPORT FOR THE MONTH OF ' . htmlspecialchars($monthName)) . '</b></div>';


        $htmlTable = '<table border="2" style="width:100%; border-collapse:collapse; text-align: center; margin-bottom:5px;border: 1px solid black;">';
        $htmlTable .= '<thead style="background-color: #fffff; border: 1px solid black;"><tr>';
        foreach ($heads as $header) {

            $htmlTable .= '<th style="padding: 5px; border-collapse: collapse;border: 1px solid black;">' . strtoupper(htmlspecialchars($header)) . '</th>';
        }
        $maxCells = max(array_map('count', $dataTableRows));

        $htmlTable .= '</tr></thead><tbody>';
        foreach ($dataTableRows as $row) {
            $htmlTable .= '<tr style="font-size: 12px; border-collapse: collapse;border: 1px solid black;"';

            $htmlTable .= '>';

            // Iterate over the existing values in $row
            foreach ($row as $value) {
                $htmlTable .= '<td style="padding:2px;border-collapse: collapse;border: 1px solid black;">' . htmlspecialchars($value) . '</td>';
            }

            // Add empty cells to match $maxCells
            for ($i = count($row); $i < $maxCells; $i++) {
                $htmlTable .= '<td style="padding: 3px;border: 1px solid black;">&nbsp;</td>'; // Use &nbsp; for an empty cell
            }

            $htmlTable .= '</tr>';
        }
        $htmlTable .= '</tbody> 
                <tr rowspan="2" style="border: 1px solid black; font-size:20px;">
                <td colspan="2" style="border: 1px solid black;font-size:14px;padding: 5px;">Total Branch Work Hours</td>
                  <td style="border: 1px solid black;"> '  . $totalHoursAllStaff . ' : ' . $totalMinutesAllStaff . '</td>
                </tr>';

        $htmlTable .= '</table>';


        $htmlContent = $htmlHeader . $htmlTable;

        $mpdf = new \Mpdf\Mpdf();
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'Arial'
        ]);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->WriteHTML($htmlContent);
        $filename = strtoupper(htmlspecialchars($branch_name)) . '_ATTENDANCE_' . strtoupper(htmlspecialchars($monthName))  . date('dmYhis') . '.pdf';

        $pdfData = $mpdf->Output('', 'S');

        $pdfBase64 = base64_encode($pdfData);

        echo '<object data="data:application/pdf;base64,' . $pdfBase64 . '" type="application/pdf" style="width:100%;height:1200px;" download="' . $filename . '"></object>';
        exit;
    }
}
