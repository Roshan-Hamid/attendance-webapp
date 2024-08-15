<?php

namespace App\Controllers;

class Branches extends BaseController{

    public function __construct()
    {
        ini_set('max_execution_time', 5000);
        ini_set("memory_limit", "-1");
        date_default_timezone_set('Asia/Kolkata');
        $this->session = \Config\Services::session();
        $this->data['folder'] = 'Branches';
        $this->Devices = model('Devices_model');
        $this->Branch = model('Branch_model');

    }


    public function index()
    {   
        $userRole = $this->session->get('user_role');
        if ($userRole === 'admin' || $userRole === 'manager') {
             $this->data['page'] = 'Branches_list';
            return view('Index', $this->data);
        }else {
            return redirect()->to('/'); 
        }
        
    }
    public function DropdownData() {
        $json_data = array();
        $j = 0;
        $data = array();
        $result = $this->Branch->select_Branches("*", $data);
        $result_array = $result->getResult();
        foreach ($result_array as $row) :
            $array[$j][] = $row->branch_id;
            $array[$j][] = $row->branch_name;
        endforeach;
        $json_data['data'] = $array;
        echo json_encode($array);
            
    }


    
    public function select_Branch(){

        $json_data=array();
        $j=0;

        $data=array();
        $userRole = $this->session->get('user_role');
        if ($userRole === 'admin') {
           
            $branch = $this->Branch->select_Branches("*",$data);
            $branch_array = $branch->getResult();

            $json_data['recordsTotal'] = count($branch_array);
            $json_data['recordsFiltered'] = count($branch_array);
            $array=array();
            $html_content = '';

            foreach($branch_array as $row){

                $html_content .= '
                <div class="col-xl-6">
                    <div class="card card-hover card-custom">
                        <div class="card-body  pt-7 togglefiter"  id="'.$row->branch_id.'"location="'.$row->location.'"branch_name="'.$row->branch_name.'"onclick="GetScheduleId()">
                            <div class="d-flex"data-bs-toggle="offcanvas" href="#offcanvasScrolling" role="button" aria-controls="offcanvasScrolling">
                                <div class="symbol symbol-60px symbol-circle px-3">
                                    <span class="symbol-label bg-light-danger text-danger fs-5 fw-bolder">'. strtoupper(substr($row->branch_name, 0, 1)) .'</span>
                                </div>
                                <div class="d-flex align-items-center flex-wrap flex-grow-1 mt-n2 mt-lg-n1">
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
                                        <a href="#" class="fs-2 text-gray-800 text-uppercase text-hover-primary fw-bold branch_name" id="' . $row->branch_name . '">' . $row->branch_name . '</a>
                                        <span class="text-gray-500 fw-semibold text-capitalize fs-7 my-1 location" id="' . $row->location . '">' . $row->location . '</span>
                                    </div>
                                    <div class="text-end py-lg-0 py-2">
                                        <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                            <i class="ki-outline ki-black-right fs-2 text-gray-500"></i>
                                        </a>
                                        <span class="text-gray-500 fs-7 fw-semibold d-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }

            // Output the HTML content
            $array[$j][] = '<div class="container"><div class="row g-5 g-xl-8">' . $html_content . '</div></div>';
            $json_data['data']=$array;
            echo json_encode($json_data);
        }elseif (($userRole === 'manager')) {

                $branch_id = $this->session->get('branch_id');
                if (isset($branch_id) && $branch_id != '')  {
                    $branch_ids = json_decode($branch_id, true); 
                }
            
            $branch = $this->Branch->select_Branches("*", $data);
            $branch_array = $branch->getResult();

            $array=array();
            $html_content = '';

            foreach($branch_array as $row){
                
                $branch_id ='';
                $branch_name ='';
                $location ='';
                if (in_array($row->branch_id, $branch_ids)) {
                    $branch_id = $row->branch_id;
                    $branch_name = $row->branch_name;
                    $location = $row->location;
                }
                if (!empty($branch_id) && !empty($branch_name) && !empty($location)) {
                $html_content .= '
                <div class="col-xl-6">
                    <div class="card card-hover card-custom">
                        <div class="card-body  pt-7 togglefiter"  id="'. $branch_id.'"location="'.$location.'"branch_name="'.$branch_name.'"onclick="GetScheduleId()">
                            <div class="d-flex"data-bs-toggle="offcanvas" href="#offcanvasScrolling" role="button" aria-controls="offcanvasScrolling">
                                <div class="symbol symbol-60px symbol-circle px-3">
                                    <span class="symbol-label bg-light-danger text-danger fs-5 fw-bolder">'. strtoupper(substr($branch_name, 0, 1)) .'</span>
                                </div>
                                <div class="d-flex align-items-center flex-wrap flex-grow-1 mt-n2 mt-lg-n1">
                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
                                        <a href="#" class="fs-2 text-gray-800 text-uppercase text-hover-primary fw-bold branch_name" id="' . $branch_name . '">' . $branch_name . '</a>
                                        <span class="text-gray-500 fw-semibold text-capitalize fs-7 my-1 location" id="' . $location . '">' . $location . '</span>
                                    </div>
                                    <div class="text-end py-lg-0 py-2">
                                        <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                            <i class="ki-outline ki-black-right fs-2 text-gray-500"></i>
                                        </a>
                                        <span class="text-gray-500 fs-7 fw-semibold d-block"></span>
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
    }


    
    public function select_Devices(){

        $json_data=array();
        $j=0;

        $data=array();
        
        if (isset($_POST['id']) && $_POST['id'] != '' ) {
            $data['d.branch_id ='] = ($_POST['id']);
        }

        // $result = $this->Branch->select_Branches("*",$data);

        $device = $this->Devices->select_Devices("*",$data);
        $device_array = $device->getResult();

        $json_data['recordsTotal'] = count($device_array);
        $json_data['recordsFiltered'] = count($device_array);
        $array=array();


        foreach($device_array as $row):


            if($this->session->get('user_role')=='admin'){ 

                $btn_edit = '<button data-bs-toggle="modal" data-bs-target="#material_edit_modal" id="material_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="fas fa-edit"></i> </button>';

                $btn_delete = '<button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" id="material_delete_btn" data-bs-target="#material_delete_modal"> <i class="fas fa-trash"></i>   </button>';

            } else{
                $btn_edit = $btn_delete = '';
            }

            $array[$j][] = '
                <div class="d-flex align-items-sm-center pt-5 mb-7">
                    <div class="symbol symbol-60px me-4">
                        <img class="img-thumbnail" src="'.base_url().'assets1/media/stock/600x400/punch.jpg"></div>
                        <div class="d-flex flex-row-fluid align-items-center flex-wrap my-lg-0 me-2">
                            <div class="flex-grow-1 my-lg-0 my-2 me-2">
                                <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">' . $row->device_id . '</a>
                                <span class="text-muted fw-semibold d-block pt-1">'.$row->ip .' : '.$row->port.'</span>
                                <span class="text-muted fw-semibold d-block pt-1">'.$row->name.'</span>
                            </div>
                            <div class="d-flex align-items-end mx-20">
                                <a class="btn btn-icon btn-light btn-sm border-0 edit_btn  mx-1" deviceid="'.$row->device_id.'" ip="'.$row->ip.'" device_port="'.$row->port.'" device_name="'.$row->name.'" data-bs-toggle="modal" data-bs-target="#edit_device_modal">
                                    <i class="ki-outline ki-pencil text-primary mx-10"></i>
                                </a>
                                <a class="btn btn-icon btn-light btn-sm border-0 delete_btn mx-1"trashitem="'.$row->device_id.'" data-bs-toggle="modal" data-bs-target="#device_delete_modal">
                                    <i class="ki-solid ki-trash text-primary mx-10"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>';
        
            $j++;
        endforeach;

        $json_data['data']=$array;
        echo json_encode($json_data);
    }

    public function select_schedule(){

        $json_data=array();
        $j=0;

        $data=array();
        
        if (isset($_POST['id']) && $_POST['id'] != '' ) {
            $data['b.branch_id ='] = ($_POST['id']);
        }

        $branch = $this->Branch->select_Branches("*",$data);
        $branch_array = $branch->getResult();

        $array=array();

        foreach ($branch_array as $row):

                // Decode JSON schedule data
                $schedule_1 = json_decode($row->schedule_1, true);
                $schedule_2 = json_decode($row->schedule_2, true);
        
                // Extract schedule_1 details
                $Checkin_a = isset($schedule_1['checkin']) ? $schedule_1['checkin'] : '';
                $checkout_a = isset($schedule_1['checkout']) ? $schedule_1['checkout'] : '';
                $break_a = isset($schedule_1['break']) ? $schedule_1['break'] : '';
                // Extract schedule_2 details
                $Checkin_b = isset($schedule_2['checkin']) ? $schedule_2['checkin'] : '';
                $checkout_b = isset($schedule_2['checkout']) ? $schedule_2['checkout'] : '';
                $break_b = isset($schedule_2['break']) ? $schedule_2['break'] : '';
        
                 // Build HTML content for schedule 1
                $html_schedule_1 = '
                <div class="col-xl-12">
                    <div class="card card-hover card-custom">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="symbol symbol-20px symbol-circle px-3">
                                    <span class="symbol-label text-info fs-3 fw-bolder"><b>1</b></span>
                                </div>
                                <div class="d-flex flex-row-fluid align-items-center flex-wrap my-lg-0 me-2">
                                    <div class="flex-grow-1 my-lg-0 me-2 timepick"" checkin="'. $Checkin_a .'" checkout="'. $checkout_a .'" breaktime="'. $break_a .'">
                                        <span class="text-gray-500 fw-bold text-hover-primary fs-6">Check In: ' . $Checkin_a . '</span><br>
                                        <span class="text-gray-500 fw-bold text-hover-primary fs-6">Check Out: ' . $checkout_a . '</span><br>
                                        <span class="text-gray-500 fw-bold text-hover-primary fs-6">Break: ' . $break_a . '</span><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                

            // Build HTML content for schedule 2 if values exist
            $html_schedule_2 = '';
            if (!empty($Checkin_b) || !empty($checkout_b) || !empty($break_b)) {
                $html_schedule_2 = '
                    <div class="col-xl-12 pt-3">
                        <div class="card card-hover card-custom">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="symbol symbol-20px symbol-circle px-3">
                                        <span class="symbol-label text-info fs-3 fw-bolder">2</span>
                                    </div>
                                    <div class="d-flex flex-row-fluid align-items-center flex-wrap my-lg-0 me-2">
                                        <div class="flex-grow-1 my-lg-0 me-2 timepick2"checkin2="'. $Checkin_b .'" checkout2="'. $checkout_b .'" breaktime2="'. $break_b .'">
                                            <span class="text-gray-500 fw-bold text-hover-primary fs-6">Check In: ' . $Checkin_b . '</span><br>
                                            <span class="text-gray-500 fw-bold text-hover-primary fs-6">Check Out: ' . $checkout_b . '</span><br>
                                            <span class="text-gray-500 fw-bold text-hover-primary fs-6">Break: ' . $break_b . '</span><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
            }

            // Add HTML content to the array
            $array[$j][] = $html_schedule_1 . $html_schedule_2;

            $j++;
            endforeach;
        $json_data['data']=$array;
        echo json_encode($json_data);
    }




    public function create_branch()
    {   
        $branch_name = $this->request->getPost('branch_name');
        $branch_location = $this->request->getPost('branch_location');
        $schedule_1 =  '{"checkin": "9:30","checkout": "16:30", "break": "1:00"}';
    
        $data = [
            'branch_name' => $branch_name,
            'location' => $branch_location,
            'schedule_1'=>$schedule_1
        ];
    
        $branch = $this->Branch->create_Branches($data);
        if ($branch['status'] == 1) {
            // Create JSON response for success
            $response = [
                "success" => true,
                "branch_name" => $branch_name
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
    
    public function create_device()
    {   
      
            $device_id = $this->request->getPost('device_id');
            $branch_id = $this->request->getPost('branch_id');
            $device_ip = $this->request->getPost('device_ip');
            $port = $this->request->getPost('port');
            $device_name = $this->request->getPost('device_name');

                $data = [
                    'device_id' => $device_id,
                    'name' => $device_name,
                    'branch_id'=> $branch_id,
                    'ip'=> $device_ip,
                    'port'=> $port
                ];

    

            $device = $this->Devices->create_Devices($data);
         
            if ($device['status'] == 1) {
                // Create JSON response for success
                $response = [
                    "success" => true,
                    "device_name" => $device_name
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


    public function update_branch()
    {   

        $data['branch_name'] = $data2['b.branch_name'] = $this->request->getPost('branch_name');
        $data['branch_id'] = $data2['b.branch_id !='] = $this->request->getPost('branch_id_edit');
       
        $count = count($this->Branch->select_Branches('*', $data2)->getResult());
        if($count==0){

            $branch_name = $this->request->getPost('branch_name', FILTER_SANITIZE_STRING);
            $location = $this->request->getPost('branch_location_edit', FILTER_SANITIZE_STRING);
            $branch_id = $this->request->getPost('branch_id_edit', FILTER_SANITIZE_STRING);

            $data = [
                'branch_name' => $branch_name,
                'location' => $location,
                'branch_id' => $branch_id,
            ];

            $branch = $this->Branch->update_Branches($data);
            if ($branch== 1) {
                // Create JSON response for success
                $response = [
                    "success" => true,
                    "branch_name" => $branch_name
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
    public function update_device()
    {   

        $data['name'] = $data2['d.name'] = $this->request->getPost('device_name');
        $data['device_id'] = $data2['d.device_id !='] = $this->request->getPost('device_id');
       
        $count = count($this->Devices->select_Devices('*', $data2)->getResult());
        if($count==0){

            $device_name = $this->request->getPost('device_name', FILTER_SANITIZE_STRING);
            $device_id = $this->request->getPost('device_id', FILTER_SANITIZE_STRING);
            $device_ip = $this->request->getPost('device_ip', FILTER_SANITIZE_STRING);
            $port = $this->request->getPost('port');

            $data = [
                'device_id' => $device_id,
                'ip' => $device_ip,
                'name' => $device_name,
                'port' => $port
            ];
            $device = $this->Devices->update_Devices($data);
            if ($device== 1) {
                // Create JSON response for success
                $response = [
                    "success" => true,
                    "device_name" => $device_name
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

    public function update_schedule()
    {   

        $data['branch_name'] = $data2['b.branch_name'] = $this->request->getPost('schedule_branch_name');
        $data2['b.branch_id!='] = $this->request->getPost('branch_id');
       
        $count = count($this->Branch->select_Branches('*', $data2)->getResult());
        if($count==0){
            $branch_id = $this->request->getPost('branch_id');
           // Get data from POST request
            $checkin_a = $this->request->getPost('start_timepicker', FILTER_SANITIZE_STRING);
            $checkout_a = $this->request->getPost('end_timepicker', FILTER_SANITIZE_STRING);
            $break_time_a = $this->request->getPost('break_timepicker', FILTER_SANITIZE_STRING);

            $checkin_b = $this->request->getPost('schedule_b_start_timepicker', FILTER_SANITIZE_STRING);
            $checkout_b = $this->request->getPost('schedule_b_end_timepicker', FILTER_SANITIZE_STRING);
            $break_time_b = $this->request->getPost('schedule_b_break_timepicker', FILTER_SANITIZE_STRING);

            // Create an associative array
            $schedule_1 = array(
                'checkin' => $checkin_a,
                'checkout' => $checkout_a,
                'break' => $break_time_a
            );
            // Check if schedule_2 is not empty
            if (!empty($checkin_b) && !empty($checkout_b) && !empty($break_time_b)) {
                $schedule_2 = array(
                    'checkin' => $checkin_b,
                    'checkout' => $checkout_b,
                    'break' => $break_time_b
                );
            } else {
                $schedule_2 = null; // Set schedule_2 to null if it's empty
            }

            // Convert the array to JSON
            $schedule_1_json = json_encode($schedule_1);
            $schedule_2_json = json_encode($schedule_2);
            $data = [
                'schedule_1' => $schedule_1_json,
                'schedule_2' => $schedule_2_json,
                'branch_id' => $branch_id
            ];

            // Assign the JSON string to the data array
         
            $branch = $this->Branch->update_Branches($data);
            if ($branch== 1) {
                // Create JSON response for success
                $response = [
                    "success" => true,
                    "schedule_1" => $schedule_1,
                    "schedule_2" => $schedule_2
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
        }else{
            $response = [
                "success" => false,
                "message" => "Sorry.. Schedule already exists !. please change Schedule !..."
            ];
            // Return JSON response
            return $this->response->setJSON($response);
        }

       

    }

    public function delete_branch()
    {   
        $data['branch_id'] = $this->request->getPost('branch_id_delete', FILTER_SANITIZE_STRING);
        
        $data['delete_status'] = 1;

        $branch = $this->Branch->update_Branches($data);
        if($branch==1){
            echo '<script>alert("Branch Deleted Successfully!");</script>';
            echo '<script>window.location.replace("/Branches");</script>';
        }else{
            echo '<script>alert("Sorry.. There Have been Some Error Occurred. Please Try Again!");</script>';
            echo '<script>window.location.replace("/Branches");</script>';
        }
    }



    public function delete_device()
    {   
        $data['device_id'] = $this->request->getPost('trash_id', FILTER_SANITIZE_STRING);
        
        $data['delete_status'] = 1;

        $device = $this->Devices->update_Devices($data);
        if ($device== 1) {
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

    
}
