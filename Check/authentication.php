<?php

function end_Section(){
    session_destroy();
    header("Location: ../login.php");
}
$_COOKIE["users"] = "teachers";
// $_COOKIE["users"] = "students";
if (!isset($_SESSION[$_COOKIE["users"]]) || !isset($_SESSION["username"])) {
    end_Section();
}
?>