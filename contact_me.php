<?php
require 'vendor/autoload.php';



// If you are not using Composer (recommended)
// require("path/to/sendgrid-php/sendgrid-php.php");

$from = new SendGrid\Email(null, "tjf20@hotmail.com");
$subject = "Hello World from the SendGrid PHP Library!";
$to = new SendGrid\Email(null, "rickyfahey@hotmail.com");
$content = new SendGrid\Content("text/plain", "Hello, Email!");
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = getenv('SENDGRID_API_KEY');
//$sg = new \SendGrid($apiKey);
$sg = new \SendGrid("RSz21wAJTG29kwgxYdM-kA");


$response = $sg->client->mail()->send()->post($mail);

echo $response->statusCode();
echo $response->headers();
echo $response->body();


/*





// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }


$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
   
// Create the email and send the message
$to = 'rickyfahey@hotmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";   

//mail($to,$email_subject,$email_body,$headers);

$sendgrid = new SendGrid("RSz21wAJTG29kwgxYdM-kA");
$email    = new SendGrid\Email();

$email->addTo("rickyfahey@hotmail.com")
      ->setFrom(strip_tags(htmlspecialchars($_POST['email'])))
      ->setSubject($email_subject)
      ->setHtml($email_body);

$sendgrid->send($email);

*/




return true;         
?>
