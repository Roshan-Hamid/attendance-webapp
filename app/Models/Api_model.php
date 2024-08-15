<?php
namespace App\Models;

use CodeIgniter\Model;

class Api_model extends Model {
    
    public function insertEmailData($data) {
     // Assuming you have a table named 'email_data'
    $this->db->insert('email_data', $data);
    // $this->db->insert('mail_data', $dataToInsert);

    }
}
