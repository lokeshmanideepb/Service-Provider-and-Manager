<?php
$servername = "34.27.89.119";
$username = "gradwebapp";
$password = "c5Ft,+90)}oj";
$db = "servicemanager";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>