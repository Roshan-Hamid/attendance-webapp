<?php
namespace App\Models;

use CodeIgniter\Model;


class Attendance_model extends Model
{
	protected $table = 'attendance';

	public function select_Attendance($columns='*',$data='')
	{	 
		$db = $this->db->table('attendance a');
        $db->select($columns);
		
		$db->join('staffs s','s.userid=a.userid', 'left');

		if(!empty($data)){
			$db->where($data);
		}
		// $this->db->where('b.delete_status',0);

		$db->orderBy('check_in', 'ASC');
		$result = $db->get();

		// $query = $this->db->getLastQuery();
		// echo $query;
		// exit;
	
        return $result;

	}

		public function create_Attendance($data)
	{   
		$db = $this->db->table('attendance');
		$query = $db->insert($data);
		$result['insert_id'] = $this->db->insertID();
		$result['status'] = $query;
		return $result;
	}	

	public function update_Attendance($data){
		$db = $this->db->table('attendance');
		$db->where('index', $data['index']);
		$query = $db->update($data);
		return $query;
	}

	public function create_attendance_log($logdata)
	{   
		$db = $this->db->table('attendance_log');
		$query = $db->insert($logdata);
		$result['insert_id'] = $this->db->insertID();
		$result['status'] = $query;
		return $result;
	}	
	public function select_Attendance_log($columns='*',$data='')
	{	 
		$db = $this->db->table('attendance_log alog');
        $db->select($columns);
		if(!empty($data)){
			$db->where($data);
		}
		$result = $db->get();
        return $result;
	}
}
