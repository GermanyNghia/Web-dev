<?php

if ($_SESSION[$_COOKIE["users"]] == "teachers") { 
        header("Location: Student_Teacher/ViewHWbyTeacher.php");
} elseif ($_SESSION[$_COOKIE["users"]] == "students") {
        header("Location: Student/viewtStudentProfile.php");
    }

?>
