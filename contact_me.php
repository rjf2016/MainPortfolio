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


file_put_contents("php://stderr", "test\n");

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    file_put_contents("php://stderr", "Connection failed!\n");
    die("Connection failed: " . $conn->connect_error);
}

 
file_put_contents("php://stderr", "Connection was successfully established!\n");

$sql = "INSERT INTO contactTB (fromAddress, toAddress, name, phone, mailmessage) values ('" + $_POST['email'] + "', "'rickyfahey@hotmail.com', "'" + $_POST['name'] + "', '" + $_POST['phone'] + "', '" + $_POST['message'] + "')";

file_put_contents("php://stderr", $sql);
file_put_contents("php://stderr", "\n\n");

$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
    file_put_contents("php://stderr", "New record created successfully");
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
    file_put_contents("php://stderr", "Error: " + $conn->error);
    file_put_contents("php://stderr", "\n\n");
}


/*
file_put_contents("php://stderr", "Num Rows = \n");
file_put_contents("php://stderr",  $result->num_rows);
file_put_contents("php://stderr", "Back from Num Rows = \n");

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        file_put_contents("php://stderr", $row["subject"]);
        file_put_contents("php://stderr", "\n");
    }
} else {
    echo "0 results";
}
*/
$conn->close();
return true;


?>
