<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");

echo "works";

//if(isset($_POST['message'])){
    $to      = 'jgomez@smartlaboratory.tech';
    $mail = $_POST['email']; 
    $phone = $_POST['tel']; 
    $headers = "From: ".$_POST['mail']." <".$_POST['mail'].">\r\n"; $headers = "Reply-To: ".$_POST['mail']."\r\n"; 
    $headers = "Content-type: text/html; charset=iso-8859-1\r\n";
    'X-Mailer: PHP/' . phpversion();
    if(mail($to, 'Message from app', "$mail <br> $phone", $headers)) echo json_encode(['success'=>true]); 
    else echo json_encode(['success'=>false]);
    exit;
 //}
?>