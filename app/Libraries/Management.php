<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Management {

	function __construct()
	{
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$CI =& get_instance();
		$this->CI =& get_instance();
		$this->CI->load->library('session');
		$CI->load->model('User_model', 'User');
		$CI->load->model('Cases_model', 'Cases');
		$CI->load->model('Donations_model', 'Donations');
		$CI->load->model('Donors_model', 'Donors');
		$CI->load->model('Committees_model', 'Committees');
	}

	public function evaluate_case_status($case_id='')
	{
		$CI =& get_instance();

		if($case_id!=''){
			$data['c.case_id'] = $data_update['case_id'] = $case_id;
		}else{
			$data = array();
		}
		$data['status'] = 0;

		$cases = $CI->Cases->select_cases('c.needed_units,c.case_id',$data)->result();

		foreach ($cases as $key => $case) {

			$data_1['c.case_id'] = $data_update_1['case_id'] = $case->case_id;
			
			$data_update_1['donated_units'] = $CI->Donations->select_donations('c.case_id',$data_1)->num_rows();
			$data_update_1['needed_units'] = $case->needed_units;
			$data_update_1['balance_units'] = $data_update_1['needed_units'] - $data_update_1['donated_units'];

			if(config_item('manual_case_closing')==0){
				if($data_update_1['balance_units']>0){
					$data_update_1['status'] = 0; 
				}else{
					$data_update_1['status'] = 1; 
				}
			}

			$CI->Cases->update_case($data_update_1);

		}

		return true;
	}

	// 	public function evaluate_hospital($hospital_id='')
	// {
	// 	$CI =& get_instance();

	// 	if($hospital_id!=''){
	// 		$data['dnt.dnt_hospital_id'] = $data_update['hospital_id'] = $hospital_id;
	// 	}else{
	// 		$data = array();
	// 	}
	// 	$data['status'] = 0;

	// 	$data_update[''] = $CI->Donations->select_donations('dnt.donation_id',$data)->num_rows();

	// 	foreach ($cases as $key => $case) {

	// 		$data_1['c.case_id'] = $data_update_1['case_id'] = $case->case_id;

	// 		$data_update_1['donated_units'] = $CI->Donations->select_donations('c.case_id',$data_1)->num_rows();
	// 		$data_update_1['needed_units'] = $case->needed_units;
	// 		$data_update_1['balance_units'] = $data_update_1['needed_units'] - $data_update_1['donated_units'];

	// 		if(config_item('manual_case_closing')==0){
	// 			if($data_update_1['balance_units']>0){
	// 				$data_update_1['status'] = 0; 
	// 			}else{
	// 				$data_update_1['status'] = 1; 
	// 			}
	// 		}

	// 		$CI->Cases->update_case($data_update_1);

	// 	}

	// 	return true;
	// }


	public function evaluate_donor_status($donor_id='',$donation_id='')
	{
		$CI =& get_instance();

		if($donor_id!=''){
			$data['d.donor_id'] = $data2['dnt.donor_id'] = $data_update['donor_id'] = $donor_id;
		}else{
			$data = $data2 = array();
		}

		$donors = $CI->Donors->select_donors('d.no_of_donations,d.donor_id',$data)->result();

		foreach ($donors as $key => $donor) {

			$data_1['dnt.donor_id'] = $data_update_1['donor_id'] = $donor->donor_id;

			$row = $CI->Donations->select_donations('MAX(dnt.donated_date) as last_donated_date, dnr.gender',$data_1)->row();

			$data_update_1['last_donated_date'] = $row->last_donated_date;

			if($row->gender=='male'){
				$bleeding_gap = '3';
			}else{
				$bleeding_gap = '4';
			}

			$data_update_1['next_donation_date'] = date('Y-m-d',strtotime("+".$bleeding_gap." months", strtotime($data_update_1['last_donated_date'])));

			if (strtotime($data_update_1['next_donation_date'])<strtotime(date('d-m-Y'))) {
				$data_update_1['eligible'] = 1;
			}else{
				$data_update_1['eligible'] = 0;
			}

			$no_of_donations = $donor->no_of_donations;
			$new_donations_count = $CI->Donations->select_donations('dnt.donation_id',$data2)->num_rows();
			$data_update_1['total_no_of_donations']  = $no_of_donations+$new_donations_count;

			if($donation_id!=''){
				$data_update_dnt['donation_id'] = $donation_id; 
				$data_update_dnt['donation_rank'] = $data_update_1['total_no_of_donations']-1;
				$CI->Donations->update_donation($data_update_dnt);
			}



			$CI->Donors->update_donor($data_update_1);

		}

	}

	public function evaluate_committee($committee_id='')
	{
		$CI =& get_instance();
		if($committee_id!=''){
			$data['c.committee_id'] = $data_update['committee_id'] = $committee_id;
		}else{
			$data = array();
		}
		$committees = $CI->Committees->select_committees('*',$data)->result();
		foreach ($committees as $key => $c) {
			$data_update['members_count'] = $CI->Committees->select_committee_members('c.committee_id',$data)->num_rows();
			$CI->Committees->update_committee($data_update);
		}
	}

	public function evaluate_committee_donations($member_id='')
	{
		$CI =& get_instance();
		if($member_id!=''){
			$data['cm.member_id'] = $data2['dnt.member_id'] = $member_id;
			$data3['committee_id'] = $CI->Committees->select_committee_members('c.committee_id',$data)->row()->committee_id;
		}else{
			$data = $data2 = $data3 = array();
		}

		$members = $CI->Committees->select_committee_members('*',$data)->result();
		foreach ($members as $key => $cm) {
			$data_1['member_id'] = $cm->member_id;
			$data_1['member_donated_units'] = $CI->Donations->select_donations('dnt.donation_id',$data2)->num_rows();
			$CI->Committees->update_committee_member($data_1);
		}

		$committees = $CI->Committees->select_committees('*',$data3)->result();
		foreach ($committees as $key => $c) {
			$data_2['committee_id'] = $c->committee_id;
			$data_2['committee_donated_units'] = $CI->Donations->select_donations('dnt.donation_id',$data2)->num_rows();
			$CI->Committees->update_committee($data_2);
		}
	}


	public function notify_donors_on_case($case_id)
	{
		$CI =& get_instance();

		$case = $CI->Cases->select_cases('*',array('c.case_id'=>$case_id,'c.status'=>0));

		if($case->num_rows()==1){

			$case = $case->row();

			$data['d.donor_group'] = $case->case_group;
			$data['d.eligible'] = 1;
			$data['d.availability'] = 1;
			$data['d.available_date<='] = date('Y-m-d');

			$donors = $CI->Donors->select_donors('*',$data)->result();

			foreach ($donors as $key => $value) {


				$message ='Dear%20'.$value->donor_name.',%0aBlood%20Donation%20URGENT%20-%20'.$case->case_group.'%20!!%0aCase%20Date%20-%20'.date('d-F-Y',strtotime($case->case_date)).'%0aUnits%20Needed%20-%20'.$case->balance_units.'%0aLocation%20-%20'.$case->hospital_name.'%20-%20'.$case->address.'%20-%20'.$case->contact.' Team'.config_item('company_name');

				// $api_url = 'https://www.fast2sms.com/dev/bulkV2?authorization=ZBkwja0lI5E5NpZ38WqEajJkXNXObFSMgQjVDJhSELiQJvh3aMBZ0ieA91eY&route=v3&sender_id=TXTIND&message='.$message.'&language=english&flash=0&numbers='.$value->donor_contact;

				// $send = file_get_contents($api_url);

				// exit(print_r($send));

				// $message ='Dear Test one 123';

				$fields = array(
					"message" => $message,
					"language" => "english",
					"route" => "v3",
					"flash" => 0,
					"sender_id" => "TXTIND",
					"numbers" => $value->donor_contact,
				);

				$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_SSL_VERIFYHOST => 0,
					CURLOPT_SSL_VERIFYPEER => 0,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => json_encode($fields),
					CURLOPT_HTTPHEADER => array(
						"authorization: ".config_item('sms_api_key'),
						"accept: */*",
						"cache-control: no-cache",
						"content-type: application/json"
					),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				// exit(print_r($response));

				curl_close($curl);

			// if ($err) {
			// 	echo "cURL Error #:" . $err;
			// } else {
			// 	echo $response;
			// }



			}

		}


	} 


	public function send_sms($to,$sms_body)
	{
		$fields = array(
			"message" => $sms_body,
			"language" => "english",
			"route" => "v3",
			"flash" => 0,
			"sender_id" => "TXTIND",
			"numbers" => $to,
		);

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($fields),
			CURLOPT_HTTPHEADER => array(
				"authorization: ".config_item('sms_api_key'),
				"accept: */*",
				"cache-control: no-cache",
				"content-type: application/json"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		$result['response'] = $response;
		$result['err'] = $err;

		return $result;

	}




}


