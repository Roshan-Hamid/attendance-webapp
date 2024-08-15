<?php
namespace App\Models;

use CodeIgniter\Model;
class Settings_model extends Model
{	
	protected $table = 'settings';
	public function select_setting_config($columns='*',$data='',$join="")
	{
		// $this->db->select($columns)->from('settings s');
		$db = $this->db->table('settings s');
		if(!empty($data)){
			$db->where($data);
		}
		$db->orderBy('s.setting_id','asc');
		// $query = $this->db->get();
		$query = $db->get();
		return $query;
	}


	public function update_config($data){
		$this->db->where('setting_name', $data['setting_name']);
		$query = $this->db->update('settings', $data);
		return $query;
	}

	public function update_config_by_id($data){
		$this->db->where('setting_id', $data['setting_id']);
		$query = $this->db->update('settings', $data);
		return $query;
	}

		public function select_app_modules($columns='*',$data='',$join="")
	{
		$this->db->select($columns)->from('app_modules am');
		
		if(!empty($data)){
			$this->db->where($data);
		}
		$this->db->order_by('am.module_id','asc');
		$query = $this->db->get();
		return $query;
	}

	
	
}
?>
