<?php 

//Create Connection
$conn = new mysqli('localhost','root','','post_db');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>