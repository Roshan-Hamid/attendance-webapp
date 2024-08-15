<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User_model;
use App\Models\Settings_model;
use CodeIgniter\Config\Services;

class Dashboard extends BaseController
{

	function __construct()
	{

		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');
		$this->session = Services::session();

		$this->Attendance = model('Attendance_model');
		$this->Staffs = model('Staffs_model');
		$this->User = model('User_model');
		$this->Branch = model('Branch_model');
		$this->Settings = model('Settings_model');

		$maintanance_mode = $this->Settings->select_setting_config('*', array('s.setting_name' => 'maintanance_mode'))->getRow()->value;
		// $maintanance_mode = $this->Settings->select_setting_config('*')->where('s.setting_name', 'maintanance_mode')->get()->getRow()->value;
		if ($maintanance_mode == 1) {
			redirect(base_url() . 'maintanance', 'refresh');
		}


		if ($this->session->get('user_role') == 'developer') {
			redirect(base_url() . 'settings/config', 'refresh');
		}

		$this->data['folder'] = 'dashboard';
	}

	public function index()
	{

		if (empty($this->session->get('user_id'))) {
			session()->destroy();
    		return redirect()->to(base_url('login'));
			// redirect(base_url() . 'login', 'refresh');
		} else {

			// Count the rows
			$this->data['staffs_count'] = $this->Staffs->select_Staffs_count('*')->getNumRows();
			$this->data['branch_count'] = $this->Branch->select_banches_count('*')->getNumRows();
			$users = $this->User->select_user_count('*')->getNumRows();
			$this->data['manager'] = $users - 1;
			$userRole = $this->session->get('user_role');
			if ($userRole === 'admin' || $userRole === 'manager') {
				$this->data['page'] = 'home';
				return view('Index', $this->data);
			} else {
				return redirect()->to('/');
			}
		}
	}

}
