<?php
require_once("../../includes/initialize.php");
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'modify' :
	dbMODIFY();
	break;
	
	case 'delete' :
	dbDELETE();
	break;
	
	case 'deleteOne' :
	dbDELETEONE();
	break;
	case 'confirm' :
	doConfirm();
	break;
	case 'cancel' :
	doCancel();
	break;
	case 'checkin' :
	doCheckin();
	break;
	case 'checkout' :
	doCheckout();
	break;
	case 'cancelroom' :
	doCancelRoom();
	break;
	}
function doCheckout(){

	// $id = $_GET['id'];

	// $res = new Reservation();
	// $res->STATUS = 'Checkedout';
	// $res->update($id); 
			$sql = "UPDATE `tblreservation` SET `STATUS`='Checkedout' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
mysql_query($sql) or die(mysql_error());

	$sql = "UPDATE `tblpayment` SET `STATUS`='Checkedout' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
	mysql_query($sql) or die(mysql_error());
					
	message("Reservation Updated successfully!", "success");
	redirect('index.php');

}
function doCheckin(){
// $id = $_GET['id'];

// $res = new Reservation();
// $res->STATUS = 'Checkedin';
// $res->update($id); 
		$sql = "UPDATE `tblreservation` SET `STATUS`='Checkedin' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
mysql_query($sql) or die(mysql_error());
 

$sql = "UPDATE `tblpayment` SET `STATUS`='Checkedin' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
mysql_query($sql) or die(mysql_error());






















message("Reservation Updated successfully!", "success");
redirect('index.php');


/*sms can be placed here*/
}


function doCancel(){
// $id = $_GET['id'];

// $res = new Reservation();
// $res->STATUS = 'Cancelled';
// $res->update($id);
$sql = "UPDATE `tblreservation` r,tblroom rm SET ROOMNUM=ROOMNUM + 1 WHERE r.`ROOMID`=rm.`ROOMID` AND `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
mysql_query($sql) or die(mysql_error());	


$sql = "UPDATE `tblreservation` SET `STATUS`='Cancelled' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
mysql_query($sql) or die(mysql_error());


$sql = "UPDATE `tblpayment` SET `STATUS`='Cancelled' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
mysql_query($sql) or die(mysql_error());

				
message("Reservation Updated successfully!", "success");
redirect('index.php');

}
function doCancelRoom(){
// $id = $_GET['id'];

// $res = new Reservation();
// $res->STATUS = 'Cancelled';
// $res->update($id); 
	$mydb->setQuery("SELECT * FROM `tblreservation` WHERE  `RESERVEID` ='" . $_GET['id'] ."'");
	$cur = $mydb->loadResultList(); 
	foreach ($cur as $result) {  

	$room = new Room(); 
	$room->ROOMNUM    = $room->ROOMNUM + 1; 
	$room->update($result->ROOMID); 

	}


$sql = "UPDATE `tblreservation` SET `STATUS`='Cancelled' WHERE `RESERVEID` ='" . $_GET['id'] ."'";
mysql_query($sql) or die(mysql_error());

				
message("Reservation Updated successfully!", "success");
redirect('index.php');

}

function doConfirm(){
// $id = $_GET['id'];

// $res = new Reservation();
// $res->STATUS = 'Confirmed';
// $res->update($id);
 $sql = "UPDATE `tblreservation` r,tblroom rm SET ROOMNUM=ROOMNUM - 1 WHERE r.`ROOMID`=rm.`ROOMID` AND  `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
mysql_query($sql) or die(mysql_error());


$sql = "UPDATE `tblreservation` SET `STATUS`='Confirmed' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `tblpayment` SET `STATUS`='Confirmed' WHERE `CONFIRMATIONCODE` ='" . $_GET['code'] ."'";
mysql_query($sql) or die(mysql_error());



$confirm_code=$_GET['code'];
 // send e-mail to ...
$email_address="jcoderapps@gmail.com";
$to="jsespinosa@across.ph";//$email_address;

// Your subject
$subject="Your confirmation code here";

// From
$header="from: your name <your email>";

// Your message
$message="Your Comfirmation code \r\n";
$message.="Present this confirmation code on the hotel to prove that your reservation is valid \r\n";
$message.="Confirmation code: $confirm_code";



date_default_timezone_set('Etc/UTC');

require '../../mail/PHPMailerAutoload.php';

$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = MYEMAIL;

//Password to use for SMTP authentication
$mail->Password = MYEMAIL_PASSWORD;

//Set who the message is to be sent from
$mail->setFrom($email_address, 'Tanchuling Hotel');

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
$mail->addAddress($to, 'Tanchuling Hotel');

//Set the subject line
$mail->Subject = $subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("$message");


$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

//Replace the plain text body with one created manually
//$mail->AltBody = 'dgdfgdfg';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors



//echo "<div style='padding:2%; display:none;'>";
if (!$mail->send()) {
    $sentmail=false;
} else {
    $sentmail=true;
}
//echo "</div>";






function itexmo($number,$message,$apicode){
$url = 'https://www.itexmo.com/php_api/api.php';
$itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
$param = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($itexmo),
    ),
);
$context  = stream_context_create($param);
return file_get_contents($url, false, $context);}




$result = itexmo(CELLNUM,"Your confirmation code is $confirm_code",CELLNUM_ACCESSCODE);
if ($result == ""){
//echo "iTexMo: No response from server!!!
//Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
//Please CONTACT US for help. ";	
}else if ($result == 0){
echo "Message Sent!";
}
else{	
//echo "Error Num ". $result . " was encountered!";
}
	


























// send email
//$sentmail = mail($to,$subject,$message,$header);
  

// if your email succesfully sent
if($sentmail){
echo "Your Confirmation link Has Been Sent To Your Email Address.";
}
else {
echo "Cannot send Confirmation link to your e-mail address";
}














message("Reservation Updated successfully!", "success");
redirect('index.php');

}	
/*function dbMODIFY(){
$id = $_GET['id'];
$arrival=$_POST['arrival'];
$departure=$_POST['departure'];
$adults=$_POST['adults'];
$child=$_POST['child'];
$sql="UPDATE reservation SET arrival='$arrival', departure='$departure',adults='$adults',child='$child' WHERE reservation_id=".$id;
$result = dbQuery($sql);
if(!$result)
{
  die('Could not modify record: ' . mysql_error());
} else {

header('Location:index_resv.php');}
}
*/
/*function dbDELETEONE(){
	$del_id = $_GET['id'];
	$sql = "DELETE FROM reservation  WHERE reservation_id={$del_id}";
	$result = dbQuery($sql)or die('Could not delete record: ' . mysql_error());
  header('Location:index_resv.php?view=list');
  }*/
?>