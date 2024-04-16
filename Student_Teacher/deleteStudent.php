<?php
session_start();
include("../Check/authentication.php");
include("../Check/student_restrict.php");
// Retrieve the selected student's information from the database
include("../Database/registerDB.php");
if (isset($_GET['id'])) {
    $id= htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
    $query = "DELETE FROM students WHERE id=?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if ($stmt->execute() === TRUE) {
        echo "Student record deleted successfully" . "<br>";
        echo "<button> <a href=../Student/studentList.php>BACK</a>";
      } else {
        echo "Error deleting student record: " . $conn->error;
      }
}
?>