<?php

namespace App\Controllers;

error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Libraries\ZKLib\ZKLib;
use DateTime;
use Exception;

class Data_restore extends BaseController
{

    public function __construct()
    {
        ini_set('max_execution_time', 5000);
        // ini_set("memory_limit", "-1");
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        date_default_timezone_set('Asia/Kolkata');
        $this->session = \Config\Services::session();
        $this->Staffs = model('Staffs_model');
        $this->Attendance = model('Attendance_model');
        $this->Iclock = model('Iclock_model');
        $this->Devices = model('Devices_model');
        $this->Branch = model('Branch_model');
        include(APPPATH . "Libraries/zklib/zklib.php");
    }

    public function user_data()
    {
        try {
            $zk = new ZKLib("112.133.223.163", 4371);
            $zk->connect();
            if ($zk) :
                try {
                    $user = $zk->getUser();
                    $zk->disconnect();
                    // print_r($user);
                    $i = 0;
                    foreach ($user as $uid => $userdata) {
                        $userid = $userdata[0];
                        $i++;
                        print_r($userid);

                        //     $staff = $this->Staffs->select_Staffs("*", ['s.userid' => $userid]);
                        //     $staff = $staff->getResult();
                        // print_r($staff);

                        //     if (empty($staff)) {
                        if ($userdata[0] == $userid) {
                            if ($userdata[2] == LEVEL_ADMIN)
                                $role = 'ADMIN';
                            elseif ($userdata[2] == LEVEL_USER)
                                $role = 'USER';
                            else
                                $role = 'Unknown';

                            $device_id = 'AF4C201460206';
                            $device = $this->Devices->select_Devices("*", ['d.device_id' => $device_id]);
                            $device = $device->getResult();
                            $device_data = $device[0];
                            $branch_id = $device_data->branch_id;

                            if ($branch_id) {
                                $data = array();

                                $data = [
                                    'uid' =>  $uid,
                                    'userid' => $userdata[0],
                                    'device_id' => json_encode($device_id),
                                    'name' => $userdata[1],
                                    'role' => $role,
                                    'password' => $userdata[3],
                                    'branch_id' => $branch_id,
                                ];
                                print_r($data);

                                $result = $this->Staffs->insert_Staff($data);
                            }
                        }
                        if ($i >= 50) {
                            break;
                        }
                    }
                } catch (Exception $e) {
                    // header("HTTP/1.0 404 Not Found");
                    header('HTTP', true, 200);
                    exit(print_r($e));
                }
            endif;
        } catch (Exception $e) {
            exit('Connection error!');
            exit(print_r($e));
        }
    }
    public function attendance_data()
    {
        try {
            $device_sn = $_GET['device'];
            $device = $this->Devices->select_Devices("*", ['d.device_id' => $device_sn]);
            $device_array = $device->getResult();
            if (!empty($device_array)) {

                $ip = $device_array[0]->ip;
                $port = $device_array[0]->port;

                $zk = new ZKLib($ip, $port);
                $zk->connect();
                if ($zk) {
                    $attendance = $zk->getAttendance();
                    $i = 0;
                    $page = $_GET['page'];
                    $perPage = 500;

                    for ($array_id = 0; $array_id < count($attendance); $array_id++) {
                        if ($array_id < ($page * $perPage) - $perPage) {
                            continue;
                        }
                        $row = $attendance[$array_id];
                        echo  $array_id . '<br>';

                        // Your logic here
                        // }

                        // foreach ($attendance as $array_id => $row) {
                        $i++;
                        $userid = $row[0];
                        $date = date('Y-m-d', strtotime($row[3]));

                        $branch_id = $device_array[0]->branch_id;

                        $branch = $this->Branch->select_Branches("*", ['b.branch_id' => $branch_id]);
                        $branch_array = $branch->getResult();

                        if (!empty($branch_array)) {
                            $branch = $branch_array[0];
                            $schedule_1 = json_decode($branch->schedule_1);
                            $schedule_2 = json_decode($branch->schedule_2);

                            $schedule_1checkin_timestamp = $schedule_1->checkin;
                            $schedule_1checkout_timestamp = $schedule_1->checkout;
                            if ($schedule_2 != null) {
                                $schedule_2checkin_timestamp = $schedule_2->checkin;
                                $schedule_2checkout_timestamp = $schedule_2->checkout;
                            }
                        }
                        $att_exist = $this->Attendance->select_Attendance("*", ['a.attendance_id' => $array_id, 'a.device_id' => $device_sn])->getResult();
                        // exit(print_r($att_exist));
                        if (!$att_exist) {
                            $attendance_data_exist = $this->Attendance->select_Attendance("*", ['a.userid' => $userid, 'a.date =' => $date])->getResult();
                            // exit(print_r($attendance_data_exist));
                            $attendance_id = null;
                            $attendance_check = null;
                            if (!empty($attendance_data_exist)) {
                                $attendance_check = $attendance_data_exist[0];
                                $attendance_id = $attendance_check->attendance_id;
                            } else {
                                $attendance_check = (object) [
                                    'check_in' => null,
                                    'check_in2' => null
                                ];
                            }

                            $attendancedata = $attendance[$array_id];
                            $status = $attendancedata[2] == 14 ? 'Check Out' : 'Check In';
                            $data = [
                                'userid' => $attendancedata[0],
                                'attendance_id' => $array_id,
                                'device_id' => $device_sn,
                                'id' => $attendancedata[1],
                                'status' => $status,
                                'date' => date('Y-m-d', strtotime($attendancedata[3]))
                            ];

                            if ($schedule_2 === null) {
                                if ($attendance_check === null || !is_object($attendance_check) || $attendance_check->check_in === null) {
                                    $data['check_in'] = $attendancedata[3];
                                    // exit(print_r($data));

                                    $result = $this->Attendance->create_Attendance($data);
                                } else if ($attendance_check->check_in != null) {
                                    echo '<br> updating' . '<br>';
                                    print_r($row);
                                    if (strtotime($attendancedata[3]) > strtotime($attendance_check->check_in)) {
                                        echo '<br> checkout <br>';
                                        $index = $attendance_check->index;
                                        $data = [
                                            'check_out' => $attendancedata[3],
                                            'index' => $index,
                                            'attendance_id' => $array_id,
                                        ];
                                        $result = $this->Attendance->update_Attendance($data);
                                    } else {
                                        echo '<br> not added or updated <br>';
                                    }
                                }
                            } else {
                                if (date('h:i:s', strtotime($attendancedata[3])) >= $schedule_2checkin_timestamp) {
                                    if ($attendance_check === null || !is_object($attendance_check) || $attendance_check->check_in === null) {
                                        $data['check_in'] = $attendancedata[3];
                                        $result = $this->Attendance->create_Attendance($data);
                                    } else {
                                        $index = $attendance_check->index;
                                        $data = [
                                            'check_out' => $attendancedata[3],
                                            'attendance_id' => $array_id,
                                            'index' => $index
                                        ];
                                        $result = $this->Attendance->update_Attendance($data);
                                    }
                                } else {
                                    if ($attendance_check->check_in != null) {
                                        if ($attendance_check->check_in2 === null) {
                                            $index = $attendance_check->index;
                                            $data = [
                                                'check_in2' => $attendancedata[3],
                                                'attendance_id' => $array_id,
                                                'index' =>  $index
                                            ];
                                            $result = $this->Attendance->update_Attendance($data);
                                        } else {
                                            $index = $attendance_check->index;
                                            $data = [
                                                'check_out2' => $attendancedata[3],
                                                'attendance_id' => $array_id,
                                                'index' => $index
                                            ];
                                            $result = $this->Attendance->update_Attendance($data);
                                        }
                                    } else {
                                        if ($attendance_check === null || !is_object($attendance_check) || $attendance_check->check_in2 === null) {
                                            $data['check_in2'] = $attendancedata[3];
                                            $result = $this->Attendance->create_Attendance($data);
                                        } else {
                                            $index = $attendance_check->index;
                                            $data = [
                                                'check_out2' => $attendancedata[3],
                                                'attendance_id' => $array_id,
                                                'index' =>  $index
                                            ];
                                            $result = $this->Attendance->update_Attendance($data);
                                        }
                                    }
                                }
                            }
                        }
                        if ($array_id > $perPage * $page) {
                            // echo  $array_id . '<br>';
                            break;
                        }
                    }
                    $zk->disconnect();
                }
            }
        } catch (Exception $e) {
            exit('abcd');
            exit(print_r($e));
        }
    }
    public function attendance_data_check()
    {
        try {
            $zk = new ZKLib("112.133.223.163", 4371);
            $zk->connect();
            if ($zk) :
                $attendance = $zk->getAttendance();
                $zk->disconnect();
                foreach ($attendance as $array_id => $row) {
                    $userid = $row[0];
                    $date = date('Y-m-d', strtotime($row[3]));
                    $attendance_data_exist = $this->Attendance->select_Attendance("*", ['a.userid' => $userid, 'a.date =' => $date])->getResult();
                    if ($attendance_data_exist) {
                        echo 'Exist Data for user ID: ' . $userid . ' on date: ' . $date . '<br>';
                    } else {
                        echo 'Not exist for user ID: ' . $userid . ' on date: ' . $date . '<br>';
                    }
                }
            endif;
        } catch (Exception $e) {
            exit('abcd');
            exit(print_r($e));
        }
    }
}
