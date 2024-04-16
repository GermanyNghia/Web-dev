<?php
include("../Database/registerDB.php");



// Prepare and execute query for students table
$stmt = $connect->prepare("SELECT username FROM students WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
// Check if username already exists in students table
if ($stmt->num_rows > 0) {
  echo "Username already exists";
  exit();
}

// Prepare and execute query for teachers table
$stmt = $connect->prepare("SELECT username FROM teachers WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

// Check if username already exists in teachers table
if ($stmt->num_rows > 0) {
  echo "Username already exists";
  exit();
}

// If the code reaches this point, the username is not in either table
?>