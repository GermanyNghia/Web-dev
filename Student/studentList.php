<?php
session_start();
include("../Check/authentication.php");
// Include the database connection file
include("../Database/registerDB.php");


// Fetch data in descending order (lastest entry first)
$result = mysqli_query($connect, "SELECT * FROM students ORDER BY id ASC");
?>

<html>
<head>	
	<title>Homepage</title>
	<link rel="stylesheet" href="../CSS/default.css">
</head>

<body>

	<h1>Student List</h1>
	<?php

	if($_SESSION[$_COOKIE["users"]] != "students"){
		echo "<Button>
		<a href='../Student_Teacher/addStudent.php'>Add New Student</a>
		</Button>";
	}

	?>
	<button><a href="../home.php">Home</a></button>	
    <button onclick="history.back()">Back</button>
	<table width='80%' border=1>
		<tr bgcolor='#DDDDDD'>
			<td><strong>ID</strong></td>
			<td><strong>Student's name</strong></td>
			<td><strong>Student's email</strong></td>
			<td><strong>Student's class</strong></td>
			<td><strong>Student's ID</strong></td>
			<td><strong>Student's phone Number</strong></td>
			<td><strong>Student's avatar</strong></td>
		</tr>
		<?php

		// Fetch the next row of a result set as an associative array
		while ($res = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>".$res['id']."</td>";
			echo "<td>".$res['student_name']."</td>";
			echo "<td>".$res['student_email']."</td>";
			echo "<td>".$res['student_class']."</td>";
			echo "<td>".$res['student_ID']."</td>";
            echo "<td>".$res['phone_num']."</td>";
			echo "<td><a href=\"viewStudent.php?id={$res['id']}\">View User</a></td" ."<br>";
			echo "<td><a href=\"chat.php?id={$res['id']}\">Chat user</a></td" ."<br>";	
			if($_SESSION[$_COOKIE["users"]] == "teachers" || $_SESSION[$_COOKIE["users"]] == "admin"){
				echo "<td><a href=\"../Student_Teacher/editStudent.php?id={$res['id']}\">Edit</a> | 
				<a href=\"../Student_Teacher/deleteStudent.php?id={$res['id']}\" onClick=\"return confirm
				('Are you sure you want to delete?')\">Delete</a></td>";				
			}

		}
		?>
	</table>	 
</body>
</html>