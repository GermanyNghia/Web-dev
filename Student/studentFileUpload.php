<!DOCTYPE html>
<html>

<head>
  <title>Upload File for Teacher's Challenge</title>
</head>

<body>
  <h2>Upload File for Teacher's Challenge</h2>
  <button><a href="../home.php"> Home</a></button>

  <?php
  session_start();
  include("../Database/registerDB.php");


  if (isset($_GET['id'])) {
    
    $sql = "SELECT student_ID FROM students WHERE username = '$_SESSION[username]'";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
      // Loop through results and output data
      while($row = $result->fetch_assoc()) {
        $studentId = $row["student_ID"];
      }
    } else {
      header("Location: ../home.php") ;
    } 
    $id= htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
    $sql = "SELECT * FROM challenge WHERE challengeID = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, 's', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
    while($row = $result->fetch_assoc()) {
      $challenge = $row["challengeID"];
    }
  }else{
    header("Location: ../home.php") ;
  } 

  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have a form field named 'student_id' to capture the student ID

    // Process the uploaded file
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    if (isset($_POST['upload'])) {

      //UPLOAD FILE
      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));
      $allowed = array('jpg', 'jpeg', 'png', 'gif', 'docx', 'txt');
      if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
          if ($fileSize < 1000000) {
            // $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = 'uploadByStudent/' . $fileName;
            move_uploaded_file($fileTmpName, $fileDestination);
            //SAVE FILE NAME TO DATABASE
            $sql = "INSERT INTO file (studentID,challenge,fileName) VALUES ('$studentId',
            '$challenge','$fileName')";
            // mysqli_query($connect, $sql);
            $stmt = mysqli_prepare($connect, $sql);
            mysqli_stmt_execute($stmt);
            mysqli_close($connect);
            echo "File uploaded successfully for $studentId and $challenge";
          } else {
            echo "File is too large.";
          }
        } else {
          echo "There was an error uploading your file.";
        }
      } else {
        echo "You cannot upload files of this type.";
      }
    }
  }
  ?>

  <form method="POST" enctype="multipart/form-data">
    
    <!-- <label for="challenge">Challenge:</label>
    <input type="int" name="challenge" required> <br> -->

    <label for="file">Select File:</label>
    <input type="file" name="file" required><br>

    <button type="submit" name="upload">Upload file</button>
  </form>
</body>

</html>