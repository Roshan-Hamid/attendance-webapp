<?php
namespace App\Controllers;
class MyProfile extends BaseController
{

    public function __construct()
    {

        ini_set('max_execution_time', 5000);
        ini_set("memory_limit", "-1");
        date_default_timezone_set('Asia/Kolkata');
        $this->session = \Config\Services::session();
		$this->Attendance = model('Attendance_model');
		// return view('Frontend', $this->data);
        $this->data['folder'] = 'Profile';
       
    }
    public function index()
    {   
        // // Check if user is logged in
        // if (!$this->session->get('logged_in')) {
        // return redirect()->to('/'); // Redirect to login page if not logged in
        // }
        $userRole = $this->session->get('user_role');
        // echo $userRole;
        if ($userRole === 'admin' || $userRole === 'manager') {
        $this->data['page'] = 'profile_list';

        return view('Index', $this->data);
        }else {
            return redirect()->to('/dashboard'); // Or redirect to a different page
        }
    }
}