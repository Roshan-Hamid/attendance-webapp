<?php
namespace App\Models;
use CodeIgniter\Model;
class Branch_model extends Model
{protected $table = 'branch';
	public function select_Branches($columns='*',$data='')
	{	
		$db = $this->db->table('branch b');
        $db->select($columns);

		if(!empty($data)){
			$db->where($data);
		}
		$db->where('b.delete_status',0);
		$db->orderBy('b.branch_id', 'asc');

		$query = $db->get();
		// $query = $this->db->getLastQuery();
		// echo $query;
		// exit;
		return $query;
	}

	public function select_branches_for_managers($columns = '*', $data = '')
	{   
    $db = $this->db->table('branch b');
    $db->select($columns);

		if (!empty($data)) {
			foreach ($data as $key => $value) {
				if ($key === 'branch_id') {
					if (is_array($value)) {
						$db->whereIn('b.branch_id', $value);
					} else {
						$db->where('b.branch_id', $value);
					}
				} else {
					$db->where($key, $value);
				}
			}
		}

    $db->where('b.delete_status', 0);
    $db->orderBy('b.branch_id', 'asc');

    $query = $db->get();
    return $query;
	}

	public function select_dropdownBranches($columns='*',$data='')
	{	
		$db = $this->db->table('branch b');
		$db->join('staffs s','s.branch_id=b.branch_id');

        $db->select($columns);

		if(!empty($data)){
			$db->where($data);
		}
		$db->where('b.delete_status',0);
		$db->orderBy('b.branch_id', 'asc');

		$query = $db->get();
		// $query = $this->db->getLastQuery();
		// echo $query;
		// exit;
		return $query;
	}


	public function create_Branches($data)
	{
		$db = $this->db->table('branch');
		$query = $db->insert($data);
    	$result['insert_id'] = $this->db->insertID();
    	$result['status'] = $query;
    	return $result;
	}

	public function update_Branches($data){
		$db = $this->db->table('branch');
		$db->where('branch_id', $data['branch_id']);
		$query = $db->update($data);
		return $query;
	}
	public function select_banches_count($columns='*',$data='')
	{	
		$db = $this->db->table('branch');
        $db->select($columns);
		if(!empty($data)){
			$db->where($data);
		}
		$db->where('delete_status',0);
		$query = $db->get();
		return $query;
	}
}
?>

