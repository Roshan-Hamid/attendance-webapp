<?php

namespace App\Controllers;

use DateTime;
use DateInterval;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Html;
// use App\Controllers\BaseController;
// use App\Helpers\PdfHelper;
use Mpdf\Mpdf;



class Attendance extends BaseController
{

    public function __construct()
    {

        ini_set('max_execution_time', 5000);
        ini_set("memory_limit", "-1");
        date_default_timezone_set('Asia/Kolkata');
        $this->session = \Config\Services::session();
        $this->Attendance = model('Attendance_model');
        $this->Devices = model('Devices_model');
        $this->Branch = model('Branch_model');
        $this->User = model('User_model');
        $this->Staffs = model('Staffs_model');
        // return view('Frontend', $this->data);
        $this->data['folder'] = 'Attendance';
    }


    public function index()
    {

        $userRole = $this->session->get('user_role');
        if ($userRole === 'admin' || $userRole === 'manager') {
            $this->data['page'] = 'Attendance_list';
            return view('Index', $this->data);
        } else {
            return redirect()->to('/');
        }
    }


    public function BranchDropdownData()
    {
        $json_data = array();
        $j = 0;
        $data = array();
        // echo $userRole;
        $userRole = $this->session->get('user_role');
        if ($userRole === 'admin') {
            $branch = $this->Branch->select_Branches("*", $data);
            $branch_array = $branch->getResult();
            foreach ($branch_array as $row) :
                $array[$j][] = $row->branch_id;
                $array[$j][] = $row->branch_name;
            endforeach;
            $json_data['data'] = $array;
            echo json_encode($array);
        } elseif ($userRole === 'manager') {
            $branch_id = $this->session->get('branch_id');
            if (isset($branch_id) && $branch_id != '') {
                $branch_ids = json_decode($branch_id, true);
            }

            $branch = $this->Branch->select_Branches("*", $data);
            $branch_array = $branch->getResult();
            foreach ($branch_array as $row) :
                if (in_array($row->branch_id, $branch_ids)) {
                    $array[$j][] = $row->branch_id;
                    $array[$j][] = $row->branch_name;
                }
            endforeach;
            $json_data['data'] = $array;
            echo json_encode($array);
        }
    }
    public function checkschedule()
    {
        $data = array();

        if (isset($_POST['branch']) && $_POST['branch'] != '') {
            $data['branch_id ='] = $_POST['branch'];
        }

        $branch = $this->Branch->select_Branches("*", $data);
        $branch_data = $branch->getResult();

        $json_data = array();
        $row = $branch_data[0];
        $schedule_2 = json_decode($row->schedule_2, true);
        if (!empty($schedule_2)) {
            $Checkin_b = isset($schedule_2['checkin']) ? $schedule_2['checkin'] : '';
            $json_data['data'] = $Checkin_b;
            $response = [
                "success" => true,
                "message" => "Schedule 2 Exist", $schedule_2
            ];
            return $this->response->setJSON($response);
        } else {
            $response = [
                "success" => false,
                "message" => "Schedule 2 Not Exist"
            ];
            return $this->response->setJSON($response);
        }
    }

    public function StaffDropdownData()
    {
        $json_data = array();
        $j = 0;
        $data = array();

        if (isset($_POST['branch']) && $_POST['branch'] != '') {
            $data['s.branch_id ='] = $_POST['branch'];
        }

        $staffs = $this->Staffs->select_Staffs("*", $data);
        $staffs_array = $staffs->getResult();

        foreach ($staffs_array as $row) :
            $array[$j][] = $row->userid;
            $array[$j][] = $row->name;
        endforeach;
        $json_data['data'] = $array;
        echo json_encode($array);
    }




