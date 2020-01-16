<?php
	//require 'PHPMailer/PHPMailerAutoload.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	
	function SendEmail($ToEmailList,$Subject,$bodyContent){ ///echo $ToEmailList; exit();
		try{
			$response = array();
			if(($ToEmailList!="")&&($Subject!="")&&($bodyContent!="")){
				$mail = new PHPMailer;

				$mail->isSMTP();                            // Set mailer to use SMTP
				$mail->Host = 'smtp.office365.com';         // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                     // Enable SMTP authentication
				$mail->Username = 'CRM@smollan.com';        // SMTP username
				$mail->Password = 'Sag!C@s4k?*&FQWj'; 		// SMTP password
				$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                          // TCP port to connect to

				$mail->setFrom('CRM@smollan.com', 'Smollan CRM');
				$mail->addReplyTo('CRM@smollan.com', 'Smollan CRM');
				//$mail->addAddress('Orders@smollan.com');   // Add a recipient
				//$mail->addCC('sbu.mahlabane@smollan.com'); // Add a CC
				$delimiter = ";";
				
				$pos = strpos($ToEmailList, ";");
				if ($pos === false){
					$mail->addAddress($ToEmailList);
				}else{
					if($EmailAddresses = explode($delimiter, $ToEmailList)){
						foreach ($EmailAddresses as $EmailAddress) {
							if($EmailAddress!=""){
								$mail->addAddress($EmailAddress);
							}
						}
					}
				}
				$mail->isHTML(true);  // Set email format to HTML

				$mail->Subject = $Subject;
				$mail->Body    = $bodyContent;

				if(!$mail->send()) {
					$response[] = array('Status'=> "Message could not be sent",'Code'=> "002",'Content'=>'Email Error: '. $mail->ErrorInfo);
				} else {
					$response[] = array('Status'=> "OKAY",'Code'=> "200",'Content'=>'Message has been sent');
				}
			}else{ 
				$response[] = array('Status'=> "Error",'Code'=> "002",'Content'=>'Email List, Subject Or Body Content is not provided!');	
			}
			echo json_encode($response);
		} catch (Exception $exc) {
			$response[] = array('Status'=> "Error",'Code'=> "002",'Content'=>$exc->getTraceAsString());
		}
	}
?>