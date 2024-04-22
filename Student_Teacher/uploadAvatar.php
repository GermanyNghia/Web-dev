<?php
// Define upload directory and allowed extensions
include("../Database/registerDB.php");
session_start();
$upload_dir = "avatar/";
$allowed_extensions = array("jpg", "jpeg", "png", "gif");
 // Replace with your logic to get student ID


if(isset( $_GET['username'])){
  $_SESSION ['student_username'] = $_GET['username']; 
}

// Check if form is submitted
if (isset($_POST["submit"])) {

  // Get student data
  $student_username=$_SESSION ['student_username'];

  // Check if a file is uploaded
  if (isset($_FILES["avatar"])) {
    $file_name = $_FILES["avatar"]["name"];
    $file_size = $_FILES["avatar"]["size"];
    $file_tmp = $_FILES["avatar"]["tmp_name"];
    $file_type = $_FILES["avatar"]["type"];
    $ext = explode('.', $file_name);
    $file_ext = strtolower(end($ext));

    // Check for errors
    if ($_FILES["avatar"]["error"] !== UPLOAD_ERR_OK) {
      $error_msg = "Error uploading file: " . $_FILES["avatar"]["error"];
      echo $error_msg;
      exit;
    }

    // Validate file extension
    if (!in_array($file_ext, $allowed_extensions)) {
      $error_msg = "Invalid file extension. Only " . implode(", ", $allowed_extensions) . " are allowed.";
      echo $error_msg;
      exit;
    }

    // Validate file size (optional)
    if ($file_size > 5000000) { // 5MB limit (adjust if needed)
      $error_msg = "File size too large. Maximum size is 5MB.";
      echo $error_msg;
      exit;
    }

    // Generate a unique filename
    $new_filename = uniqid() . "." . $file_ext;

    $result = $upload_dir . $file_name;
    // Upload the file
    if (move_uploaded_file($file_tmp, $result)) {

      

      // Update student record with avatar path
      $sql = "UPDATE students SET avatar = '$result' WHERE username = '$student_username'";

      if (mysqli_query($connect, $sql)) {
        echo "Student avatar uploaded successfully!";
      } else {
        echo "Error updating database: " . mysqli_error($connect);
      }

      // Close connection
      mysqli_close($connect);

    } else {
      echo "Error uploading file.";
    }
  } else {
    echo "Please select a file to upload.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Student Avatar</title>
</head>
<body>
  <h1>Upload Student Avatar</h1>
  <button><a href="../home.php">Home</a></button>	
  <form action="uploadAvatar" method="post" enctype="multipart/form-data">
    <label for="avatar">Avatar:</label>
    <input type="file" name="avatar" accept="image/*"><br><br>
    <button type="submit" name="submit">Upload</button>
  </form>
</body>
</html>