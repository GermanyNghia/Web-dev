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
    <h2>List of HomeWork Uploaded</h2>
    <button><a href="../home.php"> Home</a></button>
    <button><a href="uploadFile.php">Add New HomeWork</a></button>

    <table>
        <thead>
            <tr>
                <th>Challenge ID</th>
                <th>File Name</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $directory = "uploadByTeacher/"; // Specify the directory path where the files are uploaded
            // Get the list of files in the directory
            $files = scandir($directory);

            include("../Database/registerDB.php");
            // Get the list of files in the directory
            $result = mysqli_query($connect, "SELECT * FROM challenge ORDER BY challengeID ASC");

            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    echo "<tr>";
                    while ($res = mysqli_fetch_assoc($result)) {
                        echo "<td>" . $res['challengeID'] . "</td>";
                        echo "<td>" . $res['challengeName'] . "</td>";
                        echo "<td><button><a href='viewSubmission.php'>View submission
                        </a></button></td>";
                        echo "</tr>";
                    }
                }
            }
            // echo "<td><a href='viewSubmission.php' target='_blank'>View submission</a></td>";
            ?>
        </tbody>
    </table>
</body>

</html>