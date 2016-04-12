<?php
$servername = "www14.df.gob.mx";
$username = "DBc4biertos";
$password = "contr4tos4b!ertos.2016*";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>