    public function select_Attendance()
    {

        $json_data = array();
        $j = 0;
        // $branch_id =array();
        $branch_id = '';

        $data = array();
        if (isset($_POST['branch']) && $_POST['branch'] != '') {
            $data['s.branch_id ='] = $_POST['branch'];
        }
        if (isset($_POST['start_date']) && $_POST['start_date'] != '') {
            $data['a.check_in >='] = date('Y-m-d 00:00:00', strtotime($_POST['start_date']));
        }

        if (isset($_POST['end_date']) && $_POST['end_date'] != '') {
            $data['a.check_in <='] = date('Y-m-d 23:59:59', strtotime($_POST['end_date']));
        }

        $attendance = $this->Attendance->select_Attendance("*", $data);
        $attendance_array = $attendance->getResult();

        foreach ($attendance_array as $row) {
            $branch_id = $row->branch_id;
        }

        $branch = $this->Branch->select_Branches("*", ['b.branch_id' => $branch_id]);
        $branch_data = $branch->getResult();
        // print_r($branch_data);
        if (!empty($branch_data)) {
            $branchrow = $branch_data[0];
            $schedule_2 = json_decode($branchrow->schedule_2, true);
            if (is_array($schedule_2)) {
                $schedule_2 = implode(', ', $schedule_2);
            }
        } else {
            $schedule_2 = '';
        }

        $json_data['recordsTotal'] = count($attendance_array);
        $json_data['recordsFiltered'] = count($attendance_array);
        $array = array();
        $html_content = '';
        $html = '';
        if ($schedule_2) {

            foreach ($attendance_array as $row) {
                // $btn_edit = '<button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#attendance_edit_modal" id="attendance_edit_btn" attendanceid='.$row->id.' check_in='.$row->check_in.'check_out='.$row->check_out.'  > <i class="ki-outline ki-pencil fs-2"></i> </button>';
                $timestamp = strtotime($row->check_in);
                $date = date("d-m-Y", $timestamp);
                $intime = date("h:i A", $timestamp);
                $day = date("l", $timestamp);
                $timestamp2 = strtotime($row->check_out);

                $schedule_2timestamp = strtotime($row->check_in2);

                $schedule_2timestamp2 = strtotime($row->check_out2);
                // $date2 = date("d-m-Y", $schedule_2timestamp);
                // $day = date("l", $schedule_2timestamp);

                if ($timestamp2 != null) {
                    $outtime = date("h:i A", $timestamp2);
                } else {
                    $outtime = '';
                }
                if ($schedule_2timestamp != null) {
                    $intime2 = date("h:i A", $schedule_2timestamp);
                } else {
                    $intime2 = '';
                }
                if ($schedule_2timestamp2 != null) {
                    $outtime2 = date("h:i A", $schedule_2timestamp2);
                } else {
                    $outtime2 = '';
                }

                // $array[$j][] = $j + 1;
                $update_status = $row->updated_on;
                $updateIcon = ($update_status !== NULL) ? '<i class="ki-solid ki-pencil fs-2"></i>' : '<i class="ki-outline ki-pencil fs-2"></i>';

                $html_content .= '
                    <tr>
                        <td>
                            <a href="#" class="ps-4 text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">' . ($j + 1) . '</a>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex justify-content-start flex-column">
                                    <a href="' . base_url() . 'Report?uid=' . urlencode($row->uid) . '&userid=' . urlencode($row->userid) . '" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6"> ' . $row->name . '</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">' . $date . '</a>
                        </td>
                        <td>
                            <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">' . $day . '</a>
                        </td>
                        <td>
                            <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">' . $intime . '</a>
                        </td>
                        <td>
                            <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">' . $outtime . '</a>
                        </td>
                        <td>
                            <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">' . $intime2 . '</a>
                        </td>
                        <td>
                            <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">' . $outtime2 . '</a>
                        </td>
                        <td>
                            <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit_btn" data-bs-toggle="modal" data-bs-target="#attendance_edit_modal" id="attendance_edit_btn" name="' . $row->name . '" attendanceid="' . $row->index . '" userid="' . $row->userid . '" date="' . $date . '" check_in="' . $intime . '" check_out="' . $outtime . '" schedule_2="' . $schedule_2 . '">' . $updateIcon . '</button>
                        </td>
                    </tr>';
                $j++;
            }
            $array[][] = '<div class="container"><div class="row g-5 g-xl-8"><div class="card mb-5 mb-xl-8">
                <div class="card-body">
                    <div class="table-responsive pt-3">
                        <table class="table align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    <th class="ps-4 min-w-25px rounded-start">Sl</th>
                                    <th class="min-w-250px ">Name</th>
                                    <th class="min-w-100px">Date</th>
                                    <th class="min-w-100px">Day</th>
                                    <th class="min-w-100px">In-Time</th>
                                    <th class="min-w-100px">Out-Time</th>
                                    <th class="min-w-100px">In-Time 2</th>
                                    <th class="min-w-100px">Out-Time 2</th>
                                    <th class="min-w-25px rounded-end"></th>
                                </tr>
                            </thead>
                            <tbody>' . $html_content . '</tbody>
                </table>
            </div>
            </div>
            </div></div></div>';

            $json_data['data'] = $array;
            echo json_encode($json_data);
        } else {
            foreach ($attendance_array as $row) {
                $timestamp = strtotime($row->check_in);
                $date = date("d-m-Y", $timestamp);
                $intime = date("h:i A", $timestamp);
                $day = date("l", $timestamp);
                $timestamp2 = strtotime($row->check_out);
                // $outtime = date("h:i A", $timestamp2);

                $checkInTime = new DateTime($row->check_in);
                if ($timestamp2 != null) {
                    $outtime = date("h:i A", $timestamp2);
                } else {
                    $outtime = '';
                }

                // $array[$j][] = $j + 1;

                $update_status = $row->updated_on;
                $updateIcon = ($update_status !== NULL) ? '<i class="ki-solid ki-pencil fs-2"></i>' : '<i class="ki-outline ki-pencil fs-2"></i>';

                $html_content .= '
                <tr>
                    <td>
                        <a href="#" class="ps-4 text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">' . ($j + 1) . '</a>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="d-flex justify-content-start flex-column">
                                <a href="' . base_url() . 'Report?uid=' . urlencode($row->uid) . '&userid=' . urlencode($row->userid) . '" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6"> ' . $row->name . '</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">' . $date . '</a>
                    </td>
                    <td>
                        <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">' . $day . '</a>
                    </td>
                    <td>
                        <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">' . $intime . '</a>
                    </td>
                    <td>
                        <a href="#" class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">' . $outtime . '</a>
                    </td>
                    <td>
                        <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit_btn" data-bs-toggle="modal" data-bs-target="#attendance_edit_modal" id="attendance_edit_btn" name="' . $row->name . '" attendanceid="' . $row->index . '" userid="' . $row->userid . '" date="' . $date . '" check_in="' . $intime . '" check_out="' . $outtime . '" schedule_2="' . $schedule_2 . '">' . $updateIcon . '</button>
                    </td>
                </tr>';
                $j++;
            }
            $array[][] = '<div class="container"><div class="row g-5 g-xl-8"><div class="card mb-5 mb-xl-8">
            <div class="card-body">
                <div class="table-responsive pt-3">
                    <table class="table table-bordered table-hover align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-25px rounded-start">Sl</th>
                                <th class="min-w-250px">Name</th>
                                <th class="min-w-100px">Date</th>
                                <th class="min-w-100px">Day</th>
                                <th class="min-w-100px">In-Time</th>
                                <th class="min-w-100px">Out-Time</th>
                                <th class="min-w-25px rounded-end"></th>
                            </tr>
                        </thead>
                        <tbody>' . $html_content . '</tbody>
            </table>
        </div>
        </div>
        </div></div></div>';


            $json_data['data'] = $array;
            echo json_encode($json_data);
        }
    }

