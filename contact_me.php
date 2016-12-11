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


mysql://zaa0y67ozz5a9s2f:no2v7yz0kczwccfh@o61qijqeuqnj9chh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/xrh86esz09fgxlhr?sslca=rds-combined-ca-bundle.pem&ssl-verify-server-cert


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
    die("Connection failed: " . $conn->connect_error);
}
echo "Connection was successfully established!";



$sql = "SELECT fromAddress, toAddress, name, phone, subject, CAST(mailmessage AS CHAR(10000) CHARACTER SET utf8) as mailMessage FROM contactTB";

$result = $conn->query($sql);

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
