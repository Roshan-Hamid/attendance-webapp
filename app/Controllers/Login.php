<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User_model;
use App\Models\Settings_model;
use CodeIgniter\Config\Services;
class Login extends BaseController {
	function __construct()
	{
		ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');
		$this->session = Services::session();
		$this->User = new User_model();
		$this->Settings = new Settings_model();
		$this->Settings = model('Settings_model');
		$this->validation = \Config\Services::validation();
		// $maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		// if($maintanance_mode==1){
		// 	redirect(base_url().'maintanance', 'refresh');
		// }
	}

	public function index()
	{
		// header("Access-Control-Allow-Origin: *");
		// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
		
		$session = \Config\Services::session();
		if (!empty($session->get('user_id'))) {
			// return redirect(base_url().'dashboard', 'refresh');
			// header('Refresh: 0;url=' . base_url('dashboard'));
			return redirect()->to(base_url('dashboard'));
		} else {
			return view('login');
		}
	}

	// public function logout() {
	// 	$this->session->sess_destroy();
	// 	redirect(base_url().'login', 'refresh');
	// }
	public function logout()
	{
    session()->destroy();
    return redirect()->to(base_url('login'));
	}	

	// public function login_process()
	// {
	// 	$data['username'] = $this->request->getPost('username', FILTER_SANITIZE_STRING);
	// 	// $data['username'] = $this->security->xss_clean($this->input->post('username'));
	// 	$data['password'] = $this->request->getPost('password', FILTER_SANITIZE_STRING);
		
	// 	$user_data =$this->User->select_user("*",$data);

	// 	if($user_data->num_rows()==1){ 
	// 		$row = $user_data->row(); 

	// 		if($row->block_status==0){
				
	// 			$session_data['user_name'] = $row->username;
	// 			$session_data['password'] = $row->password;
	// 			$session_data['user_full_name'] = $row->name;
	// 			$session_data['user_id'] = $row->user_id;
	// 			$session_data['user_role'] = $row->role;
	// 			$session_data['role_name'] = $row->role_name;
	// 			$session_data['user_role_id'] = $row->role_id;

	// 			$array['status'] = 1;	
	// 			$this->session->set_userdata($session_data);
				

	// 		}
	// 		else{
	// 			$array['status'] = 2;
	// 		}
	// 	}else{
	// 		$array['status'] = 0;
	// 	}

	// 	echo json_encode($array);
	// }

	public function login_process()
{
    $data['username'] = $this->request->getPost('username', FILTER_SANITIZE_STRING);
    $data['password'] = $this->request->getPost('password', FILTER_SANITIZE_STRING);

    
    $user_data = $this->User->select_user("*", $data); 

    if (count($user_data)== 1) { 
        $row = $user_data[0];
	
        if ($row->block_status == 0) {
            // Store only necessary user information in the session
            $session_data = [
                'user_name' => $row->username,
                'password' => $row->password,
                'user_full_name' => $row->name,
                'user_id' => $row->user_id,
                'user_role' => $row->role,
                'role_name' => $row->role_name,
                'user_role_id' => $row->role_id,
				'branch_id' => $row->branch_id,
            ];

            $array['status'] = 1;    
            $this->session->set($session_data);
        } else {
            $array['status'] = 2;
        }
    } else {
        $array['status'] = 0; 
    }

    $this->response->setHeader('Content-Type', 'application/json');
    echo json_encode($array);
}

}
