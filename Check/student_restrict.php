<?php
if ($_SESSION[$_COOKIE["users"]] == "students") {
    header("Location: ../home.php");
}

?>