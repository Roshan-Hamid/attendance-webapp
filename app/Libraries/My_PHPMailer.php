<?php
namespace App\Libraries;

class My_PHPMailer {
    function __construct()
    {
        // include(APPPATH . "Libraries/phpmailer/PHPMailerAutoload.php");

        // require_once('phpmailer/PHPMailerAutoload.php');
        require_once APPPATH.'Libraries/phpmailer/PHPMailerAutoload.php';

    }
}