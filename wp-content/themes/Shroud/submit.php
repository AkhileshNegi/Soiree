<?php
// Get data
$customer_name = $_POST["name"];
$customer_email = $_POST["email"];
$customer_sex = $_POST["gender"];
// Database connection
$conn = mysqli_connect("localhost","panda","","elib");
if(!$conn) {
die"Problem in database connection:" . mysql_error());
}

// Data insertion into database
$query = 'INSERT INTO registration ( "name", "emai", "gender") VALUES ( $customer_name, $customer_email, $customer_sex)';
mysqli_query($conn, $query);

// Redirection to the success page
header("Location: ");
?>