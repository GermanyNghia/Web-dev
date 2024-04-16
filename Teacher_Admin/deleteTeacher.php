<?php
session_start();
include("../Check/authentication.php");
include("../Database/registerDB.php");
// Retrieve the deleteed student's information from the database
include("registerDB.php");
if (isset($_GET['id'])) {
    $id= htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
    if ($_SESSION[$_COOKIE["users"]] == "admin"){
      $query = "DELETE * FROM teachers WHERE id = ?";
  }else{
      $query = "DELETE * FROM teachers WHERE id = ? and username = '$_SESSION[username]'";
  }
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if ($stmt->execute() === TRUE) {
        echo "Teacher record deleted successfully" . "<br>";
        echo "<button> <a href=../Teacher/teacherList.php>BACK</a>";
      } else {
        echo "Error deleting teacher record: " . $conn->error;
      }
}
?>