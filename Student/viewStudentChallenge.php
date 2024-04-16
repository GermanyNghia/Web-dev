<?php
session_start();
include("../Check/authentication.php");
include("../Database/registerDB.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300">
    <title>HomeWork</title>
    <link rel="stylesheet" href="../CSS/upload_homework.css">
</head>

<body>
    <h2>List of HomeWork</h2>
    <button><a href="../home.php"> Home</a></button>
    <button><a href="viewStudentFileUpload.php">View your submission</a></button>

    <table>
        <thead>
            <tr>
                <th>Challenge ID</th>
                <th>File Name</th>
                <th>Download</th>
                <th>Add Submission</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $directory = "../Student_Teacher/uploadByTeacher/"; // Specify the directory path where the files are uploaded
            // Get the list of files in the directory
            $files = scandir($directory);
            // Get the list of files in the directory
            try {
                $result = mysqli_query($connect, "SELECT * FROM challenge ORDER BY challengeID ASC");

                foreach ($files as $file) {
                    if ($file !== '.' && $file !== '..') {
                        echo "<tr>";
                        while ($res = mysqli_fetch_assoc($result)) {
                            echo "<td>" . $res['challengeID'] . "</td>";
                            echo "<td>" . $res['challengeName'] . "</td>";
                            echo "<td><a href='$directory$res[challengeName]' download target='_blank'>
                            Download</a></td>";
                            echo "<td><a href='studentFileUpload.php?id=$res[challengeID]'>Add submission</a></td>";
                            echo "</tr>";
                        }
                    }
                }
            } catch (mysqli_sql_exception $e) {
                // Handle the exception specifically
                echo '<span style="color:red;">Chưa có database challenge</span>';

                // Optionally log the error for debugging
                error_log($e->getMessage());
            }

            ?>
        </tbody>
    </table>
</body>

</html>