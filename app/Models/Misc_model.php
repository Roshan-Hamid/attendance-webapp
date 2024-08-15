<?php
namespace App\Models;
use CodeIgniter\Model;
class Misc_model extends Model
{
	public function send_mail($subject,$body,$mail_to)
	{

		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'kozhinhikkodan007@gmail.com',
			'smtp_pass' => '9567049467',
			'mailtype'  => 'html', 
			'smtp_crypto' => 'ssl',
			'wordwrap' => TRUE,
			'validation' => TRUE
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		$this->email->from('kozhinhikkodan007@gmail.com', 'Sali');
		$this->email->to('mswalih31@gmail.com'); 

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');  

		$result = $this->email->send();

		if(!$result) {
			$mail_result = 0;
		} else {
			$mail_result = 1;
		}
		return $mail_result;
	}

	public function generate_password($length=6)
	{
		$chars =  '0123456789';
		$str = '';
		$max = strlen($chars) - 1;

		for ($i=0; $i < $length; $i++)
			$str .= $chars[random_int(0, $max)];

		return $str;
	}

	public function get_patient_type_amount($type)
	{
		$patient_types = config_item('patient_types');
		foreach ($patient_types as $key => $value) {
			if($key==$type){
				return $value;
			}	
		}
	}

	public function amount_in_words($amount)
	{

		$number = $amount;
		$no = floor($number);
		$point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array('0' => '', '1' => 'one', '2' => 'two',
			'3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
			'7' => 'seven', '8' => 'eight', '9' => 'nine',
			'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
			'13' => 'thirteen', '14' => 'fourteen',
			'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
			'18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
			'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
			'60' => 'sixty', '70' => 'seventy',
			'80' => 'eighty', '90' => 'ninety');
		$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
		while ($i < $digits_1) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += ($divider == 10) ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str [] = ($number < 21) ? $words[$number] .
				" " . $digits[$counter] . $plural . " " . $hundred
				:
				$words[floor($number / 10) * 10]
				. " " . $words[$number % 10] . " "
				. $digits[$counter] . $plural . " " . $hundred;
			} else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$points = ($point) ?
		"." . $words[$point / 10] . " " . 
		$words[$point = $point % 10] : '0';
		return ucfirst($result) . "Rupees  ";

	}

}
?>
