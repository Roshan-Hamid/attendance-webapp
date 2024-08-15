<?php
namespace App\Controllers;


class Maintanance extends BaseController {

	function __construct()
	{
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');
		// $this->load->library('session');
        $this->session = \Config\Services::session();



	}

	public function index()
	{
 		if(config_item('maintanance_mode')==1){
			$this->load->view('errors/maintanance_mode');
		}else{
			redirect(base_url().'dashboard', 'refresh');
		}
	}

}