<?php


/**
 * CodeIgniter PHPMailer Class
 *
 * This class enables SMTP email with PHPMailer
 *
 * @category    Libraries
 * @author      CodexWorld
 * @link        https://www.codexworld.com
 */
namespace App\Libraries;

require_once APPPATH.'Libraries/phpmailer/PHPMailerAutoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
class Phpmailer_Library
{
    public function __construct(){
        // log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load(){
        // Include PHPMailer library files
        // require_once APPPATH.'Libraries/phpmailer/PHPMailerAutoload.php';
        
        // require_once APPPATH.'Libraries/phpmailer/PHPMailer.php';
        // require_once APPPATH.'Libraries/phpmailer/SMTP.php';
        
        // $mail = new PHPMailer;
        $mail = new PHPMailer();
        return $mail;
    }
}