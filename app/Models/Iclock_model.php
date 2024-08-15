<?php
namespace App\Models;

use CodeIgniter\Model;


class Iclock_model extends Model
{   
    protected $table = 'url';
    public function create_url($data)
    {   
	$db = $this->db->table('url');
	$query = $db->insert($data);
    $result['insert_id'] = $this->db->insertID();
    $result['status'] = $query;
    return $result;
    }
    public function create_getrequest($data)
    {   
	$db = $this->db->table('getrequest');
	$query = $db->insert($data);
    $result['insert_id'] = $this->db->insertID();
    $result['status'] = $query;
    return $result;
    }
}