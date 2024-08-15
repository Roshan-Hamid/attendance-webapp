<?php
namespace App\Models;
use CodeIgniter\Model;
class Devices_model extends Model
{protected $table = 'device';
	public function select_Devices($columns='*',$data='')
	{	
		$db = $this->db->table('device d');
        $db->select($columns);
		$db->join('branch b','b.branch_id=d.branch_id');

		if(!empty($data)){
			$db->where($data);
		}
		$db->where('d.delete_status',0);

		// $db->where('d.delete_status',0);
		// $db->orderBy('d.id', 'asc');
		$query = $db->get();
		return $query;
	}


	public function create_Devices($data)
	{
		
		$db = $this->db->table('device');
		$query = $db->insert($data);
    	$result['insert_id'] = $this->db->insertID();
    	$result['status'] = $query;
    	return $result;
	}

	public function update_Devices($data){
		// $this->db->table('devices')->where('devices_id', $data['devices_id'])->update($data);
		$db = $this->db->table('device');
		$db->where('device_id', $data['device_id']);
		$query = $db->update($data);
		return $query;
	}
	
}
?>

