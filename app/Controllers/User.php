<?php
namespace App\Controllers;

class User extends BaseController
{
    public function index($user_id = null)
    {
        // We load the CI welcome page with some lines of Javascript
        $this->load->view('welcome_message', array('user_id' => $user_id));
    }
}