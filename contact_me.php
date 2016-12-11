<?php

// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message']) ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
  echo "No arguments Provided!";
  return false;
   }


$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');


// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    file_put_contents("php://stderr", "Connection failed!\n");
    die("Connection failed: " . $conn->connect_error);
}

 
$sql = "INSERT INTO contactTB (fromAddress, toAddress, name, phone, mailmessage) values ('" . $_POST['email'] . "', 'rickyfahey@hotmail.com', '" . $_POST['name'] . "', '" . $_POST['phone'] . "', '" . $_POST['message'] . "')";

if ($conn->query($sql) === TRUE) {
    file_put_contents("php://stderr", "New record created successfully" . "\n");
    file_put_contents("php://stderr", $_POST['email'] . "\n");
    file_put_contents("php://stderr", $_POST['name']  . "\n");
    file_put_contents("php://stderr", $_POST['phone'] . "\n");
    file_put_contents("php://stderr", $_POST['message'] . "\n");
} else {
    file_put_contents("php://stderr", "Error: " . $conn->error);
}


$conn->close();

return true;
?>
