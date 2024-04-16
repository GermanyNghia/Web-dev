<?php
session_start();
include("../Check/authentication.php");
include("../Database/registerDB.php");

if (isset($_GET['id'])) {
    $id= htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
    $query = "SELECT * FROM teachers WHERE id = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);   
}else{

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/default.css">

    <title>Document</title>
</head>
<body>
<button>
	<a href="../home.php">Home</a>
	</button>
    <button onclick="history.back()">Back</button>	
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
    if(empty($result)){
        header("Location: ../Teacher/teacherList.php");
    }
// Fetch the next row of a result set as an associative array
while ($user = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$user['id']."</td>";    
    echo "<td>".$user['teacher_name']."</td>";
    echo "<td>".$user['teacher_email']."</td>";
    echo "<td>".$user['teacher_class']."</td>";
    echo "<td>".$user['teacher_ID']."</td>";
    echo "<td>".$user['phone_num']."</td>";
}
mysqli_stmt_close($stmt);
mysqli_close($connect);
    ?>
</body>
</html>


