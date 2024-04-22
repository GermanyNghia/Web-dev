<?php
// include("solarSystem.html");
session_start();

function check_cookie()
{

    if ($_SESSION[$_COOKIE["users"]] == "admin") {
        return true;
    }
}

function end_Section()
{
    session_destroy();
    header("Location: login");
}
try {

    if (!isset($_SESSION[$_COOKIE["users"]])) {
        end_Section();
    } else {
        if ($_SESSION[$_COOKIE["users"]] == $_SESSION[$_COOKIE["users"]]) {
            if (check_cookie()) {
                include("html/admin.html");
            } else {
                include("html/home.html");
            }
        } else {
            setcookie("users", "user1", time() + 3600, "/Website");
            echo "<h1 style='color: white;'>Welcome anonymous</h1>";
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
if (isset($_POST["viewStudent"])) {
    header("Location: Student/studentList.php");
}
if (isset($_POST["view_teacher"])) {
    header("Location: Teacher/teacherList.php");
}
if ($_SESSION[$_COOKIE["users"]] == "admin") {
    if (isset($_POST["add_teacher"])) {
        header("Location: Teacher_Admin/addTeacher.php");
    }
}
if ($_SESSION[$_COOKIE["users"]] == "teachers") {
    if (isset($_POST["view-profile"])) {
        header("Location: Teacher/viewtTeacherProfile.php");
    }
    if (isset($_POST["viewHomework"])) {
        header("Location: Student_Teacher/ViewHWbyTeacher.php");
    }
} elseif ($_SESSION[$_COOKIE["users"]] == "students") {
    if (isset($_POST["view-profile"])) {
        header("Location: Student/viewtStudentProfile.php");
    }
    if (isset($_POST["viewHomework"])) {
        header("Location: Student/viewStudentChallenge.php");
    }
}





if (isset($_POST["logout"])) {
    end_Section();
}