    public function create_attendance()
    {

        $userid = $this->request->getPost('userid');

        $date = $this->request->getPost('date');
        $intime = $this->request->getPost('intime');
        $outtime = $this->request->getPost('outtime');

        $intime2 = $this->request->getPost('intime2');
        $outtime2 = $this->request->getPost('outtime2');
        // Convert the input time to 24-hour format
        $intime_formatted = date("H:i", strtotime($intime));
        $outtime_formatted = date("H:i", strtotime($outtime));
        $date_formatted = date("Y-m-d", strtotime($date));

        $check_in = $date_formatted . " " . $intime_formatted;
        $check_out = $date_formatted . " " . $outtime_formatted;


        if ($intime2 && $outtime2) {
            $intime2_formatted = date("H:i", strtotime($intime2));
            $outtime2_formatted = date("H:i", strtotime($outtime2));
            $check_in2 = $date_formatted . " " . $intime2_formatted;
            $check_out2 = $date_formatted . " " . $outtime2_formatted;
            $data = [
                'check_in' => $check_in,
                'check_out' => $check_out,
                'check_in2' => $check_in2,
                'check_out2' => $check_out2,
                'userid' => $userid,
                'device_id' => 'Manual',
                'updated_on' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->get('user_id')
            ];
        } else {
            $data = [
                'check_in' => $check_in,
                'check_out' => $check_out,
                'userid' => $userid,
                'device_id' => 'Manual',
                'updated_on' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->get('user_id')
            ];
        }

        $attendance = $this->Attendance->create_Attendance($data);

        if ($attendance['status'] == 1) {
            // Create JSON response for success
            $response = [
                "success" => true,
                "attendance" => "Attendance Created!!<br>DATE: $date <br>IN-TIME: $check_in <br>OUT-TIME: $check_out"
            ];
            return $this->response->setJSON($response);
        } else {
            $response = [
                "success" => false,
                "message" => "Sorry.. There Have been Some Error Occurred. Please Try Again!"
            ];
            return $this->response->setJSON($response);
        }
    }

