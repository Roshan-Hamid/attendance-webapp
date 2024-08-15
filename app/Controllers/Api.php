<?php

namespace App\Controllers;

use App\Libraries\Phpmailer_library;
use App\Libraries\My_PHPMailer;


class Api extends BaseController
{
    protected $My_PHPMailer;
    protected $phpmailer_library;

    public function __construct()
    {
        // $this->phpmailer_library = new Phpmailer_Library();
        // $this->phpmailer_library =    ('Phpmailer_Library');
        // $this->Api = model('Api_model');
        // $this->session = \Config\Services::session();
        include(APPPATH . "Libraries/Phpmailer_library.php");
        $this->phpmailer_library = service('phpmailer_library');
        $this->My_PHPMailer = service('My_PHPMailer');
        
    }
    public function index()
    {
        exit("thala7iyutyrf kmgh");
    }
    public function attendance()
    {

        //  exit('fssef');
        // Load PHPMailer library
        // $this->load->library('phpmailer_library');

        // $mail = new My_PHPMailer();
        $mail = new Phpmailer_Library();

        // PHPMailer object
        $mail = $this->phpmailer_library->load();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'unofficial314@gmail.com';
        $mail->Password = 'afoz rlff geon uvyo';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;

        $mail->setFrom('unofficial314@gmail.com');
        $mail->addReplyTo('unofficial314@gmail.com');

        // Add a recipient
        $mail->addAddress('husainnki@gmail.com');

        // Add cc or bcc 

        // $mail->addBCC('unofficial314@gmail.com');

        // Email subject
        $mail->Subject = 'Test';

        // Set email format to HTML
        $mail->isHTML(true);
        $rawPostData = file_get_contents("php://input");
        // Email body content
        $mail->Body = json_encode($_REQUEST);

        // Send email
        $mail->Body .= json_encode($rawPostData);
        //        if(!$mail->send()){
        //            echo 'Message could not be sent.';
        //            echo 'Mailer Error: ' . $mail->ErrorInfo;
        //        }else{  
        //            echo 'Message has been sent';
        //        }
        $emailData = array(
            'recipient_email' => 'onlinetester369@gmail.com',
            'subject' => 'Test',
            'body' => json_encode($_REQUEST) . $rawPostData,
            'sent_at' => date('Y-m-d H:i:s')
        );
        $this->mailstore($emailData);
    }
    private function mailstore($data)
    {
        // Call the model function to insert data into the database
        // $this->Api_model->insertEmailData($data);
    }
    public function data_view()
    {
        // $this->load->library('zklib');

        // PHPMailer object
        // $viewattendance = $this->zklib->load();
        return view('zktesta');
    }
}
