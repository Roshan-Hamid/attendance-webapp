<?php
namespace App\Controllers;


class Manager extends BaseController
{

    public function __construct()
    {
        ini_set('max_execution_time', 5000);
        ini_set("memory_limit", "-1");
        date_default_timezone_set('Asia/Kolkata');
        $this->session = \Config\Services::session();
        $this->data['folder'] = 'Managers';
        $this->Manager = model('Manager_model');
        $this->Devices = model('Devices_model');
        $this->Branch = model('Branch_model');

    }


    public function index()
    {   
        $branches = $this->Branch->select_Branches("*");
        $this->data['branches'] = $branches->getResult();

        $userRole = $this->session->get('user_role');
        if ($userRole === 'admin') {
        $this->data['page'] = 'manager_list';
        return view('Index', $this->data);
        }else {
            return redirect()->to('Dashboard'); 
        }
       
    }
    // public function DropdownData() {
    //     $json_data = array();
    //     $j = 0;
    //     $data = array();
    //     $result = $this->Branch->select_Branches("*", $data);
    //     $result_array = $result->getResult();
    //     foreach ($result_array as $row) :
    //         $array[$j][] = $row->branch_id;
    //         $array[$j][] = $row->branch_name;
    //     endforeach;
    //     $json_data['data'] = $array;
    //     echo json_encode($array);
            
    // }
   

