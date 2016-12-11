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


file_put_contents("php://stderr", "test\n");

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    file_put_contents("php://stderr", "Connection failed!\n");
    die("Connection failed: " . $conn->connect_error);
}

 
file_put_contents("php://stderr", "Connection was successfully established!\n");


$sql = "SELECT fromAddress, toAddress, name, phone, subject, CAST(mailMessage AS CHAR(1000) CHARACTER SET utf8) as mailMessage FROM contactTB";

$result = $conn->query($sql);

file_put_contents("php://stderr", "Num Rows = \n");
file_put_contents("php://stderr",  $result->num_rows);
file_put_contents("php://stderr", "Back from Num Rows = \n");

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        file_put_contents("php://stderr", $row["mailMessage"] + "\n");
    }
} else {
    echo "0 results";
}
$conn->close();



?>
