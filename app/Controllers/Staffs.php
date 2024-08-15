<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use App\Libraries\ZKLib\ZKLib;
class Staffs extends BaseController
{

    public function __construct()
    {
        ini_set('max_execution_time', 5000);
        ini_set("memory_limit", "-1");
        date_default_timezone_set('Asia/Kolkata');
        $this->session = \Config\Services::session();
        $this->data['folder'] = 'Staffs';
        $this->Attendance = model('Attendance_model');
		$this->Staffs = model('Staffs_model');
        $this->Devices = model('Devices_model');
        $this->Branch = model('Branch_model');
        include(APPPATH . "Libraries/zklib/zklib.php");
      
    }


    public function index()
    {
        $userRole = $this->session->get('user_role');
        if ($userRole === 'admin' || $userRole === 'manager') {
            $this->data['page'] = 'Staff_list';
            return view('Index', $this->data);
        }else {
            return redirect()->to('/'); 
        }
    }
    public function DropdownData() {
        $json_data = array();
        $j = 0;
        $data = array();
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

            }elseif($userRole === 'manager') {
                $branch_id = $this->session->get('branch_id');
                if (isset($branch_id) && $branch_id != '')  {
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

    public function select_Staffs()
    {

        $json_data = array();
        $j = 0;

        $data = array();
        $userRole = $this->session->get('user_role');
        if ($userRole === 'manager') {
            $branch_id = $this->session->get('branch_id');
            if (isset($branch_id) && $branch_id != '')  {
                $branch_ids = json_decode($branch_id, true); 

                $branch = $this->Branch->select_Branches("*", $data);
                $branch_array = $branch->getResult();
                foreach ($branch_array as $row) :
                    if (in_array($row->branch_id, $branch_ids)) {
                        $branch_id = $row->branch_id;
                    }
                endforeach;
                $data['s.branch_id ='] = $branch_id;
            }
            if (isset($_POST['branch_filter']) && $_POST['branch_filter'] != '' ) {
                $data['s.branch_id ='] = $_POST['branch_filter'];
            }

            $staffs = $this->Staffs->select_Staffs("*", $data);
            $staffs_array = $staffs->getResult();

            $json_data['recordsTotal'] = count($staffs_array);
            $json_data['recordsFiltered'] = count($staffs_array);
            $array = array();

            $html_content = '';

            foreach ($staffs_array as $row) {
                // Start building the HTML content for each row
                
                $html_content .= '
                <div class="col-xl-6">
                    <div class="card card-hover card-custom">
                        <div class="card-body  pt-7 datafilter">
                            <div class="d-flex">
                                <div class="symbol symbol-60px symbol-circle px-3">
                                    <span class="symbol-label bg-light-danger text-danger fs-5 fw-bolder">' . strtoupper(substr($row->name, 0, 1)) . '</span>
                                </div>
                                <div class="d-flex align-items-center flex-wrap flex-grow-1 mt-n2 mt-lg-n1">
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
                                        <a href="'. base_url().'Staffs/Profile?uid=' . urlencode($row->uid) . '&userid=' . urlencode($row->userid) . '" class="fs-2 text-gray-800 text-uppercase text-hover-primary fw-bold staffname" id="' . $row->name . '">' . $row->name . '<span class="badge badge-light-success text-wrap fw-bold fs-8 px-2 py-1 ms-2">' . $row->status . '</span></a>
                                        <span class="text-gray-500 fw-semibold text-capitalize fs-7 my-1 userid" id="' . $row->userid . '">' . $row->userid . '</span>
                                    </div>
                                    <div class="d-flex justify-content-end flex-shrink-0">                                    
                                        <a  href="'. base_url().'Report?uid=' . urlencode($row->uid) . '&userid=' . urlencode($row->userid) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"> <i class="bi bi-file-earmark-post fs-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }

            // Output the HTML content
            $array[$j][] = '<div class="container"><div class="row g-5 g-xl-8">' . $html_content . '</div></div>';

            $json_data['data'] = $array;
            echo json_encode($json_data);

        }elseif($userRole === 'admin') {
        
            if (isset($_POST['branch_filter']) && $_POST['branch_filter'] != '' ) {
                $data['s.branch_id ='] = $_POST['branch_filter'];
            }

            $staffs = $this->Staffs->select_Staffs("*", $data);
            $staffs_array = $staffs->getResult();

            $json_data['draw'] = 5;
            $json_data['recordsTotal'] = count($staffs_array);
            $json_data['recordsFiltered'] = count($staffs_array);
            $array = array();

            $html_content = '';

            foreach ($staffs_array as $row) {
                // Start building the HTML content for each row

                $html_content .= '
                <div class="col-xl-6">
                    <div class="card card-hover card-custom">
                        <div class="card-body  pt-7 datafilter">
                            <div class="d-flex">
                                <div class="symbol symbol-60px symbol-circle px-3">
                                    <span class="symbol-label bg-light-danger text-danger fs-5 fw-bolder">' . strtoupper(substr($row->name, 0, 1)) . '</span>
                                </div>
                                <div class="d-flex align-items-center flex-wrap flex-grow-1 mt-n2 mt-lg-n1">
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
                                        <a href="'. base_url().'Staffs/Profile?uid=' . urlencode($row->uid) . '&userid=' . urlencode($row->userid) . '" class="fs-2 text-gray-800 text-uppercase text-hover-primary fw-bold staffname" id="' . $row->name . '">' . $row->name . '<span class="badge badge-light-success text-wrap fw-bold fs-8 px-2 py-1 ms-2">' . $row->status . '</span></a>
                                        <span class="text-gray-500 fw-semibold text-capitalize fs-7 my-1 userid" id="' . $row->userid . '">' . $row->userid . '</span>
                                    </div>
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        <a  href="'. base_url().'Report?uid=' . urlencode($row->uid) . '&userid=' . urlencode($row->userid) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"> <i class="bi bi-file-earmark-post fs-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }

            // Output the HTML content
            $array[$j][] = '<div class="container"><div class="row g-5 g-xl-8">' . $html_content . '</div></div>';
            $json_data['data'] = $array;
            echo json_encode($json_data);
        }

    }


    public function create(){   
   
        $name = $this->request->getPost('name');

        $branch = $this->request->getPost('branch_id');
        $uid = $this->request->getPost('uid');
        $user_id = $this->request->getPost('userid');

        $status = $this->request->getPost('Status_unit');

        $sanitizedName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

  
        $data = [
            'name' => $sanitizedName,
            'branch_id' => $branch,
            'uid' =>$uid,
            'userid' => $user_id,
            'status' => $status,
        ];

        $staffs = $this->Staffs->create_Staffs($data);

        if ($staffs['status'] == 1) {
            // Create JSON response for success
            $response = [
                "success" => true,
                "staff" => $sanitizedName
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

    public function update()
    {   

        $data['name'] = $data2['s.name'] = $this->request->getPost('name_edit', FILTER_SANITIZE_STRING);
        $data['id'] = $data2['s.id !='] = $this->request->getPost('id', FILTER_SANITIZE_STRING);
       
        $count = count($this->Staffs->select_Staffs('*', $data2)->getResult());
        if($count==0){
            $id = $this->request->getPost('id', FILTER_SANITIZE_STRING);
            $name_edit = $this->request->getPost('name_edit', FILTER_SANITIZE_STRING);
            $branch_edit = $this->request->getPost('branch_edit', FILTER_SANITIZE_STRING);
            $userid_edit = $this->request->getPost('userid_edit', FILTER_SANITIZE_STRING);
            $uid_edit = $this->request->getPost('uid_edit', FILTER_SANITIZE_STRING);
            $Status_unit_edit = $this->request->getPost('Status_unit_edit', FILTER_SANITIZE_STRING);

            $data = [
                'name' => $name_edit,
                'branch_id' => $branch_edit,
                'userid' => $userid_edit,
                'uid' => $uid_edit,
                'status' => $Status_unit_edit,
                'id' => $id
            ];

            $staff = $this->Staffs->update_Staffs($data);
            if ($staff== 1) {
                // Create JSON response for success
                $response = [
                    "success" => true,
                    "staff" => $name_edit
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

    public function delete()
    {
        $data['id'] = $this->request->getPost('id');
        $data['delete_status'] = 1;
        $staffs = $this->Staffs->update_Staffs($data);
        if ($staffs== 1) {
            $response = [
                "success" => true,
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

    
    public function Profile()
    {   
        if (isset($_GET['uid']) && isset($_GET['userid'])!= '') {
            $json_data = array();
            $j = 0;
            $data = array();
            $userid = $_GET['userid'] ?? null;
            $data['s.userid ='] = $userid;
            $staffs = $this->Staffs->select_Staffs("*", $data);
            $staff = @$staffs->getResult()[0];
            $this->data['staff'] = $staff;
        }
        $userRole = $this->session->get('user_role');
        // echo $userRole;
        if ($userRole === 'admin' || $userRole === 'manager') {
        $this->data['page'] = 'staff_profile';

        return view('Index', $this->data);
        }else {
            return redirect()->to('/dashboard'); 
        }
    }
    public function Device_settings()
    {   
        if (isset($_GET['uid']) && isset($_GET['userid'])!= '') {
            $json_data = array();
            $j = 0;
            $data = array();
            $userid = $_GET['userid'] ?? null;
            $data['s.userid ='] = $userid;
            $staffs = $this->Staffs->select_Staffs("*", $data);
            $staff = @$staffs->getResult()[0];
            $this->data['staff'] = $staff;
            // $this->staffData = $staff; // Store staff data in class property
        }

        $userRole = $this->session->get('user_role');
        if ($userRole === 'admin' || $userRole === 'manager') {
        $this->data['page'] = 'Device_settings';
        return view('Index', $this->data);
        }else {
            return redirect()->to('/dashboard'); 
        }

    }

    public function select_Devices(){

    $json_data = array();
    $j = 0;
    $data = array();

    if (isset($_POST['userid']) && $_POST['userid'] != '' ) {
        $data['s.userid ='] = $_POST['userid'];
    }    
    $staffs = $this->Staffs->select_Staffs("*", $data);
    $staff = $staffs->getResult();  
    $device_ids = [];
    foreach($staff as $row){
        $device_idjson = $row->device_id;
        $decoded_device_ids = json_decode($device_idjson, true);
        $device_ids[] = $decoded_device_ids;
    }
  
    $device = $this->Devices->select_Devices("*",$data);
    $device_array = $device->getResult();
    $array=array();
    $html_content = '';
    foreach($device_array as $device){
        $device_id ='';
        $device_name ='';
       
        if (strpos($device_ids[0], ',') !== false) {
            $device_ids_array = explode(',', $device_ids[0]);
            if (in_array($device->device_id, $device_ids_array)) {
                $device_id = $device->device_id;
                $device_name = $device->name;
            }
        } else {
            // If device IDs are single, use in_array directly
            if (in_array($device->device_id, $device_ids)) {
                $device_id = $device->device_id;
                $device_name = $device->name;
            }
        }
        if (!empty($device_id) && !empty($device_name)) {
        $html_content .= '
        <div class="col-xl-6">
            <div class="card card-hover card-custom">
                <div class="card-body  pt-7">
                    <div class="d-flex"data-bs-toggle="offcanvas" href="#offcanvasScrolling" role="button" aria-controls="offcanvasScrolling">
                        <div class="symbol symbol-60px symbol-circle px-3">
                            <img class="img-thumbnail" src="'.base_url().'assets1/media/stock/600x400/punch.jpg">
                        </div>
                        <div class="d-flex align-items-center flex-wrap flex-grow-1 mt-n2 mt-lg-n1">
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
                                <a href="#" class="fs-2 text-gray-800 text-uppercase text-hover-primary fw-bold">' . $device_name . '</a>
                                <span class="text-gray-500 fw-semibold text-capitalize fs-7 my-1">' . $device_id . '</span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
    }
    $array[$j][] = '<div class="container"><div class="row g-5 g-xl-8">' . $html_content . '</div></div>';
    $json_data['data']=$array;
    echo json_encode($json_data);
    }

    public function DeviceDropdownData() {
        $json_data = array();
        $j = 0;
        $data = array();
        if (isset($_POST['branch']) && $_POST['branch'] != '' ) {
            $data['d.branch_id ='] = ($_POST['branch']);
        }
        $device = $this->Devices->select_Devices("*",$data);
        $device_array = $device->getResult();
        foreach ($device_array as $device) :
            $array[$j][] = $device->device_id;
            $array[$j][] = $device->name;     
        endforeach;
        $json_data['data'] = $array;
        echo json_encode($array);
    }

    public function AddDevice() {
        $staff_id = $this->request->getPost('staff_id2');
        // $device_id old device id in staff
        $device_id = $this->request->getPost('device_id');
        $device = $this->request->getPost('device');

       
        // Check if $device exists in $device_id
        if (strpos($device_id, $device) !== false) {
            $response = [
                "success" => false,
                "message" => "Device already exist!"
            ];
            return $this->response->setJSON($response);
        } else {
        // $device does not exist in $device_id
        $data['d.device_id']=$device;
        $selectdevice = $this->Devices->select_Devices("*",$data);
        $device_array = $selectdevice->getResult();
        foreach ($device_array as $indevice) {
            $ip = $indevice->ip;
        }
        $data=array();
        $zk = new ZKLib($ip , 4370);

        $zk->connect();
        if ( $zk ):
        $user = $zk->getUser();
        // exit(print_r($user));

        $data['s.id']=$staff_id;
        $staffs = $this->Staffs->select_Staffs("*",$data);
        $staffs_array = $staffs->getResult();

        foreach ($staffs_array as $row) {
            $userid = $row->userid; 
            $uid = $row->uid; 
            $name = $row->name; 
            $password = $row->password; 
        }

        // $zk->setUser('1', '3132', 'abc', 'password', 0);
        $zk->setUser($uid, $userid, $name, $password, 0);
        $zk->disconnect();
        endif;

        // Check if $device_id is not null
        if ($device_id !== '') {
            // Concatenate $device_id and $device with a comma
            $devices = $device_id . ',' . $device;
        } else {
            // Set $devices to just $device if $device_id is null
            $devices = $device;
        }

        $devicejson = json_encode($devices);
        
        $data = [
            'id' => $staff_id,
            'device_id' => $devicejson,
        ];
        $staff = $this->Staffs->update_Staffs($data);

        if ($staff== 1) {
            // Create JSON response for success
            $response = [
                "success" => true,
                "device" => $device
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
    }
}
