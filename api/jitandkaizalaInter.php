<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

ini_set('display_errors', '1');
error_reporting(E_ALL);
date_default_timezone_set('Africa/Johannesburg');



require '../vendor/autoload.php';

$G_TOKEN = "";
foreach (getallheaders() as $name => $value) {
    if ($name == "Authorization") {
        $G_TOKEN = $value;
    }else{

    }
    
}

if (strlen($G_TOKEN) > 10)
{
    //$query_string = $_SERVER['QUERY_STRING'];
    //Validate the Basic Authorization
    //Check if Basic Time has no expired
    //Testing
    $details = json_decode(file_get_contents("php://input"));
    //$fh = fopen('log.txt', 'w') or die("Can't open file.");
    // output the value as a variable by setting the 2nd parameter to true
    $results = print_r($details, true);
    //$results ="Tester";
    //fwrite($fh, $results);
    //fclose($fh);
	
	
	// Instantiation and passing `true` enables exceptions
     $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = "macdonaldnkoana@gmail.com";                     // SMTP username
        $mail->Password   = "macdOM27@m7";                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('macdonaldnkoana@gmail.com', 'testerGmail');
        $mail->addAddress('oarabile.macdonald@smollan.com', 'testingOutlook');
        /*$mail->addAddress('ellen@example.com');
       $mail->addReplyTo('info@example.com', 'Information');
       $mail->addCC('cc@example.com');
       $mail->addBCC('bcc@example.com');*/

        // Attachments
        /*$mail->addAttachment('/var/tmp/file.tar.gz');
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); */

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b> '.$results ;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
        ///echo json_encode("The API EndPoint is working properly");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}else{
    echo json_encode("Please provided Basic Authorization to proceed");
}



?>
