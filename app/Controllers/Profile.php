<?php
namespace App\Controllers;
class Profile extends BaseController
// {

//     public function __construct()
//     {

//         ini_set('max_execution_time', 5000);
//         ini_set("memory_limit", "-1");
//         date_default_timezone_set('Asia/Kolkata');
//         $this->session = \Config\Services::session();
// 		$this->Attendance = model('Attendance_model');
// 		// return view('Frontend', $this->data);
//         $this->data['folder'] = 'Profile';
       
//     }
//     public function index()
//     {   
       
//         $userRole = $this->session->get('user_role');
//         // echo $userRole;
//         if ($userRole === 'admin' || $userRole === 'manager') {
//         $this->data['page'] = 'staff_profile_list';

//         return view('Index', $this->data);
//         }else {
//             return redirect()->to('/dashboard'); 
//         }
//     }
// }