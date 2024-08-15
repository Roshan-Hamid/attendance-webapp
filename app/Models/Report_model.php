<?php
namespace App\Models;

use CodeIgniter\Model;


class Report_model extends Model
{
	protected $table = 'attendance';

	public function select_Attendance($columns='*',$data='')
	{	 
		$db = $this->db->table('attendance a');
        $db->select($columns);
		
		$db->join('staffs s','s.userid=a.userid', 'left');
		$db->join('device','device.device_id=a.device_id', 'left');
		$db->join('branch','branch.branch_id=device.branch_id', 'left');


		if(!empty($data)){
			$db->where($data);
		}
		
		// $this->db->where('b.delete_status',0);

		// $this->db->order_by('p.project_id','desc');
		// $db->groupBy('a.check_in');
		// $this->db->group_by('b.email');
		// $db->groupBy('a.userid');
		
		$result = $db->get();

		// $query = $this->db->getLastQuery();
		// echo $query;
		// exit;
	
        return $result;

	}
    public static function getMonthList() {
        return [
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];
    }
}