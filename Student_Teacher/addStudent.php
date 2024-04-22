<?php
session_start();
include("../Check/authentication.php");
include("../Check/student_restrict.php");
include("../Check/checkMail.php");
include("../Database/registerDB.php");
include("../html/addStudent.html");
?>


<?php
// Lấy dữ liệu từ biểu mẫu

if (isset($_POST["addStudent"])) {
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
  $repassword = filter_input(INPUT_POST, "repassword", FILTER_SANITIZE_SPECIAL_CHARS);
  $student_name = filter_input(INPUT_POST, "student_name", FILTER_SANITIZE_SPECIAL_CHARS);
  $student_email   = filter_input(INPUT_POST, "student_email", FILTER_SANITIZE_SPECIAL_CHARS);
  $student_class   = filter_input(INPUT_POST, "student_class", FILTER_SANITIZE_SPECIAL_CHARS);
  $student_ID = filter_input(INPUT_POST, "student_ID", FILTER_SANITIZE_SPECIAL_CHARS);
  $phone_num = filter_input(INPUT_POST, "phone_num", FILTER_SANITIZE_SPECIAL_CHARS);
  $hash1 = hash('sha256', $password);
  $hash2 = hash('sha256', $repassword);


  // Thực hiện truy vấn để thêm sinh viên vào cơ sở dữ liệu
  try {

    include("../Check/checkAdd.php");
    if (check_mail($student_email)) {
      echo "Invalid email address";
    } else {
      if ($hash1 == $hash2) {
        $query = "INSERT INTO students (username, password, student_name, student_email, 
        student_class, student_ID ,phone_num) VALUES ('$username', '$hash', '$student_name', 
        '$student_email', '$student_class', '$student_ID', '$phone_num')";
        mysqli_query($connect, $query);
        echo "Thêm sinh viên thành công!" . "<br>";
        echo "<button> <a href=uploadAvatar?username={$username}>Upate avatar</a></button>";
      } else {
        echo ("Mật khẩu không trùng khớp");
      }
    }
  } catch (PDOException $e) {
    if ($e->getCode() == '23000') {
      echo "Dữ liệu bị trùng";
    } else {
      echo "Lỗi khi thêm sinh viên: " . $e->getMessage();
    }
  } catch (Exception $e) {
    $e->getMessage();
  }
}
?>