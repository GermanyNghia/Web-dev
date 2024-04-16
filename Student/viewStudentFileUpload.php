<?php
  session_start();
  include("../Check/authentication.php");
  include("../Database/registerDB.php");
    
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
?>
<!DOCTYPE html>
<html>

<head>
    <title>View Uploaded Files</title>
</head>
<style>
        th{
       padding-left: 10px;
    }
    td{
       padding-left: 10px;
    }
</style>
<body>
    <h1>View Your Uploaded Files</h1>
    <button><a href="../home.php">Home</a></button>	
    <button onclick="history.back()">Back</button>
    
    <form method="POST" enctype="multipart/form-data">
    <button type="submit" name="view">View Uploaded file</button>
    </form>
    <?php
    // Database connection
    if (isset($_POST['view'])) {
         // Fetch uploaded files for the student from the database
        try{
          $sql = "SELECT * FROM file WHERE studentID = $studentId";
          $result = $connect->query($sql);
  
          if ($result->num_rows > 0) {
              echo "<h1>Uploaded Files</h1>";
              echo "<table>";
              echo "<tr><th>Challenge</th><th>File Name</th></tr>";
  
              while ($row = $result->fetch_assoc()) {
                  $challenge = $row['challenge'];
                  $fileName = $row['fileName'];
  
                  echo "<tr>";
                  echo "<td id='h'>$challenge</td>";
                  echo "<td>$fileName</td>";
                  echo "</tr>";
              }
  
              echo "</table>";
          } else {
              echo "No uploaded files found for the student.";
          }
  
          $connect->close();
        }catch(mysqli_sql_exception $e) {
          // Handle the exception specifically
          echo '<span style="color:red;">Chưa có database file</span>';
      
          // Optionally log the error for debugging
          error_log($e->getMessage());
      }
        
    }
    ?>
</body>

</html>