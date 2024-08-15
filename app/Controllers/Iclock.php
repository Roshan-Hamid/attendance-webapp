<?php

namespace App\Controllers;

error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Libraries\ZKLib\ZKLib;
use DateTime;
use Exception;

class Iclock extends BaseController
{

    public function __construct()
    {
        ini_set('max_execution_time', 35000);
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
    public function index()
    {

        if (isset($_SERVER['REQUEST_URI'])) {

            $requestedUri = $_SERVER['REQUEST_URI'];
            $currentDateTime = date('Y-m-d H:i:s');
            $data = [
                'url' =>  $requestedUri,
                'date_time' => $currentDateTime,
            ];
            $result = $this->Iclock->create_url($data);
        }
        exit("OK");
    }
    public function ping()
    {
        if (isset($_SERVER['REQUEST_URI'])) {

            $requestedUri = $_SERVER['REQUEST_URI'];
            $currentDateTime = date('Y-m-d H:i:s');
            $data = [
                'url' =>  $requestedUri,
                "data" => json_encode($_REQUEST),
                'date_time' => $currentDateTime,
            ];
            $result = $this->Iclock->create_url($data);
        }
        exit("OK");
    }
    public function cdata()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $requestedUri = $_SERVER['REQUEST_URI'];
            $currentDateTime = date('Y-m-d H:i:s');
            $data = [
                'url' =>  $requestedUri,
                "data" => json_encode($_REQUEST),
                'date_time' => $currentDateTime,
            ];
            $result = $this->Iclock->create_url($data);
        }
        exit("OK");
    }
    public function getrequest()
    {
        if (isset($_SERVER['REQUEST_URI'])) {

            $requestedUri = $_SERVER['REQUEST_URI'];
            $currentDateTime = date('Y-m-d H:i:s');
            $data = [
                'url' =>  $requestedUri,
                "data" => json_encode($_REQUEST),
                'datetime' => $currentDateTime,
            ];
            $result = $this->Iclock->create_getrequest($data);

            $device_sn = isset($_GET['SN']) ? explode(',', $_GET['SN']) : null;
            $device = $this->Devices->select_Devices("*", ['d.device_id' => $device_sn]);
            $device_array = $device->getResult();
            if (!empty($device_array)) {
                $ip = $device_array[0]->ip;
                $port = $device_array[0]->port;
                $device_info = isset($_GET['INFO']) ? explode(',', $_GET['INFO'])[3] - 1 : null;
                $device_sn = isset($_GET['SN']) ? explode(',', $_GET['SN']) : null;
                $device = $this->Devices->select_Devices("*", ['d.device_id' => $device_sn]);
                $device_array = $device->getResult();

                if ($device_info) {

                    $zk = new ZKLib($ip, $port);
                    // $zk = new ZKLib("112.133.223.163", 4370);
                    // exit(print_r($zk)); 
                    $zk->connect();

                    // sleep(1);
                    if ($zk) {
                        // $zk->disableDevice();



                        if (!empty($device_array)) {
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

                                // exit(print_r('checkin:',$device_info));

                                $attendance = $zk->getAttendance();
                                if ($attendance) {

                                    // exit(print_r($attendance));
                                    $attendancedata = $attendance[$device_info];

                                    $date = date('Y-m-d', strtotime($attendancedata[3]));
                                    $userid = $attendancedata[0];

                                    $attendance_data_exist = $this->Attendance->select_Attendance("*", ['a.userid' => $userid, 'a.date =' => $date])->getResult();
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

                                    if ($device_info != $attendance_id && $device_info > $attendance_id) {

                                        // exit(print_r($attendance_data));
                                        $status = $attendancedata[2] == 14 ? 'Check Out' : 'Check In';
                                        $logdata = [
                                            'userid' => $attendancedata[0],
                                            'device_id' => $device_sn,
                                            'attendance_id' => $device_info,
                                            'uid' => $attendancedata[1],
                                            'status' => $status,
                                            'date' => date('Y-m-d', strtotime($attendancedata[3])),
                                            'timestamp' => $attendancedata[3]
                                        ];
                                        $result = $this->Attendance->create_attendance_log($logdata);


                                        $staff = $this->Staffs->select_Staffs("*", ['s.userid' => $userid]);
                                        $staff = $staff->getResult();
                                        // exit(print_r($staff));
                                        if (empty($staff)) {

                                            try {

                                                $user = $zk->getUser();
                                                // sleep(1);
                                                foreach ($user as $uid => $userdata) {
                                                    if ($userdata[0] == $userid) {

                                                        if ($userdata[2] == LEVEL_ADMIN)
                                                            $role = 'ADMIN';
                                                        elseif ($userdata[2] == LEVEL_USER)
                                                            $role = 'USER';
                                                        else
                                                            $role = 'Unknown';
                                                        $device_id = isset($_GET['SN']) ? $_GET['SN'] : null;
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
                                                            $result = $this->Staffs->insert_Staff($data);
                                                        }
                                                    }
                                                }
                                            } catch (Exception $e) {
                                                // header("HTTP/1.0 404 Not Found");
                                                header('HTTP', true, 200);
                                            }
                                        }



                                        // $data = array();
                                        $status = $attendancedata[2] == 14 ? 'Check Out' : 'Check In';
                                        $data = [
                                            'userid' => $attendancedata[0],
                                            'attendance_id' => $device_info,
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
                                                $index = $attendance_check->index;
                                                $data = [
                                                    'check_out' => $attendancedata[3],
                                                    'index' => $index,
                                                    'attendance_id' => $device_info,
                                                ];
                                                $result = $this->Attendance->update_Attendance($data);
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
                                                        'attendance_id' => $device_info,
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
                                                            'attendance_id' => $device_info,
                                                            'index' =>  $index
                                                        ];
                                                        $result = $this->Attendance->update_Attendance($data);
                                                    } else {
                                                        $index = $attendance_check->index;
                                                        $data = [
                                                            'check_out2' => $attendancedata[3],
                                                            'attendance_id' => $device_info,
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
                                                            'attendance_id' => $device_info,
                                                            'index' =>  $index
                                                        ];
                                                        $result = $this->Attendance->update_Attendance($data);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                $zk->disconnect();
                            }
                            // }

                        }
                    }
                }
                echo 'ok';
            }
        }
    }

    public function testing()
    {
        // echo '<pre>';

        // $device_ip = "112.133.223.163";  // IP address of the ZKTeco device
        // $device_port = 4371;           // Port number of the ZKTeco device

        // Create a UDP socket
        // $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

        // if ($socket === false) {
        //     $error_code = socket_last_error();
        //     $error_message = socket_strerror($error_code);
        //     echo "Socket creation failed: [{$error_code}] {$error_message}\n";
        //     exit(1);
        // }

        // echo "Socket created successfully.\n";

        // Connect to the ZKTeco device
        // Note: UDP is connectionless, so we don't use socket_connect() for UDP
        // Instead, we specify the device address when sending data

        // Send a command to the ZKTeco device (e.g., to get attendance data)
        // $command = "GetAttendanceData"; // This is a sample command, actual commands may vary
        // if (!socket_sendto($socket, $command, strlen($command), 0, $device_ip, $device_port)) {
        //     $error_code = socket_last_error($socket);
        //     $error_message = socket_strerror($error_code);
        //     echo "Socket send failed: [{$error_code}] {$error_message}\n";
        //     socket_close($socket);
        //     exit(1);
        // }

        // echo "Command sent to {$device_ip}:{$device_port}.\n";

        // Receive response from the ZKTeco device
        // $response = "";
        // if (socket_recvfrom($socket, $response, 1024, 0, $device_ip, $device_port) === false) {
        //     $error_code = socket_last_error($socket);
        //     $error_message = socket_strerror($error_code);
        //     echo "Socket receive failed: [{$error_code}] {$error_message}\n";
        //     socket_close($socket);
        //     exit(1);
        // }

        // echo "Received response from {$device_ip}:{$device_port}:\n";
        // echo $response . "\n";

        // Close the socket
        // socket_close($socket);
        // exit('dsfds');
        try {
            // $zk = new ZKLib("112.133.223.163", 4371);
            $zk = new ZKLib("112.133.223.163", 4371);
            // 122.121.131.131
            // exit(print_r($zk));
            $zk->connect();
            // $user = $zk->getUser();
            // $zk->disconnect();
            //  exit(print_r($user));
            // sleep(1);

            if ($zk) :
                // $zk->disableDevice();
                // $user = $zk->getUser();
                // $id = 'IN011303002';
                $attendance = $zk->getAttendance();
                // exit('ok');

                print_r($attendance);
                // $zk->enableDevice();

                // sleep(1);
                $zk->disconnect();

            endif;
        } catch (Exception $e) {
            exit('abcd');
            exit(print_r($e));
        }
        // print_r($user);
    }





    public function data_restore()
    {
        
        try {
            $zk = new ZKLib("112.133.223.163", 4371);
            $zk->connect();
            if ($zk) :
                $attendance = $zk->getAttendance();
                $zk->disconnect();
                $i=0;
                
                foreach ($attendance as $array_id => $row) {
                    $i++;
                    $userid = $row[0];
                    $date = date('Y-m-d', strtotime($row[3]));
                    $attendance_data_exist = $this->Attendance->select_Attendance("*", ['a.userid' => $userid, 'a.date =' => $date])->getResult();
                    if ($attendance_data_exist) {
                        // echo 'Exist Data for user ID: ' . $userid . ' on date: ' . $date . '<br>';
                    } else {
                        // echo 'Not exist for user ID: ' . $userid . ' on date: ' . $date . '<br>';
                        // $device_sn = 'AF4C201460206';
                        $staff = $this->Staffs->select_Staffs("*", ['s.userid' => $userid]);
                        $staff = $staff->getResult();
                        // exit(print_r($staff));
                        if (empty($staff)) {

                            try {

                                $user = $zk->getUser();
                                // sleep(1);
                                foreach ($user as $uid => $userdata) {
                                    if ($userdata[0] == $userid) {

                                        if ($userdata[2] == LEVEL_ADMIN)
                                            $role = 'ADMIN';
                                        elseif ($userdata[2] == LEVEL_USER)
                                            $role = 'USER';
                                        else
                                            $role = 'Unknown';
                                        // $device_id = isset($_GET['SN']) ? $_GET['SN'] : null;
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
                                            $result = $this->Staffs->insert_Staff($data);
                                        }
                                    }
                                }
                            } catch (Exception $e) {
                                // header("HTTP/1.0 404 Not Found");
                                header('HTTP', true, 200);
                            }
                        }
                        $device_sn = 'AF4C201460206';
                        $device = $this->Devices->select_Devices("*", ['d.device_id' => $device_sn]);
                        $device_array = $device->getResult();
                        if (!empty($device_array)) {
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
                        }
                        $attendance_data_exist = $this->Attendance->select_Attendance("*", ['a.userid' => $userid, 'a.date =' => $date])->getResult();
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
                                $index = $attendance_check->index;
                                $data = [
                                    'check_out' => $attendancedata[3],
                                    'index' => $index,
                                    'attendance_id' => $array_id,
                                ];
                                $result = $this->Attendance->update_Attendance($data);
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
                

                    if ($i >= 2500) {
                        break;
                    }
                }

                // print_r($attendance);
            endif;
        } catch (Exception $e) {
            exit('abcd');
            exit(print_r($e));
        }
    }
   
}
