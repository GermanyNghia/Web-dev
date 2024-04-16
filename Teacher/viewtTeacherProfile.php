<?php
session_start();
include("../Check/authentication.php");
include("../Check/student_restrict.php");
include("../Database/registerDB.php");

if($_SESSION[$_COOKIE["users"]] == "admin"){
    $table = "admin";
}elseif($_SESSION[$_COOKIE["users"]] == "teachers"){
    $table = "teachers";
}elseif($_SESSION[$_COOKIE["users"]] == "students"){
    $table = "students";
}

    $id= $_SESSION["username"];
    $query = "SELECT * FROM $table WHERE username = ?";
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
<button>
	<a href="../home.php">Home</a>
	</button>	
	<table width='80%' border=1>
		<tr bgcolor='#DDDDDD'>
			<td><strong>ID</strong></td>
            <td><strong>Username</strong></td>
			<td><strong>Password</strong></td>
			<td><strong>Teacher's name</strong></td>
			<td><strong>Teacher's email</strong></td>
			<td><strong>Teacher's class</strong></td>
			<td><strong>Teacher's ID</strong></td>
			<td><strong>Teacher's phone Number</strong></td>
		</tr>
        <?php
    if(empty($result)){
        header("Location: teacherList.php");
    }
// Fetch the next row of a result set as an associative array
while ($user = mysqli_fetch_assoc($result)) {
    try{
        echo "<tr>";
        echo "<td>".$user['id']."</td>";  
        echo "<td>".$user['username']."</td>";
        echo "<td>".$user['password']."</td>";
        echo "<td>".$user['teacher_name']."</td>";
        echo "<td>".$user['teacher_email']."</td>";
        echo "<td>".$user['teacher_class']."</td>";
        echo "<td>".$user['teacher_ID']."</td>";
        echo "<td>".$user['phone_num']."</td>";
        echo "<td><a href=\"editTeacher.php?id={$user['id']}\">Edit</a> </td>";
        if ($_SESSION[$_COOKIE["users"]] == "admin"){
            echo "<a href=\"deleteTeacher.php?id={$user['id']}\" onClick=\"return confirm
            ('Are you sure you want to delete?')\">Delete</a></td>";
        } 
    }catch(Exception){
        header("Location: ../../home.php");
    }

}
mysqli_stmt_close($stmt);
mysqli_close($connect);
    ?>
</body>
</html>
