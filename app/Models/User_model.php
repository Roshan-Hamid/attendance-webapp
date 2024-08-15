<?php
namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
	protected $table = 'users';
	public function select_user($columns = '*', $data = '')
{   
    $db = $this->db->table('users u');
    $db->select($columns);
    $db->join('user_roles ur', 'u.user_role = ur.role_id');
    
    if (!empty($data)) {
        $db->where($data);
    }

    $db->where('u.delete_status', 0);
    $db->orderBy('u.user_id', 'desc');

    $query = $db->get();
    return $query->getResult();
}
public function select_userdata($columns = '*', $data = '')
{   
    $db = $this->db->table('users u');
    $db->select($columns);
    
    if (!empty($data)) {
        $db->where($data);
    }

    $db->where('u.delete_status', 0);
    $db->orderBy('u.user_id', 'desc');
	$result = $db->get();
    // $query = $db->get();
	// $query = $this->db->getLastQuery();
	// echo $query;
	// exit;
    // return $query->getResult();
    return $result;
}

	public function create_user($data)
	{
		$query = $this->db->insert('users', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_user($data){
		$user_id = $data['user_id'];
		$db = $this->db->table('users');

		$db->where('user_id', $data['user_id']);
		$query = $db->update( $data);
		return $query;
	}
	
	public function select_user_roles($columns='*',$data='')
	{
		$this->db->select($columns)->from('user_roles ur');
		
		if(!empty($data)){
			$this->db->where($data);
		}
		$this->db->order_by('ur.role_id','asc');
		$query = $this->db->get();
		return $query;
	}
	
	public function select_user_count($columns='*',$data='')
	{	
		$db = $this->db->table('users');
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
