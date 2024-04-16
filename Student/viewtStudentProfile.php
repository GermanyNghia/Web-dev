<?php
session_start();
include("../Check/authentication.php");
include("../Database/registerDB.php");

$id = $_SESSION["username"];
$query = "SELECT * FROM students WHERE username = ?";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, 's', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>

<body>
    <button><a href="../home.php">Home</a></button>
    <button onclick="history.back()">Back</button>
    <table width='80%' border=1>
        <tr bgcolor='#DDDDDD'>
            <td><strong>ID</strong></td>
            <td><strong>Username</strong></td>
            <td><strong>Password</strong></td>
            <td><strong>Student's name</strong></td>
            <td><strong>Student's email</strong></td>
            <td><strong>Student's class</strong></td>
            <td><strong>Student's ID</strong></td>
            <td><strong>Student's phone Number</strong></td>
            <td><strong>Student's avatar</strong></td>
        </tr>
        <?php
        if (empty($result)) {
            header("Location: ../studentList.php");
        }
        // Fetch the next row of a result set as an associative array
        while ($user = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . $user['username'] . "</td>";
            echo "<td>" . $user['password'] . "</td>";
            echo "<td>" . $user['student_name'] . "</td>";
            echo "<td>" . $user['student_email'] . "</td>";
            echo "<td>" . $user['student_class'] . "</td>";
            echo "<td>" . $user['student_ID'] . "</td>";
            echo "<td>" . $user['phone_num'] . "</td>";
            echo "<td><img src='http://localhost/website/Student_Teacher/{$user['avatar']}' style='width:100px;height:100px;'</td>";
            echo "<td><a href=\"editStudentProfile.php?id={$user['id']}\">Edit</a> </td>";
            if ($_SESSION[$_COOKIE["users"]] == "admin" || $_SESSION[$_COOKIE["users"]] == "teachers") {
                echo "<a href=\"../Student_Teacher/deleteStudent.php?id={$user['id']}\" onClick=\"return confirm
        ('Are you sure you want to delete?')\">Delete</a></td>";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($connect);
        ?>
</body>

</html>