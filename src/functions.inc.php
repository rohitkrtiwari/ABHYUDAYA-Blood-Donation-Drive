<?php
include('smtp/PHPMailerAutoload.php');

function get_safe_value($conn,$str){
	if($str!=''){
		$str = trim($str);
		return strip_tags(mysqli_real_escape_string($conn, $str));
	}
	die();
}

// Generate CSRF Token
function csrf_token($form_name){
	$token = bin2hex(random_bytes(50));
	if(!empty($_SESSION['csrf_token'])){
		$_SESSION['csrf_token'][$form_name] = $token;
	}else{
		$_SESSION['csrf_token'] = array();
		$_SESSION['csrf_token'][$form_name] = $token;		
	}
	return $token;
}

function sendMail($to,$subject, $body){
	$mail = new PHPMailer(); 
	// $mail->SMTPDebug  = 3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'ssl'; 
	$mail->Host = "smtp.mail.yahoo.com";
	$mail->Port = 465; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "your-email-id";
	$mail->Password = "your password";
	$mail->SetFrom("your-email-id");
	$mail->Subject = $subject;
	$mail->Body =$body;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
		return false;
	}else{
		return true;
	}
}

?>