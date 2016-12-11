<?php
require("sendgrid-php/sendgrid-php.php");

namespace SendGrid;

try {
    /*
        $host = 'https://rickfahey.herokuapp.com';
        $from = new SendGrid\Email(null, "tjf20@hotmail.com");
        $subject = "Hello World from the SendGrid PHP Library!";
        $to = new SendGrid\Email(null, "rickyfahey@hotmail.com");
        $content = new SendGrid\Content("text/plain", "Hello, Email!");
        $mail = new SendGrid\Mail($from, $subject, $to, $content);

        $apiKey = getenv('SENDGRID_API_KEY');
        $sg = new \SendGrid($apiKey);

        $response = $sg->client->mail()->send()->post($mail);
        echo $response->statusCode();
        echo $response->headers();
        echo $response->body();
*/
    $from = new Email(null, "tjf20@hotmail.com");
    $subject = "Hello World from the SendGrid PHP Library";
    $to = new Email(null, "rickyfahey@hotmail.com");
    $content = new Content("text/plain", "some text here");
    $mail = new Mail($from, $subject, $to, $content);
    $to = new Email(null, "rickyfahey@hotmail.com");
    $mail->personalization[0]->addTo($to);

    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);

    $request_body = $mail;
    $response = $sg->client->mail()->send()->post($request_body);
    echo $response->statusCode();
    echo $response->body();
    echo $response->headers();


    } catch (Exception $e) {
        //echo 'Caught exception: ',  $e->getMessage(), "\n";
        file_put_contents("php://stderr", $e->getMessage()+"\n");
    } finally {
        file_put_contents("php://stderr", "done\n");
    }





return true;         
?>
