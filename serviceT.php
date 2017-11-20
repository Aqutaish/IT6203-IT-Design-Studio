 <?php
$servername = "localhost";
$username = "AQ_user";
$password = "my*password";
$dbname = "aqutaish";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE Services (Service_ID INT NOT NULL AUTO_INCREMENT, Service_DSC varchar(100) NOT NULL, primary key(Service_ID))";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?> 