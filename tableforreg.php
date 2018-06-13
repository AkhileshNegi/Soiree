<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elib";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE registration (
phone INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL,
email VARCHAR(50),
gender VARCHAR(50),
city VARCHAR(50)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>