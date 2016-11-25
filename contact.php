<!-- Contact Section -->
<div id="contact-section">
  <div class="container">
    <div class="section-title center">
      <h3><strong>Contact</strong> us</h3>
      <hr>
      <div class="clearfix"></div>
    </div>
    <div class="col-md-4">
             <h3>Contact Info</h3>
      <div class="space"></div>
      <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>Jazmin Street, Imperial Court Subdivision
          <br>
          Legazpi City, Albay Philippines 4500
          </p>
      <div class="space"></div>
      <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>Telephone: +63 (52) 820-2912 </p>
      <div class="space"></div>
      <p><i class="fa fa-fax fa-fw pull-left fa-2x"></i>Fax: +63 (52) 480 6003 </p>
    </div>
    <div class="col-md-8">
      <h3>Leave us a message</h3>
      <form name="sentMessage" id="contactForm" method='POST'>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="name" class="form-control" name='name' placeholder="Name" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" id="email" class="form-control" name='email' placeholder="Email" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="message" id="message" class="form-control" name='message' rows="4" placeholder="Message" required></textarea>
          <p class="help-block text-danger"></p>
        </div>
        <div id="success"></div>
        <button type="submit" name="submit1" class="btn btn-default">Send Message</button>
		
      </form>
    </div>
  </div>
</div>
  
<?php
if(isset($_POST['submit1'])){
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
	
// Create the email and send the message
$to = MYEMAIL; //'jcoderapps@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "
<div style='font-size:20px;'>You have received a new message from your website contact form.</div>
<div style='font-size:20px;'>"."Here are the details:<br><br>Name: $name<br><br>Email: $email_address<br><br><br>Message:<br>$message
";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	







date_default_timezone_set('Etc/UTC');

//require './mail/PHPMailerAutoload.php';
require './mail/PHPMailerAutoload.php';

$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
//$mail->SMTPDebug = 2;
$mail->SMTPDebug = 0;

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
$mail->Username = MYEMAIL;//"jcoderapps@gmail.com";

//Password to use for SMTP authentication
$mail->Password = MYEMAIL_PASSWORD;//"jcoderapp@yahoo.com";

//Set who the message is to be sent from
$mail->setFrom($email_address, $name);

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
//$mail->addAddress($to, 'Tanchuling Hotel Comment');
$mail->AddAddress($to, 'Tanchuling Hotel Comment from $name');
//Set the subject line
$mail->Subject = $email_subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML("$email_body");


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
$msg="";
echo "<div style='padding:2%; display:none;'>";
if (!$mail->send()) {
   $msg="";
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  $msg="Message Sent";
    echo "Message sent!";
}
echo "</div>";

if($msg!=""){
echo "<div style='margin-top:3%;'  class='alert alert-success'>$msg</div>";
}







//mail($to,$email_subject,$email_body,$headers);
return true;
}			
?>

