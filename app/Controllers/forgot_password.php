<?php
namespace App\Controllers;
use App\Models\User_model;
use App\Models\Settings_model;
use CodeIgniter\Config\Services;

class Forgot_password extends BaseController {
	function __construct()
	{
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');
		$this->session = Services::session();
		$this->User = new User_model();
		$this->Settings = new Settings_model();
		$this->Settings = model('Settings_model');
		$this->validation = \Config\Services::validation();
	}

	public function index()
	{
        $this->data['page'] = 'reset_password';
        return view('Index', $this->data);
	}
}
