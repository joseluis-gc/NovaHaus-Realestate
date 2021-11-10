<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "config/db.php";
require_once "vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once "vendor/phpmailer/phpmailer/src/Exception.php";
require_once "vendor/phpmailer/phpmailer/src/SMTP.php";



function timeDiff($start, $end){

    $hourdiff = round((strtotime($end) - strtotime($start))/3600, 1);
    return $hourdiff;
}


function getAll($table){
    global $connection;
    $array = array();

    $query = "SELECT * FROM $table";
    $result = mysqli_query($connection, $query);
    //return $result;
    while($row = mysqli_fetch_array($result)){
        $array[] = $row; 
    }
    return $array;
}


function outPutInfo(){
    return SMTP_HOST;
}


function sendEmail($email, $title, $message, $attach = array(), $CC = array())
{
    // Load Composer's autoloader
    require 'vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try 
    {    
        //Server settings
        $mail->SMTPDebug  = SMTP::DEBUG_SERVER;                                    
        $mail->isSMTP(true);                                                      
        $mail->Host       = 'mail.jlgc.site;mail.jlgc.site';  
        $mail->SMTPAuth   = true;                                         
        $mail->Username   = 'sender@jlgc.site';                   
        $mail->Password   = 'whfJI{C.=mAQ';                                 
        $mail->SMTPSecure = 'tls';                                            
        $mail->Port       = 465;                                              

        //Recipients
        $mail->setFrom('sender@jlgc.site', 'Set From');
        $mail->addAddress($email);                                            
        //$mail->addCC($email);

        // Content
        $mail->isHTML(true);                                                 
        $mail->Subject = $title;
        $mail->Body    = $message;

        if(count($CC) > 0)
        {
            foreach($CC as $user)
            {
                $mail->addCC($user);
                //echo "<br><br>".$user."<br><br>";
            }
        }
        /*
        if(count($attach) > 0)
        {
            foreach($attach as $file)
            {
                try{
                    $mail->addAttachment("../".$file);
                }
                catch(Exception $e){
                    $mail->addAttachment($file);
                }
            }
        }
        */
        
        $mail->send();
        
    } catch (Exception $e) 
    {   
        echo "Can't send the email.";
    }
}