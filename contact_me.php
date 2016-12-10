<?php
require("path/to/sendgrid-php/sendgrid-php.php");


$request_body = json_decode('{
  "personalizations": [
    {
      "to": [
        {
          "email": "rickyfahey@hotmail.com"
        }
      ],
      "subject": "Hello World from the SendGrid PHP Library!"
    }
  ],
  "from": {
    "email": "tjf20@hotmail.com"
  },
  "content": [
    {
      "type": "text/plain",
      "value": "Hello, Email!"
    }
  ]
}');

$apiKey = "RSz21wAJTG29kwgxYdM-kA";  //getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($request_body);
echo $response->statusCode();
echo $response->body();
echo $response->headers();




return true;         
?>
