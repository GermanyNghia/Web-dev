<?php
if ($_SESSION[$_COOKIE["users"]] == "students" || $_SESSION[$_COOKIE["users"]] == "teachers" ) {
    header("Location: home.php");
}

?>