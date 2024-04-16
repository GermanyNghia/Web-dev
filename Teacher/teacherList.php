<?php
session_start();
include("../Check/authentication.php");
// Include the database connection file
include("../Database/registerDB.php");


// Fetch data in descending order (lastest entry first)
$result = mysqli_query($connect, "SELECT * FROM teachers ORDER BY id ASC");
?>

<html>
<head>	
	<title>Homepage</title>
	<link rel="stylesheet" href="../CSS/default.css">
</head>

<body>
	<h1>Teacher List</h1>
	<button>
	<a href="../home.php">Home</a>
	</button>	
	<table width='80%' border=1>
		<tr bgcolor='#DDDDDD'>
			<td><strong>ID</strong></td>
			<td><strong>Teacher's name</strong></td>
			<td><strong>Teacher's email</strong></td>
			<td><strong>Teacher's class</strong></td>
			<td><strong>Teacher's ID</strong></td>
			<td><strong>Teacher's phone Number</strong></td>
		</tr>
		<?php

		// Fetch the next row of a result set as an associative array
		while ($res = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>".$res['id']."</td>";
			
			echo "<td>".$res['teacher_name']."</td>";
			echo "<td>".$res['teacher_email']."</td>";
			echo "<td>".$res['teacher_class']."</td>";
			echo "<td>".$res['teacher_ID']."</td>";
            echo "<td>".$res['phone_num']."</td>";	
            echo "<td><a href=\"viewTeacher.php?id={$res['id']}\">View User</a></td" ."<br>";
			echo "<td><a href=\"chat.php?id={$res['id']}\">Chat user</a></td" ."<br>";	
			if($_SESSION[$_COOKIE["users"]] == "admin" ){
				echo "<td><a href=\"editTeacher.php?id={$res['id']}\">Edit</a> | 
				<a href=\"../Teacher_Admin/deleteTeacher.php?id={$res['id']}\" onClick=\"return confirm
				('Are you sure you want to delete?')\">Delete</a></td>";				
			}

		}
		?>
	</table>	 
</body>
</html>