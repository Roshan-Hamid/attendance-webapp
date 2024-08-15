<?php

namespace App\Models;

use CodeIgniter\Model;

class Staffs_model extends Model
{
	protected $table = 'staffs';
	public function select_Staffs($columns = '*', $data = '')
	{
		$db = $this->db->table('staffs s');
		$db->select($columns);
		$db->join('branch b', 'b.branch_id=s.branch_id');
		// $db->join('device d','d.device_id=s.device_id');


		if (!empty($data)) {
			$db->where($data);
		}
		$db->where('s.delete_status', 0);

		$query = $db->get();

		// $query = $this->db->getLastQuery();
		// echo $query;
		// exit;
		return $query;
	}

	public function select_Staffs_count($columns = '*', $data = '')
	{
		$db = $this->db->table('staffs s');
		$db->select($columns);
		if (!empty($data)) {
			$db->where($data);
		}
		$db->where('s.delete_status', 0);
		$query = $db->get();
		return $query;
	}


	public function create_Staffs($data)
	{
		$db = $this->db->table('staffs');
		$query = $db->insert($data);
		$result['insert_id'] = $this->db->insertID();
		$result['status'] = $query;
		return $result;
	}
	public function insert_Staff($data)
	{

		$db = $this->db->table('staffs');
		$existingData = $db->getWhere(['uid' => $data['uid'], 'userid' => $data['userid']])->getRow();

		if ($existingData) {
			return ['error' => 'Staffs entry already exists.'];
		} else {
			$query = $db->insert($data);
			$result['insert_id'] = $this->db->insertID();
			$result['status'] = $query;
			return $result;
		}
	}


	public function update_Staffs($data)
	{
		$db = $this->db->table('staffs');
		$db->where('id', $data['id']);
		$query = $db->update($data);
		return $query;
	}
}