    public function update_attendance()
    {
        $id = $this->request->getPost('edit_id');
        $name = $this->request->getPost('name');
        $date = $this->request->getPost('date');
        $intime = $this->request->getPost('intime');
        $outtime = $this->request->getPost('outtime');
        $intime2 = $this->request->getPost('intime2');
        $outtime2 = $this->request->getPost('outtime2');
        $intime_formatted = date("H:i:s", strtotime($intime));
        $outtime_formatted = date("H:i:s", strtotime($outtime));
        $date_formatted = date("Y-m-d", strtotime($date));
        // Concatenate the date and formatted time
        $check_in = $date_formatted . " " . $intime_formatted;
        $check_out = $date_formatted . " " . $outtime_formatted;


        if ($intime2 && $outtime2) {
            $intime2_formatted = date("H:i", strtotime($intime2));
            $outtime2_formatted = date("H:i", strtotime($outtime2));
            $check_in2 = $date_formatted . " " . $intime2_formatted;
            $check_out2 = $date_formatted . " " . $outtime2_formatted;
            $data = [
                'index' => $id,
                'check_in' => $check_in,
                'check_in2' => $check_in2,
                'check_out' => $check_out,
                'check_out2' => $check_out2,
                'updated_on' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->get('user_id')
            ];
        } else {
            $data = [
                'index' => $id,
                'check_in' => $check_in,
                'check_out' => $check_out,
                'check_in2' => NULL,
                'check_out2' => NULL,
                'updated_on' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->get('user_id')
            ];
        }
        // exit(print_r($data));
        $attendance = $this->Attendance->update_Attendance($data);
        if ($attendance == 1) {
            // Create JSON response for success
            $response = [
                "success" => true,
                "attendance" => "attendance of $name <br> check_in: $check_in <br>check_out: $check_out <br>Updated!!"
            ];
            // Return JSON response
            return $this->response->setJSON($response);
        } else {
            // Create JSON response for error
            $response = [
                "success" => false,
                "message" => "Sorry.. There Have been Some Error Occurred. Please Try Again!"
            ];
            // Return JSON response
            return $this->response->setJSON($response);
        }
    }
}
