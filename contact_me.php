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


/*
file_put_contents("php://stderr", "\n");
file_put_contents("php://stderr", $_POST['name']);
file_put_contents("php://stderr", "\n");
file_put_contents("php://stderr", $_POST['email']);
file_put_contents("php://stderr", "\n");
file_put_contents("php://stderr", $_POST['phone']);
file_put_contents("php://stderr", "\n");
file_put_contents("php://stderr", $_POST['message']);
file_put_contents("php://stderr", "\n");
*/


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

 
//file_put_contents("php://stderr", "Connection was successfully established!\n");

$sql = "INSERT INTO contactTB (fromAddress, toAddress, name, phone, mailmessage) values ('" . $_POST['email'] . "', 'rickyfahey@hotmail.com', '" . $_POST['name'] . "', '" . $_POST['phone'] . "', '" . $_POST['message'] . "')";

$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
    file_put_contents("php://stderr", "New record created successfully");
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
    file_put_contents("php://stderr", "Error: " . $conn->error);
}


$conn->close();

return true;


?>
