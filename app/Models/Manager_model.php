<?php
namespace App\Models;
use CodeIgniter\Model;

class Manager_model extends Model
{
	
	protected $table = 'users';

	public function select_manager($columns='*',$data='')
	{	
		$db =$this->db->table('users u');
        $db->select($columns);
		// $db->join('branch b', 'FIND_IN_SET(b.branch_id, u.branch_id)', 'left');
		
		if(!empty($data)){
			$db->where($data);
		}
		
		$db->where('u.delete_status',0);
		$db->where('u.user_role',2);

		$result = $db->get();
		// $query = $this->db->getLastQuery();
		// echo $query;
		// exit;
		return $result;
	}



	public function create_manager($data)
	{
		// $query = $this->db->insert('users', $data);
		$db = $this->db->table('users');
		$query = $db->insert($data);
		$result['insert_id']=$this->db->insertID();
		$result['status']=$query;
		return $result;
	}

	public function update_manager($data){
		$db = $this->db->table('users');
		$db->where('user_id', $data['user_id']);
		$query = $db->update($data);
		return $query;
	}
	public function isUsernameExists($username, $userId)
    {
        $builder = $this->db->table('users');
        $builder->select('COUNT(*) as count');
        $builder->where('username', $username);
        if ($userId) {
            $builder->where('user_id !=', $userId);
        }
        $result = $builder->get()->getRow();
        return $result->count > 0;
    }
}
?>
