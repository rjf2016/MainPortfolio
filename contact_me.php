<?php
require("sendgrid-php/sendgrid-php.php");

try {
            
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
            "email": "test@example.com"
          },
          "content": [
            {
              "type": "text/plain",
              "value": "Hello, Email!"
            }
          ]
        }');

        $apiKey = getenv('SENDGRID_API_KEY');
        $sg = new \SendGrid($apiKey);

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