    public function select_manager(){

        $json_data=array();
        $j=0;
        $data=array();

        $managers = $this->Manager->select_manager("*",$data);
        $managers_array = $managers->getResult();

        $branch = $this->Branch->select_Branches("*",$data);
        $branch_array = $branch->getResult();
       

        $html_content = '';

        foreach ($managers_array as $row) {
            $branch_name ='';
                $branch_ids = json_decode($row->branch_id, true); 
                if (is_array($branch_ids)) {
                    $branch_names = [];
                    foreach ($branch_array as $branch) {
                        if (in_array($branch->branch_id, $branch_ids)) {
                            $branch_names[] = $branch->branch_name;
                        }
                    }
                    $branch_name = implode(', ', $branch_names);
                }

            if($this->session->get('user_role')=='admin'){ 

                $btn_edit = '<button data-bs-toggle="modal" data-bs-target="#manager_edit_modal" id="manager_edit_btn" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"> <i class="ki-outline ki-pencil fs-2"></i> </button>';

                $btn_delete = '<button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" id="manager_delete_btn"  data-bs-target="#manager_delete_modal"> <i class="fas fa-trash"></i>   </button>';

            } else{
                $btn_edit = $btn_delete = '';
            }
            // Start building the HTML content for each row

            $html_content .= '
            <div class="col-xl-6">
                <div class="card card-hover card-custom">
                    <div class="card-body  pt-7 datafilter">
                        <div class="d-flex">
                            <div class="d-flex align-items-center flex-wrap flex-grow-1 mt-n2 mt-lg-n1">
                                <div class="symbol symbol-60px symbol-circle px-3">
                                    <span class="symbol-label bg-light-danger text-danger fs-5 fw-bolder">' . strtoupper(substr($row->name, 0, 1)) . '</span>
                                </div>
                                <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
                                    <a href="#" class="fs-2 text-gray-800 text-uppercase text-hover-primary fw-bold staffname" id="' . $row->name . '">' . $row->name . '</a>
                                    <span class="text-gray-500 fw-semibold fs-7 my-1">User Name :' . $row->username . '</span>
                                    <span class="text-gray-500 fw-semibold fs-7 my-1">Password :' . $row->password . '</span>
                                    <span class="fw-bolder text-gray-500 text-xxl-end">Branch :' .   $branch_name .'</span>
                                </div>
                                <div class="d-flex justify-content-end flex-shrink-0">';
                                    if ($this->session->get('user_role') == 'admin') {
                                        // If user role is admin, include edit and delete buttons
                                        $html_content .= '<span class="text-gray-500 fs-8 fw-semibold d-block edit_btn" id="' . $row->user_id . '" managername="' . $row->name . '" username="' . $row->username . '" password="' . $row->password . '"branch_name="' . $branch_name . '">' . $btn_edit . '</span>';
                                        $html_content .= '<span class="text-gray-500 fs-8 fw-semibold d-block delete_btn" id="' . $row->user_id . '">' . $btn_delete . '</span>';
                                    }
                                    $html_content .= '
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
            
    //         $array[$j][]=$j+1;
    //         $array[$j][]=$row->user_id;
    //         $array[$j][]=$row->name;
    //         $array[$j][]=$row->branches;
    //         $array[$j][]=date('d-m-Y h:i:s A',strtotime($row->created_date));
    //         $array[$j][]=$row->username;
    //         $array[$j][]=$row->password;
    //         $array[$j][]=$btn_edit.$btn_delete;

    public function create()
    {   
        $name = $this->request->getPost('name');
        $user_name = $this->request->getPost('user_name');
        $password = $this->request->getPost('password');
        $branch = $this->request->getPost('branch');
        $created_by = $this->session->get('user_role');
        $user_role = '2';
        $branchesjson = json_encode($branch);
        
        $current_date = date('Y-m-d h:i:s');
    
        $sanitizedName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
      
            $data = [
                'name' => $sanitizedName,
                'username' => $user_name,
                'password' => $password,
                'created_by' => $created_by,
                'branch_id' => $branchesjson,
                'user_role'=> $user_role,
                'created_date'=>$current_date,
            ];
    
            $result = $this->Manager->create_manager($data);
    
            if ($result['status'] == 1) {
                // Create JSON response for success
                $response = [
                    "success" => true,
                    "manager" => $sanitizedName
                ];
                return $this->response->setJSON($response);
            } else {
                $response = [
                    "success" => false,
                    "message" => "Sorry.. There Have been Some Error Occurred. Please Try Again!"
                ];
                return $this->response->setJSON($response);
            }
        // }else{
        //     $response = [
        //         "success" => false,
        //         "message" => "Sorry.. User Name already exists !. please change User Name !..."
        //     ];
        //     return $this->response->setJSON($response);
        // }

    }



    public function update()
    {   
       
            $username = $this->request->getPost('user_name_edit', FILTER_SANITIZE_STRING);
            $userId = $this->request->getPost('user_id', FILTER_SANITIZE_STRING);
            $name = $this->request->getPost('name_edit', FILTER_SANITIZE_STRING);
            $password = $this->request->getPost('password_edit', FILTER_SANITIZE_STRING);
            $branchId = $this->request->getPost('branch_name_edit', FILTER_SANITIZE_STRING);
            $branchjson = json_encode($branchId);
         
        $isUsernameExists = $this->Manager->isUsernameExists($username, $userId);

    if (!$isUsernameExists) {
        // Update manager details
        $data = [
            'name' => $name,
            'username' => $username,
            'user_id' => $userId,
            'password' => $password,
            'branch_id' => $branchjson,
            'updated_date' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->get('user_id')
        ];


            $result = $this->Manager->update_manager($data);
            if ($result== 1) {
            $response = [
                "success" => true,
                "manager" => $username
            ];
            return $this->response->setJSON($response);
            } else {
                $response = [
                    "success" => false,
                    "message" => "Sorry.. There Have been Some Error Occurred. Please Try Again!"
                ];
                return $this->response->setJSON($response);
            }

        } else {
            $response = [
             "success" => false,
                "message" => "Sorry.. User Name already exists !. please change User Name !..."
            ];
            return $this->response->setJSON($response);
        }

    }


    public function delete()
    {
        $data['user_id'] = $this->request->getPost('user_id', FILTER_SANITIZE_STRING);
        $data['updated_date'] = date('Y-m-d h:i:s');
        $data['updated_by'] = $this->session->get('user_id');
        $data['delete_status'] = 1;

        

        $result = $this->Manager->update_manager($data);
        if ($result== 1) {
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
